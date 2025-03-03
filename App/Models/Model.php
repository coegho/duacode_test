<?php

namespace App\Models;

use \PDO;

class Model
{
    public static function getPrimaryKey(): string
    {
        if (defined(\get_called_class() . '::PRIMARY_KEY')) {
            return constant(\get_called_class() . '::PRIMARY_KEY');
        } else {
            return 'id';
        }
    }

    public static function getTableName(): string
    {
        if (defined(\get_called_class() . '::TABLE_NAME')) {
            return constant(\get_called_class() . '::TABLE_NAME');
        }
    }

    public function create(): bool
    {
        $properties = get_object_vars($this);
        $params = [];
        $columns = [];
        $values = [];
        foreach ($properties as $key => $value) {
            $params[$key] = $value;
            $columns[] = $key;
            $values[] = ":$key";
        }

        $query = 'INSERT INTO ' . static::getTableName() . ' (' . implode(',', $columns) . ') VALUES (' . implode(',', $values) . ')';
        $sth = db()->prepare($query);
        $sth->execute($params);

        if ($sth->rowCount() == 0) {
            return false;
        }

        $primary_key = static::getPrimaryKey();
        $this->$primary_key = db()->lastInsertId();
        return true;
    }

    public static function read(int $id): ?Model
    {
        $sth = db()->prepare('SELECT * FROM ' . static::getTableName() . ' WHERE ' . static::getPrimaryKey() . ' = :id');
        $sth->execute(['id' => $id]);
        $sth->setFetchMode(PDO::FETCH_CLASS, \get_called_class());
        $model = $sth->fetch();
        if ($model) return $model;
        else return null;
    }

    public function update(): bool
    {
        $properties = get_object_vars($this);
        $set = [];
        $params = [];
        foreach ($properties as $key => $value) {
            $params[$key] = $value;
            if ($key !== static::getPrimaryKey()) {
                $set[] = "$key = :$key";
            }
        }
        if (count($set) == 0) {
            return true;
        }
        $query = 'UPDATE ' . static::getTableName() . ' SET ' . implode(',', $set) . ' WHERE '. static::getPrimaryKey() . ' = :id';
        $sth = db()->prepare($query);
        $sth->execute($params);
        return $sth->rowCount() > 0;
    }

    public function delete(): bool
    {
        $primary_key = static::getPrimaryKey();
        $id = $this->$primary_key;
        $sth = db()->prepare('DELETE * FROM ' . static::getTableName() . ' WHERE ' . static::getPrimaryKey() . ' = :id');
        $sth->execute(['id' => $id]);
        return $sth->rowCount() > 0;
    }

    public static function all(): Array
    {
        $sth = db()->prepare('SELECT * FROM ' . static::getTableName());
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS, \get_called_class());
        $model = $sth->fetchAll();
        if ($model) return $model;
        else return [];
    }
}

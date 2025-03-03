<?php

function db(): PDO
{
    
    static $dbh = null;
    if (is_null($dbh)) {
        $dsn = DB_DRIVER . ':host=' . DB_HOST . ':' . DB_PORT . ';dbname=' . DB_NAME;
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    }

    return $dbh;
}

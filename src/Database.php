<?php

namespace Itb;

class Database

//create database using class constants for class Database
{
    const DB_NAME = 'itb';
    const DB_USER = 'root';
    const DB_PASS = 'pass';
    const DB_HOST = 'localhost:3306';

    //connection property set as private
    private $connection;

 // Create connection to database

    public function __construct()
    {
        try {
        $this->connection = $this->createMysqlConnection();
    }
    catch(\Exception $e){
        print $e-> getMessage();;
    }
}

// create new mysql connection
private function createMysqlConnection()
{
    $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;
    return new \PDO($dsn, self::DB_USER, self::DB_PASS);
}

//return mixed

    public function getConnection()
    {
    return $this->connection;
    }
}



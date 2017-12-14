<?php


namespace Itb;


class UsersRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function dropTable()
    {
        $sql = "DROP TABLE IF EXISTS users";
        $this->connection->exec($sql);
    }

    public function createTable()
    {
        // drop table if it already exists
        // (removing all old data)
        $this->dropTable();

        $sql = "
            CREATE TABLE IF NOT EXISTS users (
            id integer not null primary key auto_increment,
            username VARCHAR (255),
            password VARCHAR (255),
            email VARCHAR (255),
            UNIQUE (`username`),
            UNIQUE (`email`)
            
             )
             ENGINE = MYISAM 
        ";

        $this->connection->exec($sql);
    }

    public function insert($username, $password, $email)
    {
        // Prepare INSERT statement to SQLite3 file db
        $sql = 'INSERT INTO users (username, password, email ) 
			VALUES (:username, :password, :email)';

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        // Execute statement
        $stmt->execute();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM users';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\users');

        $users = $stmt->fetchAll();

        return $users;
    }


    public function getOne($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        // Execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Users');

        $logi = $stmt->fetch();

        return $logi;


    }


    public function deleteAll()
    {
        $sql = 'DELETE * FROM users';

        $stmt = $this->connection->exec($sql);

        $stmt->execute();
    }





}
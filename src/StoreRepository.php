<?php


namespace Itb;


class StoreRepository
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
        $sql = "DROP TABLE IF EXISTS store";
        $this->connection->exec($sql);
    }

    public function createTable()
    {
        // drop table if it already exists
        // (removing all old data)
        $this->dropTable();

        $sql = "
            CREATE TABLE IF NOT EXISTS store (
            id integer not null primary key auto_increment,
            description VARCHAR (255),
            img BLOB NOT NULL,
           /* img VARCHAR (255), */
            price float(5,2))
        ";

        $this->connection->exec($sql);
    }

    /**
     * @param $description
     * @param $price
     */
    public function insert($description, $price, $img)
    {
        // Prepare INSERT statement to SQLite3 file db
        $sql = 'INSERT INTO store (description, price, img) 
			VALUES (:description, :price, :img)';

        $stmt = $this->connection->prepare($sql);

        // Bind parameters to statement variables
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':img', $img);

        // Execute statement
        $stmt->execute();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM store';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Store');

        $menus = $stmt->fetchAll();

        return $menus;
    }


    public function getOne($id)
    {
        $sql = 'SELECT * FROM store WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        // Execute statement
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Itb\\Store');

        $store = $stmt->fetch();

        return $store;


    }


    public function deleteAll()
    {
        $sql = 'DELETE * FROM store';

        $stmt = $this->connection->exec($sql);

        $stmt->execute();
    }





}
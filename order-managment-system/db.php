<?php
date_default_timezone_set("Asia/Tokyo");

class OrderDB
{
    private $db;

    public function __construct()
    {
        $databasePath = __DIR__ . "/order.db";

        $this->db = new PDO("sqlite:" . $databasePath);

        $this->db->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $this->db->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );

        $this->createTable();
    }

    private function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS T_ORDER (
                ID INTEGER PRIMARY KEY AUTOINCREMENT,
                ITEM_NAME TEXT NOT NULL,
                PRICE INTEGER NOT NULL,
                CUSTOMER TEXT NOT NULL,
                ORDER_DATE TEXT NOT NULL
            )
        ";

        $this->db->exec($sql);
    }

    public function insertOrder($item, $price, $customer)
    {
        $sql = "
            INSERT INTO T_ORDER (
                ITEM_NAME,
                PRICE,
                CUSTOMER,
                ORDER_DATE
            )
            VALUES (
                :item,
                :price,
                :customer,
                :orderDate
            )
        ";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            ":item" => $item,
            ":price" => $price,
            ":customer" => $customer,
            ":orderDate" => date("Y-m-d H:i:s")
        ]);
    }

    public function getAllOrders()
    {
        $sql = "
            SELECT *
            FROM T_ORDER
            ORDER BY ID DESC
        ";

        $statement = $this->db->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getOrderById($id)
    {
        $sql = "
            SELECT *
            FROM T_ORDER
            WHERE ID = :id
        ";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);

        return $statement->fetch();
    }

    public function updatePrice($id, $price)
    {
        $sql = "
            UPDATE T_ORDER
            SET PRICE = :price
            WHERE ID = :id
        ";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            ":price" => $price,
            ":id" => $id
        ]);
    }

    public function deleteOrder($id)
    {
        $sql = "
            DELETE FROM T_ORDER
            WHERE ID = :id
        ";

        $statement = $this->db->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);
    }
}
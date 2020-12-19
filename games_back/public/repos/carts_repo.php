<?php

use Carts;

require '../sql_requests.php';

class CartsRepo
{
    public function __construct(string $HOST, string $USER, string $PWD, string $CARTS_TABLE, string $CUSTOMER_TABLE)
    {
        $this->db = new PDO(construct_connection_string_sql($HOST, $CARTS_TABLE), $USER, $PWD);
        $this->fetchAll = $this->db->prepare(construct_fetch_all_sql($CARTS_TABLE));
        $this->fetchById = $this->db->prepare(construct_fetch_by_id_sql($CARTS_TABLE));
    }

    public function get_all(int $limit = 10, int $offset = 0)
    {
        $this->fetchAll->execute([$limit, $offset]);
        return $this->fetchAll->fetchAll(PDO::FETCH_CLASS, Carts::class);
    }

    public function get_by_id(string $id, int $limit = 10, int $offset = 0)
    {
        $this->fetchById->execute([$id, $limit, $offset]);
        return $this->fetchById->fetchAll(PDO::FETCH_CLASS, Carts::class);
    }
}

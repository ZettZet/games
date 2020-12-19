<?php

use Customer;

require '../sql_requests.php';

class CustomerRepo
{
    public function __construct(string $HOST, string $USER, string $PWD, string $CUSTOMERS_TABLE)
    {
        $this->db = new PDO(construct_connection_string_sql($HOST, $CUSTOMERS_TABLE), $USER, $PWD);
        $this->fetchAll = $this->db->prepare(construct_fetch_all_sql($CUSTOMERS_TABLE));
        $this->fetchById = $this->db->prepare(construct_fetch_by_id_sql($CUSTOMERS_TABLE));
        $this->update = $this->db->prepare(construct_update_sql($CUSTOMERS_TABLE, Customer::class));
        $this->add = $this->db->prepare(construct_add_sql($CUSTOMERS_TABLE, Customer::class));
        $this->delete = $this->db->prepare(construct_delete_sql($CUSTOMERS_TABLE));
    }

    public function get_all(int $limit = 10, int $offset = 0)
    {
        $this->fetchAll->execute([$limit, $offset]);
        return $this->fetchAll->fetchAll(PDO::FETCH_CLASS, Customer::class);
    }

    public function get_by_id(int $id, int $limit = 10, int $offset = 0)
    {
        $this->fetchById->execute([$id, $limit, $offset]);
        return $this->fetchById->fetchAll(PDO::FETCH_CLASS, Customer::class);
    }

    public function update(Customer $upd): bool
    {
        return $this->update->execute($upd->as_array());
    }

    public function add(Customer $crt): bool
    {
        return $this->add->execute($crt->as_array());
    }

    public function add_many(array $crts): bool
    {
        $state = true;

        foreach ($crts as $item) {
            $state &= $this->add->execute($item->as_array());
        }

        return $state;
    }

    public function delete(int $id): bool
    {
        return $this->delete->execute([$id]);
    }
}

<?php

use CustomerCart;
use Game;

require '../sql_requests.php';

class CustomerCartRepo
{
    public function __construct(string $HOST, string $USER, string $PWD, string $USER_CART_TABLE, string $GAMES_TABLE)
    {
        $this->db = new PDO(construct_connection_string_sql($HOST, $USER_CART_TABLE), $USER, $PWD);
        $this->fetchByCustomerId = $this->db->prepare(construct_fetch_games_by_customer_cart_sql($USER_CART_TABLE, $GAMES_TABLE));
        $this->add = $this->db->prepare(construct_add_sql($USER_CART_TABLE, Game::class));
        $this->deleteGame = $this->db->prepare(cunstruct_delete_game_sql($USER_CART_TABLE));
    }

    public function get_by_customer_id(string $customer_id, int $limit = 10, int $offset = 0)
    {
        $this->fetchByCustomerId->execute([$customer_id, $limit, $offset]);
        return $this->fetchByCustomerId->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

    public function add(CustomerCart $crt): bool
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

    public function delete(string $customer_id, string $game_id): bool
    {
        return $this->deleteGame->execute([$customer_id, $game_id]);
    }
}

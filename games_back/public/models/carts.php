<?php

class Status {
    public static string $taken = 'taken';
    public static string $payed = 'payed';
}


class Carts
{
    public string $game_id;
    public int $game_price;
    public string $customer_id;
    public string $status;

    public function __construct(string $game_id, int $game_price, string $customer_id, string $status = "taken")
    {
        $this->game_id = $game_id;
        $this->game_price = $game_price;
        $this->customer_id = $customer_id;
        $this->status=$status;
    }

    public function get_game_id()
    {
        return $this->game_id;
    }

    public function get_game_price()
    {
        return $this->game_price;
    }

    public function get_customer_ir()
    {
        return $this->customer_id;
    }
}

<?php
class CustomerCart
{
    public string $game_id;
    public string $customer_id;

    public function __construct(string $game_id, string $customer_id, bool $is_done = false)
    {
        $this->game_id = $game_id;
        $this->customer_id = $customer_id;
        $this->is_done = $is_done;
    }

    public function get_game_id()
    {
        return $this->game_id;
    }

    public function set_game_id(string $value)
    {
        $this->game_id = $value;
    }

    public function get_customer_id()
    {
        return $this->customer_id;
    }

    public function set_customer_id(string $value)
    {
        $this->customer_id = $value;
    }

    public function as_array()
    {
        return (array) $this;
    }
}

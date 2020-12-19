<?php


class GameCategory
{
public string $game_id;
public string $category_id;

public function __construct(string $game_id, string $category_id){
    $this->game_id = $game_id;
    $this->category_id = $category_id;
}

    public function get_game_id()
    {
        return $this->game_id;
    }


    public function set_game_id(string $game_id): void
    {
        $this->game_id = $game_id;
    }

    public function get_category_id()
    {
        return $this->category_id;
    }

    public function set_category_id(string $category_id)
    {
        $this->category_id = $category_id;
    }

    public function as_array(){
    return (array) $this;
    }
}
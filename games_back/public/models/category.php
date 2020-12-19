<?php


class Category
{
    public string $id;
    public string $name;

    public function __construct(string $name, string $id = NONE){
        $this->id = $id;
        $this->name = $name;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_name(string $name)
    {
        $this->name = $name;
    }

    public function as_array()
    {
        $arr = (array) $this;
        if ($this->id === NULL) {
            unset($arr['id']);
        }
        return $arr;
    }
}
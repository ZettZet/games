<?php
class Game
{
    public string $id;
    public string $title;
    public string $description;
    public int $price;
    public string $uri_image;

    public function __construct(string $title, string $description, int $price, string $uri_image, string $id = NULL)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->uri_image = $uri_image;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function set_title(string $value)
    {
        $this->title = $value;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function set_description(string $value)
    {
        $this->description = $value;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function set_price(int $value)
    {
        $this->price = $value;
    }

    public function get_image()
    {
        return $this->uri_image;
    }

    public function set_image(string $value)
    {
        $this->image = $value;
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

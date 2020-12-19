<?php

class Customer
{
    public string $id;
    public string $email;
    public string $pass;

    public function __construct(string $email, string $pass, string $id = NULL)
    {
        $this->email = $email;
        $this->id = $id;
        $this->pass = ($this->id === NULL) ? password_hash($pass, PASSWORD_BCRYPT) : $pass;
    }

    public function get_id()
    {
        return $this->id;
    }


    public function get_email()
    {
        return $this->email;
    }

    public function set_email(string $value)
    {
        $this->email = $value;
    }


    public function get_password()
    {
        return $this->password;
    }

    public function set_password(string $value)
    {
        $this->pass = password_hash($value, PASSWORD_BCRYPT);
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

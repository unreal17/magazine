<?php

class Goods extends Query
{
    public function __construct()
    {
        $this->table = "goods";
    }

    public function SelectById(int $id)
    {
        return "Select * from " . $this->table . " where id = " . $id;
    }

    public function Insert(array $data)
    {
        return "INSERT INTO `$this->table` (`name`, `image_past`, `image_name`, `description`, `cost`) VALUES('" . $data['name'] . "', '" . $data['image_past'] . "', '" . $data['image_name'] . "', '" . $data['description'] . "', '" . $data['cost'] . "')";
    }

    public function CheckUniqueness(array $data)
    {
        return "Select * from " . $this->table . " where name = '" . $data['name'] . "'";
    }

    public function Update(array $data, int $id)
    {
        return "UPDATE " . $this->table . " SET `name`='" . $data['name'] . "',`image_past`=" . $data['image_past'] ."',`image_name`=" . $data['image_name']. ",`description`='" . $data['description'] . ",`cost`='" . $data['cost'] . "' WHERE id = " . $id;
    }
}
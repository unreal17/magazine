<?php

class Cart
{
    private $Items;

    public function __construct(array $data)
    {
        $this->Items = $data;
    }

    public function __destruct()
    {
        $this->Items;
    }

    public function getItems(): array
    {
        return $this->Items;
    }

    public function getCountPosition()
    {
        return count($this->Items);
    }

    public function AddOneItems(int $idItem)
    {
        if (array_key_exists($idItem, $this->Items)) {
            $this->Items[$idItem]++;
        } else {
            $this->Items[$idItem] = 1;
        }
        return $this->Items;
    }

    public function SetCountItems(int $idItem, int $count)
    {
        if ($count > 0) {
            $this->Items[$idItem] = $count;
        } else {
            $this->deleteItem($idItem);
        }
        return $this->Items;
    }

    public function MinusOneItem(int $idItem)
    {
        if ($this->Items[$idItem] > 1) {
            $this->Items[$idItem]--;
        } else {
            $this->deleteItem($idItem);
        }
        return $this->Items;
    }

    private function deleteItem(int $idItem)
    {
        if (isset($this->Items[$idItem]))
            unset($this->Items[$idItem]);
    }
}
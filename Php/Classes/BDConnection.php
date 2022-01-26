<?php

class BDConnection
{
    private const LinkBase = "localhost";
    private const LoginBase = "root";
    private const PassBase = "";
    private const Base = "local";

    private static function ReviewsSelectQuery($Query)
    {
        $mysqli = new mysqli(static::LinkBase, static::LoginBase, static::PassBase, static::Base);
        if ($mysqli->connect_errno) {
            echo "<script>console.log('Не удалось подключиться к MySQL: (\" . $mysqli->connect_errno . \") \" . $mysqli->connect_error \" ')</script>";
        }
        if ($Query != null) {
            return $mysqli->query($Query);
        }
    }

    public  static function  PrivateQuery($Query)
    {
        return static::ReviewsSelectQuery($Query);
    }
    public static function Insert(Query $query, array $Insert)
    {
        $check = static::ReviewsSelectQuery($query->CheckUniqueness($Insert));
        echo $query->Insert($Insert);
        if ($check->num_rows == 0) {
            $result = static::ReviewsSelectQuery($query->Insert($Insert));
            return true;
        } else {
            return false;
        }
    }

    public static function SelectWhere(Query $query, $where)
    {
        return static::ReviewsSelectQuery($query->SelectWhere($where));
    }

    public static function SelectById(Query $query, int $id)
    {
        return static::ReviewsSelectQuery($query->SelectById($id));
    }

    public static function Delete(Query $query, int $id)
    {
        $result = static::ReviewsSelectQuery($query->Delete($id));
    }

    public static function Update(Query $query, array $data, int $id){
        return static::ReviewsSelectQuery($query->Update($data, $id));
    }

    public static function SelectAll(Query $query)
    {
        return static::ReviewsSelectQuery($query->SelectAll());
    }
}
<?
class Usersreg extends Query
{
    public function __construct()
    {
        $this->table = "usersreg";
    }
    public function SelectById(int $id)
    {
        return "Select * from" . $this->table . " where id = " . $id;
    }
    public function Insert(array $data)
    {
        return "INSERT INTO `$this->table` (`login`, `pass`, `name`) VALUES('" . $data['login'] . "', '" . $data['pass'] . "', '" . $data['name'] . "')";
    }
    public function CheckUniqueness(array $data)
    {
        return "Select * from " . $this->table . " where login = '" . $data['login'] . "'";
    }
    public function Update(array $data, int $id)
    {
        return "UPDATE " . $this->table . " SET `login`='" . $data['login'] . "',`pass`=" . $data['pass'] . ",`name`='" . $data['name'] . "' WHERE id = " . $id;
    }
}
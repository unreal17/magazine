<?
class Comment extends Query
{
    public function __construct()
    {
        $this->table = "report";
    }
    public function SelectById(int $id)
    {
        return "Select * from" . $this->table . " where id = " . $id;
    }
    public function Insert(array $data)
    {
        return "INSERT INTO `$this->table` (`name`, `mail`, `phone`,`text`) VALUES('" . $data['name'] . "', '" . $data['mail'] . "', '" . $data['phone'] . "', '" . $data['text'] . "')";
    }
    public function CheckUniqueness(array $data)
    {

    }
    public function Update(array $data, int $id)
    {
        
    }
}
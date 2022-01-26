<?
class Images extends Query
{
    public function __construct()
    {
        $this->table = "images";
    }
    public function SelectById(int $id)
    {
        return "Select * from" . $this->table . " where id = " . $id;
    }
    public function Insert(array $data)
    {
        return "INSERT INTO `$this->table` (`fio`, `text`, `name_photo`,`dir`) VALUES('" . $data['fio'] . "', '" . $data['text'] . "', '" . $data['name_photo'] . "', '" . $data['dir'] . "')";
    }
    public function CheckUniqueness(array $data)
    {
        
    }
    public function Update(array $data, int $id)
    {
        
    }
}
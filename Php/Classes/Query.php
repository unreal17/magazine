<?
abstract class Query
{
    protected string $table;

    public function SelectAll()
    {
        return "Select * from " . $this->table;
    }

    abstract public function SelectById(int $id);

    public function SelectWhere(string $where)
    {
        return "Select * from " . $this->table . " where " . $where;
    }

    abstract public function Insert(array $data);

    public function Delete(int $id)
    {
        return "DELETE from " . $this->table . " where id = " . $id;
    }

    abstract public function CheckUniqueness(array $data);

    abstract public function Update(array $data, int $id);
}
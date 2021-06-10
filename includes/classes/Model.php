<?php


class Model
{
    protected $tableName;
    private $pdo;

    public function __construct() {
        include __DIR__ . '/../../config.php';

        $this->pdo = new PDO($dns, $user, $password);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function query($sql, $params = [])
    {
        $query = $this->pdo->prepare($sql);

        $query->execute($params);

        $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        return $query;
    }

    public function get($column, $value)
    {
        $sql = "SELECT * FROM $this->tableName WHERE $column = :$column";

        $params = [":$column" => $value];

        $query = $this->query($sql, $params);

        return $query->fetch();
    }

    public function getAll($where = [], $params = [])
    {
        $sql = "SELECT * FROM $this->tableName";

        if ($where) {
            $sql .= ' WHERE ';

            foreach ($where as $key => $_) {
                $sql .= "$key = :$key AND ";
            }

            $sql = rtrim($sql, ' AND ');
        }

        if (isset($params['order_by'])) {
            if ($params['order_by'][0] === '-') {
                $sql .= ' ORDER BY ' . substr($params['order_by'], 1) . ' DESC';
            } else {
                $sql .= ' ORDER BY ' . $params['order_by'] . ' ASC';
            }
        }

        if (isset($params['limit'])) {
            $sql .= ' LIMIT ' . $params['limit'];
        }

        if (isset($params['offset'])) {
            $sql .= ' OFFSET ' . $params['offset'];
        }

        $query = $this->query($sql, $where);

        return $query->fetchAll();
    }

    private function create($fields)
    {
        $columns = '';
        $params = '';

        $sql = "INSERT INTO $this->tableName (";

        foreach ($fields as $key => $_) {
            $columns .= "$key,";
            $params .= ":$key,";
        }

        $columns = rtrim($columns, ',');
        $params = rtrim($params, ',');

        $sql = $sql . $columns . ') VALUES (' . $params . ')';

        return $this->query($sql, $fields);
    }

    private function update($fields)
    {
        $sql = "UPDATE $this->tableName SET ";

        foreach ($fields as $key => $_) {
            $sql .= "$key = :$key,";
        }

        $sql = rtrim($sql, ',');

        $sql .= ' WHERE id = :id';

        return $this->query($sql, $fields);
    }

    public function save($fields)
    {
        if (is_null($fields['id'])) {
            return $this->create($fields);
        }

        return $this->update($fields);
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->tableName WHERE id = :id";
        $params = [':id' => $this->id];

        return $this->query($sql, $params);
    }
}
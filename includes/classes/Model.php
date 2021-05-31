<?php

include_once 'DbConnection.php';

class Model extends DbConnection
{
    protected $_tableName;

    private function query($sql, $params = [])
    {
        $query = $this->_pdo->prepare($sql);

        $query->execute($params);

        return $query;
    }

    public function get($column, $value)
    {
        $sql = "SELECT * FROM $this->_tableName WHERE $column = :$column";

        $params = [":$column" => $value];

        $query = $this->query($sql, $params);

        return $query->fetch();
    }

    public function getAll($where = [], $params = [])
    {
        $sql = "SELECT * FROM $this->_tableName";

        if ($where) {
            $sql .= ' WHERE ';

            foreach ($where as $key => $value) {
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

    public function create()
    {
        $columns = '';
        $values = '';
        $params = [];

        $sql = "INSERT INTO $this->_tableName (";

        foreach ($this as $key => $value) {
            if ($key[0] !== '_') {
                $columns .= "$key,";
                $values .= ":$key,";
                $params[":$key"] = $value;
            }
        }

        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');

        $sql = $sql . $columns . ') VALUES (' . $values . ')';

        $this->query($sql, $params);
    }

    public function update($fields)
    {
        $sql = "UPDATE $this->_tableName SET ";

        foreach ($fields as $key => $value) {
            $sql .= "`$key` = :$key,";
        }

        $sql = rtrim($sql, ',');

        $sql .= " WHERE $this->primaryKey = :$this->primaryKey";

        $fields['primaryKey'] = $fields['id'];

        $this->query($sql, $fields);
    }
}
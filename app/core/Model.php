<?php
namespace App\Core;

use PDO;

class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getTable()
    {
        return $this->table;
    }

    private function sanitizeIdentifier($name)
    {
        return preg_replace('/[^a-zA-Z0-9_\.`]+/', '', $name);
    }

    private function sanitizeOrderBy($orderBy)
    {
        return preg_replace('/[^a-zA-Z0-9_\.` ,]+/', '', $orderBy);
    }

    public function all($orderBy = 'id ASC')
    {
        $orderBy = $this->sanitizeOrderBy($orderBy);
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $pk = $this->sanitizeIdentifier($this->primaryKey);
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$pk} = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function where($field, $value, $orderBy = 'id ASC')
    {
        $field = $this->sanitizeIdentifier($field);
        $orderBy = $this->sanitizeOrderBy($orderBy);
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = ? ORDER BY {$orderBy}");
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }

    public function whereFirst($field, $value)
    {
        $field = $this->sanitizeIdentifier($field);
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1");
        $stmt->execute([$value]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $keys = array_map([$this, 'sanitizeIdentifier'], array_keys($data));
        $columns = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $sets = '';
        $keys = array_map([$this, 'sanitizeIdentifier'], array_keys($data));
        foreach ($keys as $key) {
            $sets .= "{$key} = :{$key}, ";
        }
        $sets = rtrim($sets, ', ');
        $data[$this->primaryKey] = $id;
        $pk = $this->sanitizeIdentifier($this->primaryKey);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$sets} WHERE {$pk} = :{$this->primaryKey}");
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $pk = $this->sanitizeIdentifier($this->primaryKey);
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$pk} = ?");
        return $stmt->execute([$id]);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function queryFirst($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function beginTransaction()
    {
        Database::beginTransaction();
    }

    public function commit()
    {
        Database::commit();
    }

    public function rollback()
    {
        Database::rollback();
    }
}

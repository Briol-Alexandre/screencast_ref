<?php

namespace App\models;

use Core\Database;

class Attendance extends Database
{
    protected string $table = 'attendances';

    public function setRole(array $data): bool
    {
        $sql = <<<SQL
            UPDATE $this->table 
            SET role = :role 
            WHERE contact_id = :contact_id
            AND jiri_id = :jiri_id
        SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue('role', $data['role']);
        $statement->bindValue('contact_id', $data['contact_id']);
        $statement->bindValue('jiri_id', $data['jiri_id']);
        return $statement->execute();

    }

    public function delete(array|string $id): bool
    {
        $sql = <<<SQL
        DELETE FROM $this->table
        WHERE contact_id = :contact_id
        AND jiri_id = :jiri_id
SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue('contact_id', $id['contact_id']);
        $statement->bindValue('jiri_id', $id['jiri_id']);
        return $statement->execute();

    }
}
<?php
/**
* This PHP class allows you to build your database.
*/
class Builder extends Database
{
    /**
    * Insert column
    * @param string $table Target table
    * @param string $column Target column
    * @param string $type Data type
    * @param string $after Position
    * @return PDOStatement Return the sql request constructor and the PDO statement
    */
    public function insertColumn($table, $column, $type, $after)
    {
        $sql = <<<EOT
            ALTER TABLE $table ADD $column $type NOT NULL AFTER $after; 
        EOT;

        $return = $this->execute($sql);
        return $return;
    }

    /**
    * Delete column
    * @param string $table Target table
    * @param string $column Target column
    * @return PDOStatement Return the sql request constructor and the PDO statement
    */
    public function deleteColumn($table, $column)
    {
        $sql = <<<EOT
            ALTER TABLE $table
            DROP COLUMN $column;
        EOT;

        $return = $this->execute($sql);
        return $return;
    }
}

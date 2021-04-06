<?php
/**
* dataman v1.0
*
* https://github.com/Apter-X/dataman
*
* This PHP class is a database builder
*/
class Builder extends Query
{
    public function ping()
    {
        return "Pong!";
    }

    /**
    * Insert column
    * @param string $table Target table
    * @param string $column Target column
    * @param string $type Data type
    * @param string $after Position
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
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
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
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

<?php
/**
* dataman v1.0
*
* https://github.com/Apter-X/dataman
*
* This PHP class construct and execute query.
*/
Class Query extends Builder 
{
    /**
    * Select table
    * @param string $table Target table
    * @return array Return the target value
    */
    public function selectTable($table, $refKey = NULL, $refValue = NULL)
    {
        if(empty($refKey) && empty($refValue)){
            $sql = <<<EOT
                SELECT * FROM $table
            EOT;
        } else {
            $sql = <<<EOT
                SELECT * FROM $table WHERE $refKey='$refValue';
            EOT;
        }

        $this->setFetchMode(PDO::FETCH_ASSOC);
        $return = $this->fetch($sql);

        return $return;
    }

    /** Value **/
    /**
    * Select a specific value
    * @param string $target Target key
    * @param string $table Target table
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return string Return the target value
    */
    public function selectValue($target, $table, $refKey, $refValue)
    {
        $sql = <<<EOT
            SELECT $target FROM $table WHERE $refKey='$refValue';
        EOT;

        $this->setFetchMode(PDO::FETCH_ASSOC);
        $response = $this->fetch($sql);

        $return = implode(array_column($response, $target)); //extract the value from the associative array
        return $return;
    }

    /**
    * Update a specific value
    * @param string $table Target table
    * @param string $key Target key
    * @param string $newValue
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return PDOStatement Return the PDO statement
    */
    public function updateValue($table, $key, $newValue, $refKey, $refValue)
    {
        $sql = <<<EOT
            UPDATE $table SET $key='$newValue' WHERE $refKey='$refValue';
        EOT;

        $return = $this->execute($sql);
        return $return;
    }

    /** Row **/
    /**
    * Select row table
    * @param string $table Target table
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return array Return the fetched row
    */
    public function selectRow($table, $refKey, $refValue){
        $sql = <<<EOT
            SELECT * FROM $table WHERE $refKey='$refValue';
        EOT;

        $this->setFetchMode(PDO::FETCH_ASSOC);
        $return = $this->fetch($sql);

        return $return[0];
    }

    /**
    * Insert row table
    * @param string $table Target table
    * @param string $targets Referential keys (:key1, :key2)
    * @param object $values Row values
    * @return PDOStatement Return the PDO statement
    */
    public function insertRow($table, $targets, $values)
    {
        $entry = str_replace(':', '', $targets);

        $sql = <<<EOT
            INSERT INTO $table ($entry) VALUES ($targets);
        EOT;

        $return = $this->execute($sql, $values);
        return $return;
    }

    /**
    * Delete row
    * @param string $table Target table
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return PDOStatement Return the PDO statement
    */
    public function deleteRow($table, $refKey, $refValue){
        $sql = <<<EOT
            DELETE FROM $table WHERE $refKey='$refValue';
        EOT;

        $return = $this->execute($sql);
        return $return;
    }

    /** Column **/
    /**
    * Select column
    * @param string $column Target column
    * @param string $table Target table
    * @param string $refKey Referential key
    * @param string $refValue Value of the referential key
    * @return array Return the fetched column
    */
    public function selectColumn($column, $table, $refKey = NULL, $refValue = NULL)
    {
        if(empty($refKey) && empty($refValue)){
            $sql = <<<EOT
                SELECT $column FROM $table
            EOT;
        } else {
            $sql = <<<EOT
                SELECT $column FROM $table WHERE $refKey='$refValue';
            EOT;
        }

        $this->setFetchMode(PDO::FETCH_ASSOC);
        $fetch = $this->fetch($sql);

        $return = array_column($fetch, $column);
        return $return;
    }

    /**
    * Inner join tables
    * @param string $targets Target keys (key1, key2)
    * @param string $table1 First table
    * @param string $refKey1 First table referential key
    * @param string $refValue  Value of the referential key
    * @param string $refValue Value of the referential key
    * @return array Return the fetched columns
    */
    public function innerJoin($targets, $table1, $refKey1, $table2, $refKey2)
    {
        $sql = <<<EOT
            SELECT $targets
            FROM $table1
            INNER JOIN $table2 ON $table1.$refKey1 = $table2.$refKey2;
        EOT;

        $this->setFetchMode(PDO::FETCH_ASSOC);
        
        $return = $this->fetch($sql);

        return $return;
    }
}

<?php
/**
* dataman v1.0
*
* https://github.com/Apter-X/dataman
*
* This PHP class is a query constructor
*/
Class Query extends Database 
{
    /** Value **/
    /**
    * Select a specific value giving the table and references
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
    * Update a specific value giving the table and references
    * @param string $table Target table
    * @param string $key Target key
    * @param string $newValue
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
    */
    public function updateValue($table, $key, $newValue, $refKey, $refValue)
    {
        $sql = <<<EOT
            UPDATE $table SET $key='$newValue' WHERE $refKey='$refValue';
        EOT;

        $return = $this->execute($sql);
        return $sql . " | " . $return;
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

        return $return;
    }

    /**
    * Insert row table
    * @param string $table Target table
    * @param string $targets Referential keys (:key1, :key2)
    * @param object $values Row values
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
    */
    public function insertRow($table, $targets, $values)
    {
        $entry = str_replace(':', '', $targets);

        $sql = <<<EOT
            INSERT INTO $table ($entry) VALUES ($targets);
        EOT;

        $return = $this->execute($sql, $values);
        return $sql . " | " . $return;
    }

    /**
    * Delete row table
    * @param string $table Target table
    * @param string $refKey Referential key
    * @param string|int $refValue Value of the referential key
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
    */
    public function deleteRow($table, $refKey, $refValue){
        $sql = <<<EOT
            DELETE FROM $table WHERE $refKey='$refValue';
        EOT;

        $return = $this->execute($sql);
        return $sql . " | " . $return;
    }

    /** Column **/
    /**
    * Select column table
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
    * Delete column table
    * @param string $table Target table
    * @param string $column Target column
    * @return requestSQL|PDOStatement Return the sql request constructor and the PDO statement
    */
    public function deleteColumn($table, $column)
    {
        if(empty($refKey) && empty($refValue)){
            $sql = <<<EOT
                ALTER TABLE $table
                DROP COLUMN $column;
            EOT;
        }

        $return = $this->execute($sql);
        return $sql . " | " . $return;
    }

    /**
    * Inner join values
    * @param string $targets Target keys (key1, key2)
    * @param string $table1 First table
    * @param string $refKey1 First table referential key
    * @param string $refValue  Value of the referential key
    * @param string $refValue Value of the referential key
    * @return array Return the fetched column
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

    // Change type
    // ALTER TABLE `records` CHANGE `civ` `civ` CHAR(11) NOT NULL;

    // Change to default
    // ALTER TABLE `records` CHANGE `progress` `progress` VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'; 
}

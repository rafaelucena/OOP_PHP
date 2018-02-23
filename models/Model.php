<?php

/**
 * Interface Model
 */
interface Model
{
    public function getTableName();
    
    public function getTablePrimaryKey();
    
    public function getTableFields();
}
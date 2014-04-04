<?php

namespace HtSession\Session\SaveHandler;

class DoctrineDbalOptions extends \Zend\Session\SaveHandler\DbTableGatewayOptions
{
    /**
     * Table Name
     * @var string
     */
    protected $tableName = 'session';

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function getTableName()
    {
        return $this->tableName;
    }
}

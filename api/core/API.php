<?php

require_once 'config/Constants.php';

abstract class API
{
    public static function getDbName()
    {
        return Constants::DB_NAME;
    }
    public static function tableName()
    {
        return $_GET[Constants::GET_TABLE];
    }
    public static function method() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    public static function getData()
    {
        $method = self::method();
        if ($method === 'GET')
            return $_GET;
        if ($method === 'POST')
            return $_POST;
            // PUT, PATCH или DELETE
        $data = array();
        $exploded = explode('&', file_get_contents('php://input'));

        foreach($exploded as $pair) {
            $item = explode('=', $pair);
            if (count($item) == 2)
                $data[urldecode($item[0])] = urldecode($item[1]);
        }
        return $data;
    }
    public static function getWhere()
    {
        $where = $_GET;
        unset($where[Constants::GET_TABLE]);
        return $where;
    }    
}
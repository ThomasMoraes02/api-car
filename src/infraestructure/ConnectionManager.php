<?php 
namespace ApiCar\infraestructure;

use MongoDB\Client;

abstract class ConnectionManager
{
    public static function connect()
    {
        return self::connecMongoDB();
    }

    private static function connecMongoDB()
    {
        $connect = new Client();
        $connect = $connect->selectDatabase("api_cars");
        return $connect;
    }
}
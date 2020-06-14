<?php

namespace App\Core\Database;
Use pdo, PDOException;

/****
 * 
 * Establish the connection.
 * 
 */

class Connection 
{

    public static function make($db){
        try {
            return new PDO($db["dsn"], $db["user"], $db["password"],
            $db["options"] 
        );
        } catch(PDOException $e){
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}
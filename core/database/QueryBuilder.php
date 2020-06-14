<?php


namespace App\Core\Database;
use PDO, Exception;

class QueryBuilder
{
    protected $pdo;

    public  function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ${table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertUser($table, $user)
    {

        $reqParams = "first_name, last_name, user_password, user_email, validation_key, date_of_birth, registration_date, is_active, phone_number";
        
        $colonParams = ":" . implode(":", explode(" ", $reqParams));

        try {
            $stmt = $this->pdo->prepare("INSERT INTO ${table} ($reqParams) 
            VALUES ($colonParams)");
            
            $stmt->execute([
                "first_name" => $user["first_name"],
                "last_name" => $user["last_name"],
                "user_password" => $user["hash"], 
                "user_email" => $user["email"],
                "validation_key" => $user["token"], 
                "date_of_birth" => $user["date"],
                "registration_date" => $user["r_date"], 
                "is_active" => 0,
                "phone_number" => $user["phone_number"]
            ]);

        }catch(Exception $pe){
            echo $pe->getMessage();
        }
    }

    public function selectColumn($table, $col, $cell){
        $stmt = $this->pdo->prepare("SELECT * from $table WHERE $col = ?");
        $stmt->execute([$cell]);
        return $stmt->fetch();           
    }

    public function alreadyVerified($email, $v_code, $is_active, $table){
        $sql = "SELECT * FROM $table WHERE user_email = ? AND validation_key = ? AND is_active = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $v_code, $is_active]);
        return $stmt->fetch();
    }

    public function updateByID($id, $col_name, $col_val, $table){
        $sql = "UPDATE $table set $col_name = ? where user_id = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$col_val, $id]);
    }

}

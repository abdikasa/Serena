<?php

//define the constants
// define("DB_HOST", "");
// define("DB_USER", "");
// define("DB_PASS", "");
// define("DB_NAME", "");

// //Set data source name: connect to data-source
// $dsn = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

// //Create PDO instance and connect to the db.

// $options = [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//     PDO::ATTR_EMULATE_PREPARES => false,
// ];

// try {
//     $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
// }catch(PDOException $e){
//     throw new PDOException($e->getMessage(), (int) $e->getCode());
// }

// $stmt = $pdo->prepare('');



//set custom fetch option
//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// $stmt = $pdo->query('SELECT * FROM users');
// while ($row = $stmt->fetch()) {
//     echo $row["first_name"];
// }

## Prepared Statements: Prepare and Execute
//positional parameters aka ?, order is sensitive.
//SELECT * FROM table where col = ?;
//$stmt = $pdo->prepare($sql);
//$stmt->execute(array($col));
//$group = $stmt->fetchAll(); //more than 1
//foreach($group as $key){echo $key->column}

//Named paramters
//$sql = SELECT * FROM table where col = :col;
//$stmt->execute(['col' => $col])

//get row count from a statement
//$stmt->rowCount();

/************************************************************************** */


            //INSERTING
//================================//
// $sql = INSERT INTO table(col,col,col) VALUES (:col, :col, :col);
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['col1' => $var, 'col2' => $var2]);

            //UPDATE
//================================//
// $sql = UPDATE table SET col1 = :col1 WHERE col2 = :col2;
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['col1' => $var, 'col2' => $var2]);


            //DELETE
//================================//
// $sql = DELETE FROM table WHERE col1 = :col1;
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['col1' => $var]);


            //SEARCHING
//================================//
//$search = %John%;
// $sql = SELECT * FROM table WHERE name LIKE ?;
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$search]);
// $found = $stmt->fetchAll();
//foreach($found as $items){echo $items->xyz;}

// //database connection
// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// //check if connection doesn't succeed
// if(!$connection){
//     die("Database connection failed" . mysqli_error($connection));
// }

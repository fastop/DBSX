<?php

    require_once("myzql.php");

    $demo = new mySQL(); //Creamos la instancia de la clase...
    


/*     $ids = array(2344, 5523, 9332);

        $st = $pdo->prepare('SELECT * FROM table_name WHERE id IN (:id)');
        $st->bindParam('id', $ids);
    $st->execute();
 */

       // $data ="admin@integra.com";
       // $sql ="SELECT id_user, name, password, roles  FROM users WHERE email= :email ";

       // $REX = $demo->consultaME_SEC($sql,$data);

       // print_r($REX);
        //Tambien se podria hacer asi ...
            // $cities = array("France"=>"Paris", "India"=>"Mumbai", "UK"=>"London", "USA"=>"New York");

        $data = [];
        $data["email"] = "admin@integra.com";
        $data["name"]  = "admin";

        $sql ="SELECT id_user, name, password, roles  FROM users WHERE email= :email AND name= :name";

        //print_r(array_keys($data));
         $REX = $demo->consultaME_SEC($sql,$data);
         
    echo "<pre>";
         print_r($REX);




?>
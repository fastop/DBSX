<?php

    //include_once("myzql.php");
    require_once("myzql.php");
    
        echo "Demo  <br> <br> <br> <br>";


        $demo = new mySQL(); //Creamos la instancia de la clase...


            $sql = "  CREATE TABLE __NUSHIT__ (
                id_blank int(10)  NOT NULL AUTO_INCREMENT,
                id_brand int(10)  NOT NULL,
                id_color int(10)  NOT NULL,
                id_model int(10)  NOT NULL,
                id_size int(10)  NOT NULL,
                price double NOT NULL,
                id_customer int(10)  NOT NULL,
                status int(10)  NOT NULL,
                PRIMARY KEY (id_blank)
            );"; 

        $resultado = $demo->consultaME( $sql );

 print_r( $resultado );



?>
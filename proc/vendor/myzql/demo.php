<?php

    //include_once("myzql.php");
    require_once("myzql.php");
    
        echo "Demo  <br> <br> <br> <br>";


        $demo = new mySQL(); //Creamos la instancia de la clase...
    

//        $demo->testo();



        $resultado = $demo->consultaME("SELECT * FROM users",true);
        //$resultado = $demo->consultaME("SELECT * FROM users");

//        print_r($resultado);
          echo  count($resultado);

         // Mostrar resultados
           foreach ($resultado as $row) 
           {
                echo $row["FullName"]."<br/>";
                  //echo $row["Phone"]."<br/>";
            }

           


//         $ARG=  $demo->conexion("root","s", "axios_db","localhost");
//            print_r($ARG);

//          $resultado = $demo->consultaME("SELECT * FROM users");

/************************************************************* */
/************************************************************* */
/*  INSERTANDO ANDO */
/************************************************************* */

        $query="INSERT INTO users VALUES (0, 'demo remo X', '123456', '', 'Admin@Axios.com', '$2b$10\$St1.hERTzpn8nAi31412SuX9Ot5bZZZdMLd1PFaQHpgeL1gIeEPdO', 'MX', 'BC', 'ENS', '22820', 'calle Segunda y Hidalgo', 'Pacific', 'OMNIELLIS', 'axiosENS', '2019-05-05  10:11:00', '2019-05-05  10:11:00', '2019-05-05  10:11:00', 0, 1, 'YroB2PHdlZupCmCCwrW4Y90nDnFndh86Y0tVUE7aAaCDoFyhSpsoVZpqjykt', 1, 1, 1);";
        $query.="INSERT INTO users VALUES (0, 'demo remo XX', '123456', '', 'Admin@Axios.com', '$2b$10\$St1.hERTzpn8nAi31412SuX9Ot5bZZZdMLd1PFaQHpgeL1gIeEPdO', 'MX', 'BC', 'ENS', '22820', 'calle Segunda y Hidalgo', 'Pacific', 'OMNIELLIS', 'axiosENS', '2019-05-05  10:11:00', '2019-05-05  10:11:00', '2019-05-05  10:11:00', 0, 1, 'YroB2PHdlZupCmCCwrW4Y90nDnFndh86Y0tVUE7aAaCDoFyhSpsoVZpqjykt', 1, 1, 1);";
        $query.="INSERT INTO users VALUES (0, 'demo remo XXX', '123456', '', 'Admin@Axios.com', '$2b$10\$St1.hERTzpn8nAi31412SuX9Ot5bZZZdMLd1PFaQHpgeL1gIeEPdO', 'MX', 'BC', 'ENS', '22820', 'calle Segunda y Hidalgo', 'Pacific', 'OMNIELLIS', 'axiosENS', '2019-05-05  10:11:00', '2019-05-05  10:11:00', '2019-05-05  10:11:00', 0, 1, 'YroB2PHdlZupCmCCwrW4Y90nDnFndh86Y0tVUE7aAaCDoFyhSpsoVZpqjykt', 1, 1, 1);";
        $query.="INSERT INTO users VALUES (0, 'demo remo XXXX', '123456', '', 'Admin@Axios.com', '$2b$10\$St1.hERTzpn8nAi31412SuX9Ot5bZZZdMLd1PFaQHpgeL1gIeEPdO', 'MX', 'BC', 'ENS', '22820', 'calle Segunda y Hidalgo', 'Pacific', 'OMNIELLIS', 'axiosENS', '2019-05-05  10:11:00', '2019-05-05  10:11:00', '2019-05-05  10:11:00', 0, 1, 'YroB2PHdlZupCmCCwrW4Y90nDnFndh86Y0tVUE7aAaCDoFyhSpsoVZpqjykt', 1, 1, 1);";                        

         //echo $demo->insertAll($query,true);

/************************************************************* */
/************************************************************* */
/*  INSERTANDO UNO ANDO */
/************************************************************* */
      $queryx="INSERT INTO usersx VALUES (0, 'demo remo BABAB', '123456', '', 'Admin@Axios.com', '$2b$10\$St1.hERTzpn8nAi31412SuX9Ot5bZZZdMLd1PFaQHpgeL1gIeEPdO', 'MX', 'BC', 'ENS', '22820', 'calle Segunda y Hidalgo', 'Pacific', 'OMNIELLIS', 'axiosENS', '2019-05-05  10:11:00', '2019-05-05  10:11:00', '2019-05-05  10:11:00', 0, 1, 'YroB2PHdlZupCmCCwrW4Y90nDnFndh86Y0tVUE7aAaCDoFyhSpsoVZpqjykt', 1, 1, 1)";
      

    //  echo $demo->insertaMEx($queryx,true); //Con la shit    
     // echo $demo->insertaMEx($queryx); //Sin la shit



/************************************************************* */
/************************************************************* */
/*  MODIFICANDO UNO ANDO */
/************************************************************* */
            $quero="UPDATE users SET FullName='DEMO MOsD' WHERE id=74";
          //  echo $demo->modMe($quero,true);

            //echo $demo->modFrom("users","FullName='HOLO MODO', Phone='111222333'","id=",true);




/************************************************************* */
/************************************************************* */
/*  MODIFICANDO MUCHOS A LA VEZ */
/************************************************************* */

            $querom="UPDATE users SET FullName='DEMO A1' WHERE id=74;";
            $querom.="UPDATE usersx SET FullName='DEMO B1' WHERE id=75;";
            $querom.="UPDATE users SET FullName='DEMO C1' WHERE id=76;";
            $querom.="UPDATE usersx SET FullName='DEMO C1' WHERE id=77;";
            
            
        //   echo $demo->modAll($querom);
            


/************************************************************* */
/************************************************************* */
/*  ELIMINANDO UNO A LA VEZ */
/************************************************************* */

            $querod="DELETE FROM users WHERE id=74";

           // echo $demo->delME($querod);
           // echo $demo->delFrom("users","id=76");


/************************************************************* */
/************************************************************* */
/*  ELIMINANDO MUCHOS A LA VEZ */
/************************************************************* */


            $querodx="DELETE FROM users WHERE id=75;";
            $querodx.="DELETE FROM users WHERE id=77;";

            //echo $demo->delAll($querodx);  


/************************************************************* */
/************************************************************* */
/*  CONTANDO  */
/************************************************************* */


        $resultado = $demo->consultaME("SELECT * FROM users",true);
        //$resultado = $demo->consultaME("SELECT * FROM users");

//        print_r($resultado);
//          echo  count($resultado);

        echo $demo->howMany($resultado);



?>
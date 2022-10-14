<?php

    require_once("crypto.php");
    


     $CRYPT = new Crypto(); //Realizamos la instancia 
     
     
 /************************************************************* */
/************************************************************* */
/*               CREANDO CONTRASEñA */
/************************************************************* */

        $RawPass = "Coordinador";

        $nPASS = $CRYPT->passwGenerator($RawPass); //Encriptamos el string dado... 
                                                //SIEMPRE debe de dar algo diferente, pero de base es lo mismo.
        echo $nPASS."<br><br>";

        $nCheck = $CRYPT->passwCheck($RawPass, $nPASS); //Con esto verificamos si el password es o no es...



        echo "Es <small><strike>".$nPASS."</strike></small> IGUAL a '".$RawPass."'?  => ".$nCheck;

echo "<br><br>";
 /************************************************************* */
/************************************************************* */
/*               GENERAMOS EL HASH DEL ID  */
/************************************************************* */
// 
//     $nID = $CRYPT->genEx("666");
//     echo "666 => ".$nID;
// 
// echo "<br>";
// 
//     $nID = $CRYPT->genEx("111");
//     echo "111 => ".$nID;
// 
//     echo "<br><br><br><br>";
//     $KODE ="5607";
//     $nID = $CRYPT->genEx($KODE);
//     echo  $KODE." => ".$nID;

    
    

?>
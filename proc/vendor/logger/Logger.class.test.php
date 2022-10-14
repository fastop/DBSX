<?php



require_once("../myzql/myzql.php");
require_once("Logger.class.php");

$MDB = new mySQL(); //Creamos la instancia de la clase...
$L = new Logger($MDB, 3); //Creamos la instancia (alimentada con la instancia de la BD)





$L->log_v("Titulo del Log","Descripción del Evento ocurrido","Extra Option");
  
 
 
echo "Insertado?";






?>
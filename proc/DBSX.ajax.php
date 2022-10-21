<?php
/** ****************************************************
 *  @file DBSX.ajax.php								 
 *														 
 *  @brief Pasarela para peticiones ajax ...
 *													 
 *  @author DRV                       			 
 *  @date Octubre 2022
 *            								  		 
 *  @version 1.0           			
 ****************************************************** */ 

  require "vendor/myzql/myzql.php"; //Clase con los metodos de cargado
  require "DBSX.class.php"; //Clase con los metodos de cargado

  $REX = new mySQL();
  $DBS = new DBSX($REX);
 




  switch($_POST["opc"])
  {
      case 1: {//Obtenemos la lista con las tablas (Y conteos)
                echo $DBS->getTableListFrom($_POST["dbs"]);
                break;
              }
      case 2: {//Hacemos la comparativa de las bases de datos ...
                echo $DBS->compareTables($_POST["DBA"], $_POST["DBB"]);
                break;
              } 
      case 3: {
               echo $DBS->getTableCombo($_POST["dbx"], $_POST["elemetx"]);
               break;
              }               
}
    







?>
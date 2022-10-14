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
      case 2: {
                break;
              } 
}
    







?>
<?php
/** ****************************************************
 *  @file DBSX.test.php								 
 *														 
 *  @brief Archivo principal para procesamiento ...
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

   echo "<pre>";

    // $RES = $DBS->getDatabases();
    // print_r($RES);


     // echo $DBS->getDatabaseCombo("cmbMeLaPelas");
     // echo "<br>";
     // echo $DBS->getDatabaseCombo("cmbMeLaPelas2");

  

   //  print_r($DBS->getTables("estimates"));
   //  echo "<br>";
 
   //  print_r($DBS->getTables("estimates_clean"));
   //  echo "<br>";

     //print_r($DBS->getTablesFrom("demo-test"));
     //echo "<br>";
     // echo $DBS->getTableListFrom("demo-test");
     // echo "<br><br><br><br>";
 
     // print_r($DBS->getTablesFrom("estimates"));
     // echo "<br>";
     //  echo $DBS->getTableListFrom("estimates");
 



       //$SS = $DBS->searchTableOnDB("estimates", "colorssss");
//
       //if($SS)
       // echo "EXISTE wiwiw";
       //else
       // echo "NO EXISTE, BUUUU";
//
//
//        $DBS->compareTables("estimates","estimates_server_server-a");



    // echo $DBS->compareRows("estimates","estimates_server_server-a","brands");

 //     print_r( $DBS-> hasChanges("estimates_server_server-a","estimates","trims"));

    // print_r( $DBS->hasChanges("estimates","estimates_server_server-a","trims"));
 

  //  print_r( $DBS->hasChangesMini("estimates","estimates_server_server-a","trim"));
    



     //  $DBS->compareData("estimates","brands","estimates_server","brands");  
      // $DBS->compareData("estimates_server","colors","estimates","colors");
        $DBS->compareData("estimates_server","labors","estimates","labors");

     // $DBS->compareData("estimates","customers","estimates_server","customers");



?>
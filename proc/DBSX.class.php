<?php
/** ****************************************************
 *  @file DBSX.class.php								 
 *														 
 *  @brief Archivo principal para procesamiento ...
 *													 
 *  @author DRV                       			 
 *  @date Octubre 2022
 *            								  		 
 *  @version 1.2          			
 ****************************************************** */ 


 class DBSX { 

        private $CONN; //Conexion a base de datos
    
        /* CONSTRUCTOR */
        function __construct($conx) {   //Inicializamos en el constructor...                     
            $this->CONN = $conx; //Conector MySQL
        }
    


        /** 
         *   @brief Metodo para obtener la lista de bases de datos

         *   @return  REX   Lista con los elementos (array)
         */        
        function getDatabases()
        {
            $sql ="SHOW DATABASES";            
             $REX = $this->CONN->consultaME($sql);

            return $REX;
        }
        


        /** 
         *   @brief Metodo para obtener el componente de lista
         *     
         *   @param name	Nombre del elemento a mostrar (string)
         *   @return  LST   Lista con los elementos (string/html)
         */
        function getDatabaseCombo($name)
        {

            $RES = $this->getDatabases();
            
            $LST = "<datalist id='data_".$name."'>";

            foreach($RES as $res){
                $LST .= "<option value='".$res["Database"]."'>";
            }
          
            $LST .= "</datalist>";
            $LST .= "<input type='text' class='form-select' placeholder='Select Database' name='".$name."' id='".$name."' list='data_".$name."'>";

          return $LST;
        }





        /** 
         *   @brief Metodo para obtener el componente de lista
         *     
         *   @param db	Nombre de la base de datos (string)
         *   @return LST   Lista con los elementos (string/html)
         */
        function getTableCombo($db, $table)
        {

            $RES = $this->getTablesFrom($db);
             
            $LST = "<datalist id='data_".$db."'>";
             
             foreach($RES as $res){
                 $LST .= "<option value='".$res["Tables_in_".$db]."'></option>";
             }
           
             $LST .= "</datalist>";
             $LST .= "<input type='text' class='form-select DATA_TABLE' placeholder='Select Table' data-parent='".$db."'' name='table_".$db."' id='table_".$db."' list='data_".$db."'>";

          return $LST;
        }





        /** 
         *   @brief Metodo para obtener el listado de tablas dentro de cierta base de datos
         *     
         *   @param db	Nombre de la base de datos (string)
         * 
         *   @return 
         *    Si existe    retorna true y el id del cliente     array(int, bool)
         *    Si NO existe retorna false y como id, 0           array(int, bool)(bool)
         */
        function getTablesFrom($db)
        {

            $sql ="SHOW TABLES FROM `".$db."`";//IMPORTANTE estos Backticks para los nombres con guion
            $REX = $this->CONN->consultaME($sql);

           return $REX;
        }




        function getTableListFrom($db)
        {

            $RES = $this->getTablesFrom($db);
            
            $LST = "";

            foreach($RES as $i=>$res){


                $table = $res["Tables_in_".$db];

                $CC =  $this->getCountedElements($db, $table);

                $LST .= "<li class='list-group-item d-flex justify-content-between lh-sm MELEMENT'>
                        <div> <h6 class='my-0'>".$table."</h6> <small class='text-muted'>Cantidad de elementos</small></div>
                        <span class='text-muted'>".$CC."</span> </li>";
            }

        
            return $LST;
        }


        /** 
         *   @brief Metodo para obtener la cantidad de elementos que existen en una tabla
         *          
         *   @param db  	Nombre de la base de datos (string)
         *   @param tname	Nombre de la tabla (string)
         *   @return tc     Table Count, Cantidad de elementos en la tabla (int)
         */
        function getCountedElements($db, $tname)
        {

            $sql = "SELECT count(*) AS CC FROM `".$db."`.`".$tname."`";
            $REX = $this->CONN->consultaME($sql);

          return $REX[0]["CC"];
        }



        /** 
         *   @brief Metodo para comparar la tabla ALPHA con la BETA
         *     
         *   @param ALPHA		Base de datos ALPHA (string)
         *   @param BETA		Base de datos BETA (string)
         * 
         *   @return ALPHA_RES  Lista de comparaciones 
         */
        function compareTables($ALPHA, $BETA)
        {
        
            $ALPHA_RES = "";            
            $ALPHA_TABLE = $this->getTablesFrom($ALPHA);

            foreach($ALPHA_TABLE as $atable){

                $ALPHA_RES .= "<tr><td>".$atable["Tables_in_".$ALPHA]."</td>";
                $T1X = $atable["Tables_in_".$ALPHA];


                    if($this->searchTableOnDB($BETA, $T1X))
                    { //SI existe... Revisamos el dato ... 
                        $ALPHA_RES .= "<td>🟢</td>";            

                        $RT = $this->hasChanges($ALPHA, $BETA, $T1X);

                     //   echo $T1X."<br>";
                     //   print_r($RT);

                        if($RT["flag"]){

                            $fields ="";

                                foreach($RT["LL"] as $key => $field){
                                     $side = explode("_",$key);
                                    $fields .= "[".$side[0]."] ".$field."<br/>";
                                }

                                $box = "<span class='btn btn-light' type='button' data-bs-toggle='collapse' data-bs-target='#col".$T1X."' 
                                        aria-expanded='false' aria-controls='col".$T1X."'> 🔴</span>
                                         <div><div class='collapse collapse-horizontal' id='col".$T1X."'>
                                         <div class='card card-body' style='width: 100%;'>
                                         ".$fields."
                                         </div></div></div>";

                             $ALPHA_RES .= "<td>".$box."</td>";

                        }                            
                        else
                        $ALPHA_RES .= "<td>🟢</td>"; 
                             


                        //Comparemos la cantidad de elementos per row
                        $CC = $this->compareRows($ALPHA, $BETA, $T1X); 

                        
                        if($CC["DIF"]>0){

                                $classA = ($CC["A1"] > $CC["B1"])?"text-danger":"";
                                $classB = ($CC["A1"] < $CC["B1"])?"text-danger":"";
                       
                            $box = "<span class='btn btn-light' type='button' data-bs-toggle='collapse' data-bs-target='#col".$T1X."' 
                                    aria-expanded='false' aria-controls='col".$T1X."'> ".$CC["DIF"]." </span>
                                    <div><div class='collapse collapse-horizontal' id='col".$T1X."'>
                                    <div class='card card-body w-100'>
                                    <b class='".$classA."'>Table 1 </b> ".$CC["A1"]."<br/>
                                    <b class='".$classB."'>Table 2 </b> ".$CC["B1"]."
                                    </div></div></div>";
                        }
                        else
                            $box = $CC["DIF"];


                        // $ALPHA_RES .= " <td><span class='d-inline-block pointer' tabindex='0' data-bs-toggle='tooltip' title=' T1: ".$CC["A1"]." - ".$CC["B1"]." : T2'> ".$CC["DIF"]."</span></td></tr>";
                        $ALPHA_RES .= " <td> ".$box."</td></tr>";





                    }
                    else //SI no existe
                    {
                        $ALPHA_RES .= "<td>🔴</td>";
                        $ALPHA_RES .= "<td> - </td><td> - </td></tr>";
                        // $ALPHA_RES .=  "<tr><td >Tabla 1 sasd asd asd</td><td>🟢</td><td>🟢</td><td>45</td></tr>";
                    }
 


              $ALPHA_RES .= "</tr>";
            }

            echo $ALPHA_RES;

        }


        /** 
         *   @brief Tal y como el nombre lo dice, buscamos si esta tabla se encuentra en una base de datos.
         *     
         *   @param BD		Nombre de la base de datos (string)
         *   @param TABLE	Nombre de la tabla a buscar (string)
         * 
         *   @return count  Regresará 1 o 0  [Existe:No existe] (int|bool)
         * 
         */
        function searchTableOnDB($BD, $TABLE)
        {
            $COL_NAME = "`Tables_in_".$BD."`"; //Acomodo todo puerilmente para que se entienda mas
            $stable = "SHOW TABLES FROM `".$BD."` WHERE ".$COL_NAME ."= '".$TABLE."'";

            $REX = $this->CONN->consultaME($stable); //Pude haber hecho un 'One Liner' pero quedaria inentendible

          return count($REX);
        }



        /** 
         *   @brief Metodo para comparar la cantidad de elementos para saber si hay nuevas rows
         *     
         *   @param BDA		Nombre de la primera base de datos (string)
         *   @param BDB		Nombre de la segunda base de datos (string)
         *   @param TABLE		Nombre de la tabla comun (string)
         * 
         *   @return RESS   Cantidad de elementos diferentes, cantidad del primero y del segundo (Array)
         */
        function compareRows($BDA, $BDB, $TABLE)
        {

            $T1X ="SELECT count(*) AS CC FROM `".$BDA."`.`".$TABLE."`";
            $T2X ="SELECT count(*) AS CC FROM `".$BDB."`.`".$TABLE."`";

            $R1 = $this->CONN->consultaME($T1X); //Pude haber hecho un 'One Liner' pero quedaria inentendible
            $R2 = $this->CONN->consultaME($T2X);


            $RES = $R1[0]["CC"] - $R2[0]["CC"];
            $RESS["DIF"] = ($RES<0)? $RES *-1 : $RES; //Siempre positivos
            $RESS["A1"] = $R1[0]["CC"];
            $RESS["B1"] = $R2[0]["CC"];

          return $RESS;
        }


        /** 
         *   @brief Metodo para comprobar cambios en los elementos de la tabla 
         *     
         *   @param BDA		Nombre de la primera base de datos (string)
         *   @param BDB		Nombre de la segunda base de datos (string)
         *   @param TABLE		Nombre de la tabla comun (string)
         * 
         *   @return REX   Resultados de elementos (array)
         */
        function hasChanges_OLD($BDA, $BDB, $TABLE)
        {

            $T1X ="DESCRIBE `".$BDA."`.`".$TABLE."`";
            $T2X ="DESCRIBE `".$BDB."`.`".$TABLE."`";

            $TR1 = $this->CONN->consultaME($T1X);
            $TR2 = $this->CONN->consultaME($T2X);

            //Pre armamos los counts ...
            $XTR1 = count($TR1);
            $XTR2 = count($TR2);

                $REX["flag"] = 0;
                $LIST = [];


                //El "Problema" de este es que solamente es de un lado y quiero ver de los dos                         
                foreach($TR1 as $tr1){                                                            
                    foreach($TR2 as $j => $tr2){ //We Seearch

                        if($tr1["Field"] !== $tr2["Field"])
                        {
                            if($j == $XTR2-1 )//Si recorrimos todo
                            {                         
                                $REX["flag"] = 1; //Me vale pito, con uno ya falseo
                                $stmp = ($XTR2 <= $XTR1)?$tr1["Field"]:$tr2["Field"];//Vamos haciendo una estupidez xd
                                array_push($LIST,  $stmp); //$tr1["Field"]);
                            }
                        }
                        else
                            break;                        
                    }
                }

                
                $REX["LL"] = $LIST;

           return $REX;
        }

        function hasChanges($BDA, $BDB, $TABLE)
        {
            $T1X ="DESCRIBE `".$BDA."`.`".$TABLE."`";
            $T2X ="DESCRIBE `".$BDB."`.`".$TABLE."`";

            $TR1 = $this->CONN->consultaME($T1X);
            $TR2 = $this->CONN->consultaME($T2X);

            //Pre armamos los counts ...
            $XTR1 = count($TR1);
            $XTR2 = count($TR2); 

 
                // fusionamos los arreglos
                  $FUSION = $this->arrayFusion($TR1, $TR2);

                  $REX["flag"] = (count($FUSION)>0)?1:0;
                  $REX["LL"] = $FUSION;
             
                // $ALPHA_RES ="";

                // foreach($TR1 as $str1){                
                //         if(array_search($TR1[0]["Field"],  $REX["LL"]))
                //         {                            
                //            $box = "<span class='btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#col".$TR1[0]["Field"]."' 
                //                    aria-expanded='false' aria-controls='col".$TR1[0]["Field"]."'> 🔴</span>
                //                     <div><div class='collapse collapse-horizontal' id='col".$TR1[0]["Field"]."'>
                //                     <div class='card card-body' style='width: 300px;'>
                //                         ASSDASDASD
                //                     </div></div></div>";

                //             $ALPHA_RES .= "<td>".$box."</td>";                         
                //         }
                //         else
                //             $ALPHA_RES .= "<td>🟢</td>"; 
                // }
                 

           return $REX;
        }        
 
        function arrayFusion($AX1, $AX2)
        {             
            foreach($AX1 as $i=>$ax1){
                $BIG_ARRAY_A["1_".$i] = $ax1["Field"];
            }

            foreach($AX2 as $i=>$ax2){
                $BIG_ARRAY_B["2_".$i] = $ax2["Field"];
            } 
 
 
            $resultA=array_diff($BIG_ARRAY_A, $BIG_ARRAY_B); 
            $resultB=array_diff($BIG_ARRAY_B, $BIG_ARRAY_A);

            $REX = array_merge($resultA,$resultB);

          return $REX;        
        }
 

        /** 
         *   @brief version sencilla de hasChanges
         *     
         *   @param BDA		Nombre de la primera base de datos (string)
         *   @param BDB		Nombre de la segunda base de datos (string)
         *   @param TABLE		Nombre de la tabla comun (string)
         * 
         *   @return RES   Cantidad de elementos diferentes (int)
         */
        function hasChangesMini($BDA, $BDB, $TABLE){

                // 1.- Obtenemos la lista de elementos de la tabla A
                // 2.- SI existe... ya chingamos GREEN, Si no... RED 
                // 3.- 

                //Buscamos la tabla 
                $T1X ="SHOW COLUMNS FROM `".$BDA."`.`".$TABLE."` LIKE '".$TABLE."'";

                echo $T1X;

 
        }


 }//FINdeCLASS
 


 


?>

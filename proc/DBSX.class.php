<?php
/** ****************************************************
 *  @file DBSX.class.php								 
 *														 
 *  @brief Archivo principal para procesamiento ...
 *													 
 *  @author DRV                       			 
 *  @date Octubre 2022
 *            								  		 
 *  @version 1.0           			
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


                    if($this->searchTableOnDB($BETA, $atable["Tables_in_".$ALPHA]))
                    { //SI existe... Revisamos el dato ... 

                        $ALPHA_RES .= "<td>🟢</td>";
                        $ALPHA_RES .= "<td>🟢</td><td>45</td></tr>";
                        $ALPHA_RES .= "<td>45</td>";

                    }
                    else
                    {
                        // $ALPHA_RES .=  "<tr><td>Tabla 1 sasd asd asd</td><td>🟢</td><td>🟢</td><td>45</td></tr>";
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
            $stable = "SHOW TABLES FROM estimates WHERE ".$COL_NAME ."= '".$TABLE."'";

            $REX = $this->CONN->consultaME($stable); //Pude haber hecho un 'One Liner' pero quedaria inentendible

          return count($REX);
        }


 }//FINdeCLASS
 


 


?>
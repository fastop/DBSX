<?php
/** ****************************************************
 *  @file Logger.class.php								 
 *														 
 *  @brief Clase para el manejo de eventos (logs) dentro
 *  del sistema
 *													 
 * @author DRV                       			 
 * @date Julio 2020                           			 
 *            								  		 
 * @version 1.0           			
 ****************************************************** */ 


class Logger {
    
    private $MDB, $UID;

    /**
     * CONSTRUCTOR
     */
    function __construct($conx, $UID) {   //Inicializamos en el constructor...                     
        $this->MDB = $conx; //Conector MySQL
        $this->UID = $UID;
    }



/** 
 *   @brief Metodo insertar en eventos (log)
 *
 *   @param $titulo         Titulo de evento (string)
 *   @param $descripcion    Descripcion del evento (string)
 *   @param $type           Tipo de evento (segun listado de tipos)... (integer)
 *
 *   @return 
 *    Si el log se inserto en el sistema retorna verdadero (bool)
 *    Si el log NO se inserto correctamente en el sistema retorna falso (bool)
 */   
    public function log_v($titulo = "", $descripcion = "", $type="x")
    {
        //global $MDB;

        $creationDate = date("Y-m-d H:i:s");
        $userID = $this->UID;//ID de USER

            switch($type)
            {
                case "+" : $type = "Add"; break;
                case "-" : $type = "Delete"; break;
                case "/" : $type = "Update"; break;
                case "*" : $type = "Upload"; break;
                case "x" : $type = "Other"; break;                
            }

                 $query = "INSERT INTO logs (id_log, title, description, date, type, id_user) VALUES  
                    (0, '".$titulo."', '".$descripcion."','".$creationDate."', '".$type."', ".$userID.")";

//            echo $query;

		return $this->MDB->insertME($query);

    }


 

}
 

?>
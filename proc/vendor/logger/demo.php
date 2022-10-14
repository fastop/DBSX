<?php
    session_start();

    require_once("../myzql/myzql.php");
    //require_once("Logger.class.php");
    require_once("Logger.class.test.php"); //OJO:: Estoy utilizando una clase de PRUEBA para esta DEMO
                                    // para que Insertemos cuando la querramos ver, solo mostrara la 
                                    // construccion de la consulta.
    
    $_SESSION["SID"]=1; //OJO:: Para ESTE ejemplo fue necesario colocar la variable en sesion
                            // Cuando se utilice en el sistema se tomará la que existe dentro del entorno


    $MDB = new mySQL(); //Creamos la instancia de la clase...
    $L = new Logger($MDB); //Creamos la instancia (alimentada con la instancia de la BD)
     

    /************************************************************* */
    /************************************************************* */
    /*               PRIMER LOG (Sencillo)                         */
    /************************************************************* */

    //Al insertar de esta manera el TIPO de EVENTO se asigna como DEFAULT (1)

     $L->log("Titulo del Log","Descripción del Evento ocurrido");
  


    /************************************************************* */
    /************************************************************* */
    /*               SEGUNDO LOG (Con EXTRAS)                      */
    /************************************************************* */

    //Si queremos definir el TIPO de EVENTO, es necesario colocar un tercer parametro
    //este numero se encuentra en la tabla "events_types".
    // SI el NUMERO NO EXISTE en la tabla "events_type", generara un error por llave foranea
    // y NO SE INSERTARA

    $L->log("Titulo del Log","Descripción del Evento ocurrido",7);


    /************************************************************* */
    /************************************************************* */
    /*               TERCER LOG (Supra-Definido)                   */
    /************************************************************* */

    //Si ocupamos definir el TIPO de EVENTO MUCHAS VECES y no queremos
    //repetir el ultimo numero muchas veces (o que se nos olvide ponerlo)
    //Es necesario DEFINIR ESTA variable en session (OJO, una vez que no se utilice eliminela (unset))

    $_SESSION["eType"] = 9;

     $L->log("Titulo del Log","Descripción del Evento ocurrido"); //Todos los logs de aqui en adelante seran del tipo 7

     //  ...

     unset($_SESSION["eType"]);



    /************************************************************* */
    /************************************************************* */
    /*               CUARTO LOG (Ultra-Definido)                   */
    /************************************************************* */

    //En el caso de querer omitir cada una de las propiedades basicas (Add, Update, Delete, Upload)
    //en el titulo, es posible agregar 
 
     $L->log("+ Client","Descripción del Evento ocurrido"); //Todos los logs de aqui en adelante seran del tipo 7
     $L->log("- Client","Descripción del Evento ocurrido"); //Todos los logs de aqui en adelante seran del tipo 7

     //  ...
 


    /************************************************************* */
    /************************************************************* */
    /*     NORMAS PARA INSERTAR EN  LOG (Ultra-Definido)           */
    /************************************************************* */
    /*
        Para generar un estandar al momento de crear logs (y que se vean "bonitos")...
        es necesario cumplir con los siguientes requisitos:

        Colocar la accion en el titulo, por ejemplo:

            Add xxxxxxxxxx
            Delete xxxxxxxxxx
            Edit xxxxxxxxxx
            Upload xxxxxxxxxx
        
          Donde xxxxxxxxxx sera el nombre del lugar del cambio, por ejemplo:

            Add Client
            Delete Client
            Edit Note
            Upload Docs          

        En caso de querer ahorrarse un poco de texto es posible utilizar los caracteres
        +, -, /, * para acortar el titulo, por ejemplo:

        
            Add Client      -> + Client   
            Delete Client   -> - Client
            Edit Note       -> / Note    
            Upload Docs     -> * Docs  

        Estos simbolos se reemplazarán automaticamente al momento de generar la consulta.

            + Client   -> Add Client 
            - Client   -> Delete Client
            / Note     -> Edit Note
            * Docs     -> Upload Docs 
  
 
 

        DESCRIPCION DEL LOG

        La descripcion es algo bastante interesante, pueden tener las siguientes formas:

            - Data Capturer has added new note from Client Client
            - Marlene Quirate Sainz has updated basic information from customer test.
            - Jannelly  has updated basic information from gabriela  suarez.
            - customer services customer services has upload a new document IMG_15831891488527366.jpg to demo remo
            - <NOMBRE DE USUARIO> <ACCION> <AFECTADO>

    */














?>
<?php
/** ****************************************************
 *  @file crypt.php								 
 *														 
 *  @brief Clase para el manejo de datos encriptados
 *  como lo son las contraseñas.
 *													 
 * @author DRV                       			 
 * @date Enero 2020                           			 
 *            								  		 
 * @version 1.0           			
 ****************************************************** */ 

class Crypto {


/** 
 *   @brief Metodo verificar si la contraseña dada es igual a la que existe en el sistema
 *
 *   @param $original    Contraseña que se va a verificar SIN encriptar (string)
 *   @param $existence   Contraseña encriptada que YA existe... (string)
 *
 *   @return 
 *    Si el usuario existe dentro del sistema  retorna verdadero  (bool)
 *    Si el usuario NO existe dentro del sistema  retorna falso  (bool)
 */   

    public function passwCheck($original, $existence)
    {
      return  password_verify($this->firstPass($original),$existence);
    }


/** 
 *   @brief Metodo generar el primer paso de la contraseña final
 *
 *   @param $EXO    Palabra que se va a encriptar (string)
 *
 *   @return 
 *    Si se realizó de manera correcta retorna la palabra "encriptada" (string)
 */    
    public function firstPass($EXO)
    {
       return  base64_encode($EXO);
    }


/** 
 *   @brief Metodo generar la gran contraseña final
 *
 *   @param $EXO    Palabra que se va a encriptar (string)
 *
 *   @return 
 *    Si se realizó de manera correcta retorna la palabra encriptada (string)
 */   
    public function passwGenerator($EXO)
    {     
        return password_hash($this->firstPass($EXO)."", PASSWORD_DEFAULT);
    }


/** 
 *   @brief Metodo generar el ID interno del usr o clt
 *          utiliza HASH CRC32B
 *
 *   @param $EXO    Palabra que se va a hashear (string)
 *
 *   @return 
 *    Si se realizó de manera correcta retorna la palabra hasheada (string)
 */ 

    public function genEx($EXO)
    {
        return hash("crc32b",$EXO);
    }



}


?>
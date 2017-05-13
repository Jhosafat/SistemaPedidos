<?php

/*
 * SISTEMA ADMINISTRADOR DE CLIENTES
 * DESCRIPCION: modelo que realiza las llamadas a la base de datos del sistema,
 * para verificar y obtener informacion sobre los usuarios que puden ingresar.
 * 
 * FECHA: 21/02/2106
 * AUTOR: IJFLORES
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginM extends CI_Model {
    /*
     * Consltructor para inicializar el componente de Modelo
     */

    function __construct() {
        parent::__construct();
        //realizamos la conexion con la base de datos
        $this->load->database();
        //Inicializamos la zona horaria para que no
        //tengamos problemas al obtener las horas y los dias
        date_default_timezone_set("America/Mexico_City");
        $this->load->library('bcrypt');//cargamos la librería
    }

    /*
     * Verifica las credenciales del usuario, en caso de que 
     * exista, retorna un numero mayor a 0, -1 en caso contrario
     */

    function valida_user($datos) {
        try
        {
            log_message('info', 'El usuario: '.$datos['user'].' ha solicitado el acceso.');
           //echo $this->bcrypt->hash_password('prueba');
            
            $this->db->where('user', $datos['user']);
            $query =  $this->db->get('usuario');
            //si el nombre existe, entonces validamos que sea unico
            if($query->num_rows() == 1)
            {
                log_message('info', 'El usuario: '.$datos['user'].' existe.');
                
                $user = $query->row();
                //en pass guardamos el hash del usuario que tenemos en la base
                //de datos para comprobarlo con el método check_password de Bcrypt
                $pass = $user->pass;

                //esta es la forma de comprobar si el password del 
                //formulario coincide con el codificado de la base de datos
                if($this->bcrypt->check_password($datos['pass'], $pass))
                {
                    log_message('info', 'Credenciales correctas');
                    //retornamos los datos del usuario
                    $salida = array(
                        'usuario'=> $user->user,
                        'nombre'=> $user->nombre
                    );
                    return $salida;
                }
                else
                {
                    log_message('error', 'La contraseña es incorrecta.');
                }
            }
            else
            {
                log_message('error', 'El usuario existe varias veces.');
                return null;
            }
            
        }catch(Exception $ex)
        {
            log_message('error', 'Error al verificar credenciales del usuario: '.$datos['user']);
            log_message('error', $ex->getFile());
            log_message('error', $ex->getMessage());
            log_message('error', $ex->getTraceAsString());
            return NULL;
        }
        return null;
    }
   
}

?>

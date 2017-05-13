<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * SISTEMA ADMINISTRADOR DE CLIENTES
 * DESCRIPCION: modelo que realiza las llamadas a la base de datos del sistema,
 * para verificar y obtener informacion sobre los usuarios que puden ingresar.
 * 
 * FECHA: 21/02/2106
 * AUTOR: IJFLORES
 */

class Login extends CI_Controller {

    //constructor del controlador
    function __construct() {
        parent::__construct();
        //cargamos el modelo que realizara las correspondientes llamadas a la base de datos
        $this->load->model('loginM');
        $this->load->library('bcrypt'); //cargamos la librería
        $this->session->keep_flashdata('user_error');
        $this->session->keep_flashdata('pass_error');
        $this->session->keep_flashdata('data_error');
    }

    public function index() {
        $this->load->view('login/login');
    }

    /*
     * @Nombre: ini
     * @Descripcion: Verifica los datos enviados del formulario de login.
     */

    public function val() {
        if ($this->input->post()) {
            $error = false;

            $user = $this->security->xss_clean($this->input->post('txt_user'));
            $pass = $this->security->xss_clean($this->input->post('txt_pass'));
            
            //validamos vacios
            if ($user == "") {
                $this->session->set_flashdata("user_error", "TRUE");
                $error = true;
            }

            //validamos vacios
            if ($pass == "") {
                $this->session->set_flashdata("pass_error", "TRUE");
                $error = true;
            }
                
            if ($error) {
                //si hay error entonces regresamos pero con marcas para indicar el error
                $this->session->set_flashdata("user", $user);
                $this->session->set_flashdata("pass", $pass);
                redirect(base_url());
            } else {
                //no hay error, entonces validamos credenciales en la base de datos
                $data = array(
                    'user' => $user,
                    'pass' => $pass
                );
                $result = $this->loginM->valida_user($data);
                if (isset($result)) {
                        //las credenciales son correctas
                        //guardamos los datos en sesion y marcamos que la session esta iniciada
                        $sesion_user = array(
                            'usuario' => $result->usuario,
                            'nombre' => $result->nombre,
                            'logueado' => TRUE
                        );
                        $this->session->set_userdata($sesion_user);
                        $this->load->view("home/ini", $data);
                } else {
                    //el usuario y/o la contraseña no son correctos
                    $this->session->set_flashdata("user", $user);
                    $this->session->set_flashdata("data_error", "TRUE");
                    redirect(base_url("index.php"));
                }
            }
        } else {
            //los campos vienen vacios
            $this->session->set_flashdata("user_error", "TRUE");
            $this->session->set_flashdata("pass_error", "TRUE");
            redirect(base_url("index.php"));
        }
    }

   
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitor extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('administrador')) {
            $this->load->view("home_monitor_view");
        } else {
            $this->load->view("monitor_Login_view");
        }
    }

    public function login() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $usuario = $request->usuario;
        $pasword = $request->password;
        $data = array('usuario' => $usuario, 'password' => $pasword);
        $this->load->model("login_monitor_model");
        $InformacionLogin = $this->login_monitor_model->loadData($data);
        $result = 0;
        if ($InformacionLogin) {
            $InformacionLoginUsuario = array(
                'administrador' => TRUE,
                'CodEmpresa' => $InformacionLogin[0]["CodEmpresa"],
                'CodPrograma' => $InformacionLogin[0]["CodPrograma"],
                'empresa' => $InformacionLogin[0]["empresa"]
            );
            $this->session->set_userdata($InformacionLoginUsuario);
            // var_dump($InformacionLoginUsuario);
            $result = 1;
        } else {
            $result = 0;
        }
        echo $result;
    }

    public function ObtenerParticipantes() {

        $this->load->model("login_monitor_model");

        $participantes = $this->login_monitor_model->loadParticipantes();
        $info = array('data' => $participantes);

        echo $info;
        //   $info =  json_encode($info)
        //  $this->load->view("participantes_view",$info);
    }

    public function Participante_Detalle($idParticipante, $nombre) {
        $this->load->model("login_monitor_model");
        $data = $this->login_monitor_model->misPreCanjes($idParticipante);
        $info = array('data' => $data, 'nombre' => $nombre);
        //var_dump($info);

        $this->load->view('participante_detalle_monitor', $info);
    }

    ////////////////////////////////////API RECONOCELO //////////////////////////////////
    
    
    
    
 ////////////////////////////////////GETS //////////////////////////////////   
    
    public function ObtenerPrticipantes($idCodPrograma, $codEmpresa) {
        $this->load->model("api_model_monitor");
        $data = $this->api_model_monitor->obtenerParticipantes($idCodPrograma, $codEmpresa);
        if ($data) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        } else {
            $error = array("Error" => "No Information");
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error));
        }
    }
    

    public function ObtenerCanjesPrticipante($idParticipante,$codPrograma) {
        $this->load->model("api_model_monitor");
        $data = $this->api_model_monitor->ObtenerCanjesParticipante($idParticipante,$codPrograma);
        if ($data) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        } else {
            $error = array("Error" => "No Information");
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error));
        }
    } 
    public function ValidateLogin($usuario,$password) {
        $this->load->model("api_model_monitor");
        $data = $this->api_model_monitor->login($usuario,$password);
        if ($data) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
         
        } else {
            $error = array("Error" => "No Information");
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error));
        }
    } 
    //////////////////////////////////// END GETS //////////////////////////////////   

    /////////////////////////Menu navegacion reconocelo monitor/////////////////////
    public function participantes()
    	{
            $this->load->view('participante_monitor_view');
        }
    
    public function depositos(){
        $this->load->view('deposito_monitor_view');
    }

    public function canjes(){
        $this->load->view('canje_monitor_view');
    }

    public function catalogo(){
        $this->load->view('catalogo_monitor_view');
    }

    public function programa(){
        $this->load->view('programa_monitor_view');
    }
    /////////////////////////////////////Fin menu/////////////////////////////////////
}

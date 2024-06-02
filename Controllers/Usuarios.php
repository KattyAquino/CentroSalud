<?php
    class Usuarios extends Controller{
        public function __construct(){
            session_start();
            parent::__construct();
        }
        public function index(){
            $data['especialidades']= $this->model->getEspecialidades();
            $this->views->getView($this, "index",$data);
        }
        public function listar(){
            $data=$this->model->getUsuarios();
            for($i=0; $i<count($data); $i++){
                if($data[$i]['estado']==1){
                    $data[$i]['estado']='<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class ="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    <div/>';
                }else{
                    $data[$i]['estado']='<span class="badge badge-danger">Inactivo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-success" type="button" onclick="btnReingresarUser('.$data[$i]['id'].');">Reingresar</button>
                    <div/>';
                }
           }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
           die();
        }
        public function validar(){
            if(empty($_POST['usuario']) || empty($_POST['clave'])){
                $smg="Los campos estan vacios";
            }else{
                $usuario=$_POST['usuario'];
                $clave=$_POST['clave'];
                $data=$this->model->getUsuario($usuario,$clave);
                if($data){
                    $_SESSION['id_usuario'] =$data['id'];
                    $_SESSION['usuario'] =$data['usuario'];
                    $_SESSION['nombre'] =$data['nombre'];
                    $smg="ok";
                }else{
                    $smg="Usuario o contraseña incorrecta";
                }                
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
           die();
        }
        public function registrar(){
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $especialidad = $_POST['especialidad'];
            $id = $_POST['id'];
            if(empty($usuario) || empty($nombre)  || empty($especialidad)){
                $smg = "Todos los campos son obligatorios";
            } else {
                if($id==""){
                    if($clave != $confirmar){
                        $smg="Las contraseñas no coinciden";
                    }else{
                        $data = $this->model->registrarUsuario($usuario, $nombre, $clave, $especialidad);
                        if($data == "ok"){
                            $smg = "si";
                        } else if($data == "existe"){
                            $smg = "El usuario ya existe";
                        }else{
                            $smg = "Error al registrar el usuario"; 
                        }
                    }    
                }else{
                    $data = $this->model->modificarUsuario($usuario, $nombre, $especialidad, $id);
                    if($data == "modificado"){
                        $smg = "modificado";
                    } else{
                        $smg = "Error al modificar el usuario"; 
                    }
                }
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function editar(int $id){
            $data=$this->model->editarUser($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function eliminar(int $id){
            $data= $this->model->accionUser(0,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al eliminar el usuario";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function reingresar(int $id){
            $data= $this->model->accionUser(1,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al reingresar el usuario";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function salir(){
            session_destroy();
            header("location: ".base_url);
        }
    }
    
?>
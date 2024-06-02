<?php
    class Pacientes extends Controller{
        public function __construct(){
            session_start();
            parent::__construct();
        }
        public function index(){
            $this->views->getView($this, "index");
        }
        public function listar(){
            $data=$this->model->getPacientes();
            for($i=0; $i<count($data); $i++){
                if($data[$i]['estado']==1){
                    $data[$i]['estado']='<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-primary" type="button" onclick="btnEditarPac('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class ="btn btn-danger" type="button" onclick="btnEliminarPac('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    <div/>';
                }else{
                    $data[$i]['estado']='<span class="badge badge-danger">Inactivo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-success" type="button" onclick="btnReingresarPac('.$data[$i]['id'].');">Reingresar</button>
                    <div/>';
                }
           }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
           die();
        }
    
        public function registrar(){
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $id= $_POST['id'];
            if(empty($dni) || empty($nombre) ||empty($telefono) || empty($direccion)){
                $smg = "Todos los campos son obligatorios";
            } else {
                if($id==""){
                    $data = $this->model->registrarPaciente($dni, $nombre, $telefono,$direccion);
                    if($data == "ok"){
                        $smg = "si";
                    } else if($data == "existe"){
                        $smg = "El dni ya existe";
                    }else{
                        $smg = "Error al registrar el paciente"; 
                    }
                }else{
                    $data=$this->model->modificarPaciente($dni,$nombre,$telefono,$direccion,$id);
                    if($data=="modificado"){
                        $smg="modificado";
                    }else{
                        $smg="Erro al modificar el paciente";
                    }
                }
               
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function editar(int $id){
            $data=$this->model->editarPac($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function eliminar(string $id){
            $id = (int)$id;
            $data= $this->model->accionPac(0, $id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al eliminar el paciente";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function reingresar(string $id){
            $id = (int)$id;
            $data= $this->model->accionPac(1, $id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al reingresar el paciente";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        
    }
    
?>
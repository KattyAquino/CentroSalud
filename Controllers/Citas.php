<?php
    class Citas extends Controller{
        public function __construct(){
            session_start();
            parent::__construct();
        }
        public function index(){
            $data['usuarios']= $this->model->getUsuarios();
            $data['pacientes']= $this->model->getPacientes();
            $this->views->getView($this, "index",$data);
        }
        public function listar(){
            $data=$this->model->getCitas();
            for($i=0; $i<count($data); $i++){
                if($data[$i]['estado']==1){
                    $data[$i]['estado']='<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-primary" type="button" onclick="btnEditarCit('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class ="btn btn-danger" type="button" onclick="btnEliminarCit('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    <div/>';
                }else{
                    $data[$i]['estado']='<span class="badge badge-danger">Inactivo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-success" type="button" onclick="btnReingresarCit('.$data[$i]['id'].');">Reingresar</button>
                    <div/>';
                }
           }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
           die();
        }
        public function registrar(){
            $descripcion = $_POST['descripcion'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $usuario = $_POST['usuario'];
            $paciente = $_POST['paciente'];
            $id = $_POST['id'];
            if(empty($descripcion) || empty($fecha)  || empty($hora)){
                $smg = "Todos los campos son obligatorios";
            } else {
                if($id==""){
                        $data = $this->model->registrarCita($descripcion, $fecha, $hora,$usuario,$paciente);
                        if($data == "ok"){
                            $smg = "si";
                        } else if($data == "existe"){
                            $smg = "El Cita ya existe";
                        }else{
                            $smg = "Error al registrar el Cita"; 
                    }    
                }else{
                    $data = $this->model->modificarCita($descripcion, $fecha, $hora,$usuario,$paciente,$id);
                    if($data == "modificado"){
                        $smg = "modificado";
                    } else{
                        $smg = "Error al modificar el Cita"; 
                    }
                }
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function editar(int $id){
            $data=$this->model->editarCit($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function eliminar(int $id){
            $data= $this->model->accionCit(0,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al eliminar la cita";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function reingresar(int $id){
            $data= $this->model->accionCit(1,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al reingresar la cita";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
?>
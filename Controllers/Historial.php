<?php
    class Historial extends Controller{
        public function __construct(){
            session_start();
            parent::__construct();
        }
        public function index(){
            $data['pacientes']= $this->model->getPacientes();
            $data['especialidad']= $this->model->getEspecialidad();
            $this->views->getView($this, "index",$data);
        }
        public function listar(){
            $data=$this->model->getHistorial();
            for($i=0; $i<count($data); $i++){
                if($data[$i]['estado']==1){
                    $data[$i]['estado']='<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-primary" type="button" onclick="btnEditarHis('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class ="btn btn-danger" type="button" onclick="btnEliminarHis('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    <div/>';
                }else{
                    $data[$i]['estado']='<span class="badge badge-danger">Inactivo</span>';
                    $data[$i]['acciones']='<div>
                    <button class ="btn btn-success" type="button" onclick="btnReingresarHis('.$data[$i]['id'].');">Reingresar</button>
                    <div/>';
                }
           }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
           die();
        }
        public function registrar(){
            $codigo = $_POST['codigo'];
            $edad = $_POST['edad'];
            $antecedentes = $_POST['antecedentes'];
            $alergias = $_POST['alergias'];
            $paciente = $_POST['paciente'];
            $especialidad = $_POST['especialidad'];
            $id = $_POST['id'];
            if(empty($codigo) || empty($edad)  || empty($antecedentes)|| empty($alergias)){
                $smg = "Todos los campos son obligatorios";
            } else {
                if($id==""){  
                    $data = $this->model->registrarHistorial($codigo, $edad, $antecedentes, $alergias, $paciente,$especialidad);
                    if($data == "ok"){
                        $smg = "si";
                    } else if($data == "existe"){
                        $smg = "El Historial ya existe";
                    }else{
                        $smg = "Error al registrar el Historial"; 
                    }   
                }else{
                    $data = $this->model->modificarHistorial($codigo, $edad, $antecedentes, $alergias, $paciente,$especialidad, $id);
                    if($data == "modificado"){
                        $smg = "modificado";
                    } else{
                        $smg = "Error al modificar el Historial"; 
                    }
                }
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function editar(int $id){
            $data=$this->model->editarHis($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function eliminar(int $id){
            $data= $this->model->accionHis(0,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al eliminar el Historial Clinicio";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function reingresar(int $id){
            $data= $this->model->accionHis(1,$id);
            if($data==1){
                $smg="ok";
            }else{
                $smg="Error al reingresar el Historial Clinico";
            }
            echo json_encode($smg, JSON_UNESCAPED_UNICODE);
            die();
        }

    }
    
?>
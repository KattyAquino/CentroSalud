<?php
    class HistorialModel extends Query{
        private $codigo, $edad, $antecedentes, $alergias,$id_paciente,$id_especialidad, $id, $estado;
        public function __construct(){
            parent::__construct();
        }
        public function getPacientes(){
            $sql = "SELECT * FROM pacientes WHERE estado=1";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function getEspecialidad(){
            $sql = "SELECT * FROM especialidad WHERE estado=1";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function getHistorial(){
            $sql = "SELECT h.*, p.id AS id_paciente, p.nombre AS paciente, e.id AS id_especialidad, e.especialidad AS especialidad FROM historial h INNER JOIN pacientes p ON h.id_paciente=p.id INNER JOIN especialidad e ON h.id_especialidad= e.id";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function registrarHistorial(string $codigo, string $edad, string $antecedentes, string $alergias, int $id_paciente,int $id_especialidad){
            $this->codigo = $codigo;
            $this->edad = $edad;
            $this->antecedentes = $antecedentes;
            $this->alergias = $alergias;
            $this->id_paciente = $id_paciente;
            $this->id_especialidad = $id_especialidad;
            $verificar="SELECT * FROM historial WHERE codigo='$this->codigo'";
            $existe=$this->select($verificar);
            if(empty($existe)){
                $sql = "INSERT INTO historial(codigo, edad, antecedentes, alergias,id_paciente, id_especialidad) VALUES (?, ?, ?, ?,?,?)";
                $datos = array($this->codigo, $this->edad, $this->antecedentes, $this->alergias, $this->id_paciente,$this->id_especialidad);
                $data = $this->save($sql, $datos);
                if($data == 1){
                    $res = "ok";
                } else {
                    $res = "error";
                }   
            }else{
                $res="existe";
            }               
            return $res;
        }
        public function modificarHistorial(string $codigo, string $edad, string $antecedentes, string $alergias, int $id_paciente,int $id_especialidad, int $id){
            $this->codigo = $codigo;
            $this->edad = $edad;
            $this->antecedentes = $antecedentes;
            $this->alergias = $alergias;
            $this->id_paciente = $id_paciente;
            $this->id_especialidad = $id_especialidad;
            $this->id = $id;
            $sql="UPDATE historial SET codigo=?, edad=?, antecedentes=?, alergias=?, id_paciente=?, id_especialidad=? WHERE id=?";
            $datos=array($this->codigo, $this->edad, $this->antecedentes, $this->alergias, $this->id_paciente,$this->id_especialidad, $this->id);
            $data=$this->save($sql, $datos);
            if($data == 1){
                $res = "modificado";
            } else {
                $res = "error";
            }              
            return $res;
        }
        public function editarHis(int $id){
            $sql="SELECT * FROM historial WHERE id=$id";
            $data=$this->select($sql);
            return $data;
        }
        public function accionHis(int $estado, int $id){
            $this->id=$id;
            $this->estado=$estado;
            $sql= "UPDATE historial SET estado=? WHERE id=?";
            $datos = array($this->estado, $this->id);
            $data= $this->save($sql, $datos);
            return $data;
        }
    }
?>
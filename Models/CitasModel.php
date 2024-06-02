<?php
    class CitasModel extends Query{
        private $descripcion, $fecha, $hora, $id_usuario,$id_paciente, $id, $estado;
        public function __construct(){
            parent::__construct();
        }
        public function getUsuarios(){
            $sql = "SELECT * FROM usuarios WHERE estado=1";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function getPacientes(){
            $sql = "SELECT * FROM pacientes WHERE estado=1";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function getCitas(){
            $sql = "SELECT c.*, u.id AS id_usuario, u.nombre AS usuario, p.id AS id_paciente, p.nombre AS paciente FROM citas c INNER JOIN usuarios u ON c.id_usuario=u.id INNER JOIN pacientes p ON c.id_paciente=p.id";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function registrarCita(string $descripcion, string $fecha, string $hora, int $id_usuario, int $id_paciente){
            $this->descripcion = $descripcion;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->id_usuario = $id_usuario;
            $this->id_paciente = $id_paciente;
            $verificar="SELECT * FROM citas WHERE descripcion='$this->descripcion'";
            $existe=$this->select($verificar);
            if(empty($existe)){
                $sql = "INSERT INTO citas(descripcion, fecha, hora, id_usuario, id_paciente) VALUES (?, ?, ?, ?,?)";
                $datos = array($this->descripcion, $this->fecha, $this->hora, $this->id_usuario,$this->id_paciente);
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
        public function modificarCita(string $descripcion, string $fecha, string $hora, int $id_usuario, int $id_paciente, int $id){
            $this->descripcion = $descripcion;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->id_usuario = $id_usuario;
            $this->id_paciente = $id_paciente;
            $this->id = $id;
            $sql="UPDATE citas SET descripcion=?, fecha=?,hora=?, id_usuario=?, id_paciente=? WHERE id=?";
            $datos=array($this->descripcion, $this->fecha, $this->hora, $this->id_usuario,$this->id_paciente, $this->id);
            $data=$this->save($sql, $datos);
            if($data == 1){
                $res = "modificado";
            } else {
                $res = "error";
            }              
            return $res;
        }
        public function editarCit(int $id){
            $sql="SELECT * FROM citas WHERE id=$id";
            $data=$this->select($sql);
            return $data;
        }
        public function accionCit(int $estado, int $id){
            $this->id=$id;
            $this->estado=$estado;
            $sql= "UPDATE citas SET estado=? WHERE id=?";
            $datos = array($this->estado, $this->id);
            $data= $this->save($sql, $datos);
            return $data;
        }
    }
?>
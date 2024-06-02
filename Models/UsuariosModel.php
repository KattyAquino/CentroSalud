<?php
    class UsuariosModel extends Query{
        private $usuario, $nombre, $clave, $id_especialidad, $id, $estado;
        public function __construct(){
            parent::__construct();
        }
        public function getUsuario(string $usuario, string $clave){
            $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
            $data = $this->select($sql);
            return $data;
        }
        public function getEspecialidades(){
            $sql = "SELECT * FROM especialidad WHERE estado=1";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function getUsuarios(){
            $sql = "SELECT u.*, e.id as id_especialidad, e.especialidad FROM usuarios u INNER JOIN especialidad e WHERE u.id_especialidad=e.id";
            $data = $this->selectAll($sql);
            return $data;
        }
        public function registrarUsuario(string $usuario, string $nombre, string $clave, int $id_especialidad){
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->id_especialidad = $id_especialidad;
            $verificar="SELECT * FROM usuarios WHERE usuario='$this->usuario'";
            $existe=$this->select($verificar);
            if(empty($existe)){
                $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_especialidad) VALUES (?, ?, ?, ?)";
                $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_especialidad);
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
        public function modificarUsuario(string $usuario, string $nombre, int $id_especialidad, int $id){
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->id = $id;
            $this->id_especialidad = $id_especialidad;
            $sql="UPDATE usuarios SET usuario=?, nombre=?, id_especialidad=? WHERE id=?";
            $datos=array($this->usuario, $this->nombre, $this->id_especialidad, $this->id);
            $data=$this->save($sql, $datos);
            if($data == 1){
                $res = "modificado";
            } else {
                $res = "error";
            }              
            return $res;
        }
        public function editarUser(int $id){
            $sql="SELECT * FROM usuarios WHERE id=$id";
            $data=$this->select($sql);
            return $data;
        }
        public function accionUser(int $estado, int $id){
            $this->id=$id;
            $this->estado=$estado;
            $sql= "UPDATE usuarios SET estado=? WHERE id=?";
            $datos = array($this->estado, $this->id);
            $data= $this->save($sql, $datos);
            return $data;
        }
    }
?>
<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;

        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();

		$this->conectar = null;
		$this->db = $adapter;
    }

    public function getConetar(){
        return $this->conectar;
    }

    public function db(){
        return $this->db;
    }

    public function getFirst(){
      $query=$this->db->query("SELECT * FROM $this->table ORDER BY id ASC LIMIT 1;");
      $resultSet=false;
      while ($row = $query->fetch_object()) {
         $resultSet[]=$row;
      }

      return $resultSet;
    }

    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id DESC;");
        $resultSet=false;
        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        return $resultSet;
    }

    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
        $resultSet=false;
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }

        return $resultSet;
    }
    public function getByColumns($column1,$value1,$column2,$value2){
        $consulta="SELECT * FROM $this->table WHERE $column1 = '$value1' AND $column2 = '$value2' ;";
        $query=$this->db->query($consulta);
        $resultSet=false;
        if($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        return $resultSet;
    }

    public function getAmistad($value1, $value2){
      //AND (estado='cancelado' OR estado='rechazado' OR estado='eliminadoE' OR estado='eliminadoR')
      $consulta="SELECT * FROM amistad WHERE ( usuarioEmisor = $value1 AND usuarioReceptor = $value2 ) OR (usuarioEmisor = $value2 AND usuarioReceptor = $value1 );";
      $query=$this->db->query($consulta);

      if($row = $query->fetch_object()) {
         $resultSet[]=$row;
      }else{
        $resultSet=false;
      }

      return $resultSet;
    }

    public function getSolicitudes($value){
      $consulta="SELECT * FROM usuariositio WHERE id IN (SELECT usuarioEmisor FROM $this->table WHERE usuarioReceptor= '$value' AND estado ='pendiente' );";
      $query=$this->db->query($consulta);
      $resultSet=false;
      while($row = $query->fetch_object()) {
         $resultSet[]=$row;
      }

      return $resultSet;
    }

    public function getPublicaciones($value){
      //SELECT * FROM post p JOIN usuariositio u ON u.id=p.idUsuario WHERE visibilidad='publico' OR idUsuario IN (SELECT usuarioEmisor FROM amistad a WHERE a.usuarioEmisor=1 AND estado='aceptado') OR (SELECT usuarioReceptor FROM amistad a WHERE a.usuarioReceptor=1 AND estado='aceptado') OR p.visibilidad='publico' OR idUsuario 
      $consulta="SELECT * 
FROM post p 
JOIN usuariositio u ON u.id=p.idUsuario
where p.idUsuario in (select usuarioEmisor from amistad where usuarioReceptor = '$value' AND estado='aceptado')
   or p.idUsuario in (select usuarioReceptor from amistad where usuarioEmisor = '$value' AND estado='aceptado')
union
SELECT * 
FROM post p 
JOIN usuariositio u ON u.id=p.idUsuario
where p.idUsuario = '$value';";

      $query=$this->db->query($consulta);
      $resultSet=false;
      while($row = $query->fetch_object()) {
         $resultSet[]=$row;
      }

      return $resultSet;
    }

    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
        $resultSet=false;
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        return $resultSet;
    }

    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id");
        return $query;
    }

    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }


    /*
     * Aqui podemos agregar otros métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */

}
?>

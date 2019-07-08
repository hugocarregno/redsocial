<?php
class Amistad extends EntidadBase{

  private $usuarioEmisor;
  private $usuarioReceptor;
  private $estado;
  private $fecha;

  public function __construct($adapter) {
      $table="amistad";
      parent::__construct($table,$adapter);
  }

  public function getUsuarioEmisor(){
      return $this->usuarioEmisor;
  }
  public function setUsuarioEmisor($usuarioEmisor){
      $this->usuarioEmisor=$usuarioEmisor;
  }
  public function getUsuarioReceptor(){
      return $this->usuarioReceptor;
  }
  public function setUsuarioReceptor($usuarioReceptor){
      $this->usuarioReceptor=$usuarioReceptor;
  }
  public function getFecha(){
      return $this->fecha;
  }
  public function setFecha($fecha){
      $this->fecha=$fecha;
  }
  public function getEstado(){
      return $this->estado;
  }
  public function setEstado($estado){
      $this->estado=$estado;
  }

  public function save(){
  //verifico si el usuario se encuentra en la BD
  //sino es null entonces UPDATE
  //si es null entonces INSERT
  if($this->estado){
    $query= "UPDATE amistad set usuarioReceptor = '$this->usuarioReceptor', fecha = '$this->fecha', estado = '$this->estado' where usuarioEmisor = $this->usuarioEmisor";

    $save=$this->db()->query($query);
    //$this->db()->error;
    return $save;

  }else{
    $this->setEstado("pendiente");
          $query="INSERT INTO amistad (usuarioEmisor, usuarioReceptor, estado, fecha)
              VALUES('".$this->usuarioEmisor."',
                     '".$this->usuarioReceptor."',
                     '".$this->estado."',
                   '".$this->fecha."');";
          $save=$this->db()->query($query);
          //$this->db()->error;
          return $save;
      }
    }
}
?>

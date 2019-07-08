<?php
class Post extends EntidadBase{
  private $id;
  private $fecha;
  private $titulo;
  private $descripcion;
  private $foto1;
  private $foto2;
  private $foto3;
  private $adjunto;
  private $palabraClave1;
  private $palabraClave2;
  private $palabraClave3;
  private $estado;
  private $usuario;


  public function __construct($adapter) {
      $table="post";
      parent::__construct($table,$adapter);
  }

  public function getId() {
      return $this->id;
  }

  public function setId($id) {
      $this->id = $id;
  }

  public function getFecha(){
      return $this->fecha;
  }
  public function setFecha($fecha){
      $this->fecha=$fecha;
  }
  public function getTitulo(){
      return $this->titulo;
  }
  public function setTitulo($titulo){
       $this->titulo=$titulo;
  }
  public function getDescripcion(){
      return $this->descripcion;
  }
  public function setDescripcion($descripcion){
      $this->descripcion=$descripcion;
  }
  public function getFoto1(){
    return $this->foto1;
  }
  public function setFoto1($foto1){
    $this->foto1=$foto1;
  }
  public function getFoto2(){
    return $this->foto2;
  }
  public function setFoto2($foto2){
    $this->foto2=$foto2;
  }
  public function getFoto3(){
    return $this->foto3;
  }
  public function setFoto3($foto3){
    $this->foto3=$foto3;
  }
  public function getAdjunto(){
    return $this->adjunto;
  }
  public function setAdjunto($adjunto){
    $this->adjunto=$adjunto;
  }
  public function getPalabraClave1(){
    return $this->palabraClave1;
  }
  public function setPalabraClave1($palabraClave1){
    $this->palabraClave1=$palabraClave1;
  }
  public function getPalabraClave2(){
    return $this->palabraClave2;
  }
  public function setPalabraClave2($palabraClave2){
    $this->palabraClave2=$palabraClave2;
  }
  public function getPalabraClave3(){
    return $this->palabraClave3;
  }
  public function setPalabraClave3($palabraClave3){
    $this->palabraClave3=$palabraClave3;
  }
  public function getEstado(){
      return $this->estado;
  }
  public function setEstado($estado){
      $this->estado=$estado;
  }
  public function setUsuario($usuario){
    $this->usuario=$usuario;
  }
  public function getUsuario(){
    return $this->usuario;
  }

  public function save(){
    //require_once "usuarioSitio.php"; otra forma es como appmvc

  //verifico si el usuario se encuentra en la BD
  //sino es null entonces UPDATE
  //si es null entonces INSERT
  if($this->id){
    $query= "UPDATE post set fecha = '$this->fecha', titulo = '$this->titulo', descripcion = '$this->descripcion', foto1 = '$this->foto1', foto2 = '$this->foto2', foto3 = '$this->foto3', adjunto = '$this->adjunto',
    palabraClave1 = '$this->palabraClave1', palabraClave2 = '$this->palabraClave2', palabraClave3 = '$this->palabraClave3', estado = '$this->estado', idUsuario = '$this->usuario' where id = $this->id";
    $save=$this->db()->query($query);
    //$this->db()->error;
    return $save;

  }else{
          $query="INSERT INTO post (id, fecha, titulo, descripcion, foto1, foto2, foto3, adjunto, palabraClave1, palabraClave2, palabraClave3, estado, idUsuario)
              VALUES(NULL,'".$this->fecha."',
                     '".$this->titulo."',
                     '".$this->descripcion."',
                     '".$this->foto1."',
                     '".$this->foto2."',
                     '".$this->foto3."',
                     '".$this->adjunto."',
                     '".$this->palabraClave1."',
                     '".$this->palabraClave2."',
                     '".$this->palabraClave3."',
                     '".$this->estado."',
                     '".$this->usuario."');";
          $save=$this->db()->query($query);
          //$this->db()->error;
          return $save;
      }
    }
}
?>

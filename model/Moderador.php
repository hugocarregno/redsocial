<?php
class Moderador extends EntidadBase{
  private $id;
  private $usuario;
  private $password;
  private $usuarioUltMod;
  private $fechaUltMod;
  private $usuarioAlta;
  private $fechaAlta;
  private $estado;
  private $nombre;
  private $apellido;
  private $sexo;
  private $mail;
  private $telefono;
  private $imagenPerfil;
  private $administrador;

  public function __construct($adapter) {
      $table="moderador";
      parent::__construct($table,$adapter);
  }

  public function getId() {
      return $this->id;
  }

  public function setId($id) {
      $this->id = $id;
  }

  public function getUsuario(){
      return $this->usuario;
  }
  public function setUsuario($usuario){
      $this->usuario=$usuario;
  }
  public function getPassword(){
      return $this->password;
  }
  public function setPassword($password){
      $this->password=$password;
  }
  public function getUsuarioUltMod(){
      return $this->Usuarioultmod;
  }
  public function setUsuarioUltMod($usuarioUltMod){
       $this->usuarioUltMod=$usuarioUltMod;
  }
  public function getFechaUltMod(){
      return $this->fechaUltMod;
  }
  public function setFechaUltMod($fechaUltMod){
      $this->fechaUltMod=$fechaUltMod;
  }
  public function getUsuarioAlta(){
      return $this->UsuarioAlta;
  }
  public function setUsuarioAlta($usuarioAlta){
       $this->usuarioAlta=$usuarioAlta;
  }
  public function getFechaAlta(){
      return $this->fechaAlta;
  }
  public function setFechaAlta($fechaAlta){
      $this->fechaAlta=$fechaAlta;
  }
  public function getEstado(){
      return $this->estado;
  }
  public function setEstado($estado){
      $this->estado=$estado;
  }
  public function getNombre() {
      return $this->nombre;
  }

  public function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  public function getApellido() {
      return $this->apellido;
  }

  public function setApellido($apellido) {
      $this->apellido = $apellido;
  }

  public function getSexo() {
      return $this->sexo;
  }

  public function setSexo($sexo) {
      $this->sexo = $sexo;
  }

  public function getMail(){
      return $this->mail;
  }
  public function setMail($mail){
      $this->mail=$mail;
  }
  public function getTelefono(){
      return $this->telefono;
  }
  public function setTelefono($telefono){
       $this->telefono=$telefono;
  }
  public function getImagenPerfil(){
      return $this->imagenperfil;
  }
  public function setImagenPerfil($imagenperfil){
      $this->imagenperfil=$imagenperfil;
  }
  public function setAdministrador($administrador){
    $this->administrador=$administrador;
  }
  public function getAdministrator(){
    return $this->administrator;
  }

  public function save(){
    //require_once "Administrador.php";
  //verifico si el usuario se encuentra en la BD
  //sino es null entonces UPDATE
  //si es null entonces INSERT
  if($this->id){
    $query= "UPDATE moderador set usuario = '$this->usuario', password = '$this->password', usuarioUltMod = '$this->usuarioUltMod', fechaUltMod = '$this->fechaUltMod', usuarioAlta = '$this->usuarioAlta'
    , fechaAlta = '$this->fechaAlta', estado = '$this->estado', nombre = '$this->nombre', apellido = '$this->apellido' , sexo = '$this->sexo', mail = '$this->mail' ,telefono = '$this->telefono', imagenPerfil = '$this->imagenPerfil' where id = $this->id";
    $save=$this->db()->query($query);
    //$this->db()->error;
    return $save;

  }else{
          $query="INSERT INTO moderador (id, usuario, password, usuarioUltMod, fechaUltMod, usuarioAlta, fechaAlta, estado, nombre, apellido, sexo, mail, telefono, imagenPerfil)
              VALUES(NULL,'".$this->usuario."',
                     '".$this->password."',
                     NULL,
                     NULL,
                     '".$this->usuarioAlta."',
                     '".$this->fechaAlta."',
                     '".$this->estado."',
                     '".$this->nombre."',
                     '".$this->apellido."',
                     '".$this->sexo."',
                     '".$this->mail."',
                     '".$this->telefono."',
                     '".$this->imagenPerfil."');";
                     //$this->administrador->getId()
          $save=$this->db()->query($query);

          //$this->db()->error;
          return $save;
      }
    }
}
?>

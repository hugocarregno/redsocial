<?php
class UsuarioSitio extends EntidadBase{
    private $id;
    private $usuario;
    private $password;
    private $usuarioultmod;
    private $fechaultmod;
    private $fechaalta;
    private $estado;
    private $nombre;
    private $apellido;
    private $sexo;
    private $mail;
    private $telefono;
    private $imagenperfil;
    private $administrador;

    public function __construct($adapter) {
        $table="usuario_sitio";
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
    public function setUsuarioUltMod($usuarioultmod){
         $this->usuarioultmod=$usuarioultmod;
    }
    public function getFechaUltMod(){
        return $this->fechaultmod;
    }
    public function setFechaUltMod($fechaultmod){
        $this->fechaultmod=$fechaultmod;
    }
    public function getFechaAlta(){
        return $this->fechaalta;
    }
    public function setFechaAlta($fechaalta){
        $this->fechaalta=$fechaalta;
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
    public function getAdministrator(){
      return $this->administrador;
    }
    public function setAdministrador($administrador){
      $this->administrador=$administrador;
    }
    public function save(){
    //  require_once "Administrador.php";

    //verifico si el usuario se encuentra en la BD
		//sino es null entonces UPDATE
		//si es null entonces INSERT
		if($this->id){
			$query= "UPDATE usuario_sitio set usuario = '$this->usuario', password = '$this->password', usuarioultmod = '$this->usuarioultmod', fechaultmod = '$this->fechaultmod', fechaalta = '$this->fechaalta', estado = '$this->estado', nombre = '$this->nombre', apellido = '$this->apellido'
			,sexo = '$this->sexo', mail = '$this->mail' ,telefono = '$this->telefono', imagenperfil = '$this->imagenperfil' where id = $this->id";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;

		}else{
            $query="INSERT INTO usuario_sitio (id, usuario, password, usuarioultmod, fechaultmod, fechaalta, estado, nombre, apellido, sexo, mail, telefono, imagenperfil)
                VALUES(NULL,'".$this->usuario."',
                       '".$this->password."',
                       NULL,
                       NULL,
                       '".$this->fechaalta."',
                       '".$this->estado."',
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->sexo."',
                       '".$this->mail."',
                       '".$this->telefono."',
                       '".$this->imagenperfil."');";
            $save=$this->db()->query($query);

            //$this->db()->error;
            return $save;
        }
      }

}
?>

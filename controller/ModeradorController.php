<?php
class ModeradorController extends ControladorBase{
  public $conectar;
  public $adapter;

  public function __construct() {
      parent::__construct();

      $this->conectar=new Conectar();
      $this->adapter =$this->conectar->conexion();
  }

  public function panelModerador(){
    session_start();
    //Creamos el objeto usuario
  //  $administrador=new Administrador($this->adapter);

    //Conseguimos todos los usuarios
    //$allusers=$usuario->getAll();
  // lo llevo a entidad base para que controle
//  $administrador = $administrador->getAll();
  //$administrador->setId(1);
  //if($administrador){
    $this->view("panelModerador","");
  //}
  //else{
//    echo "no";
//  }

  }

}

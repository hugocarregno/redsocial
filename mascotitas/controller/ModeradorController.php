<?php
class ModeradorController extends ControladorBase{
  public $conectar;
  public $adapter;

  public function __construct() {
      parent::__construct();

      $this->conectar=new Conectar();
      $this->adapter =$this->conectar->conexion();
  }



}

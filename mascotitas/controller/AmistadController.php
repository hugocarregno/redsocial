<?php
class AmistadController extends ControladorBase{
  public $conectar;
	public $adapter;

  public function __construct() {
      parent::__construct();
      $this->conectar=new Conectar();
      $this->adapter =$this->conectar->conexion();
    }
    
    public function solicitudes(){
      session_start();
      $amistad=new Amistad($this->adapter);
      $amistad=$amistad->getSolicitudes($_SESSION['id']);
      if($amistad){
        $this->view("amistad",array("amistad"=>$amistad));
      }else{
          echo "<script>alert('No tienes solicitudes en este momento');</script>";
          $this->view("amistad","");
      }

    }


    public function cancelarAmistad(){
      session_start();
      $amistad= new Amistad($this->adapter);
      $usuario= new UsuarioSitio($this->adapter);
      $usuario->getByColumns("usuarioEmisor",$_SESSION['id'],"usuarioReceptor",$_POST['id']);

    }

}

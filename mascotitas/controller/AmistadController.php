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

    public function solicitarAmistad(){
      session_start();
      $amistad= new Amistad($this->adapter);
      $usuario= new UsuarioSitio($this->adapter);
      $usuario=$usuario->getBy("id",$_POST['id']);
      if($usuario){
        $amistad->setUsuarioEmisor($_SESSION['id']);
        $amistad->setUsuarioReceptor($usuario[0]->id);
        //date_default_timezone_set("America/Argentina/San_Luis");
        $hoy = date("Y-m-d H:i:s", time());
        $amistad->setFecha($hoy);
        $amistad->setEstado("pendiente");
        $save = $amistad->save();
        //$amistad=array($amistad);
        $amistad = $amistad->getByColumns("usuarioEmisor", $_SESSION['id'], "usuarioReceptor", $usuario[0]->id);
        //echo "<script>alert('Solicitud enviada correctamente');</script>";
        $this->view("perfil",array("usuario"=>$usuario,"amistad"=>$amistad));
        //$this->redirect("usuario","perfil");
      }else{
            echo "No se encontro el usuario";
      }
    }

    public function cancelarAmistad(){
      session_start();
      $amistad= new Amistad($this->adapter);
      $usuario= new UsuarioSitio($this->adapter);
      $amistad->getByColumns("usuarioEmisor",$_SESSION['id'],"usuarioReceptor",$_POST['id']);

    }

    public function aceptarAmistad(){
      session_start();
      $amista= new Amistad($this->adapter);
      $amistad= new Amistad($this->adapter);
      $amista=$amista->getByColumns("usuarioEmisor", $_POST['id'], "usuarioReceptor", $_SESSION['id']);
      if($amista){
          $amistad->setId($amista[0]->id);
          $amistad->setUsuarioEmisor($amista[0]->usuarioEmisor);
          $amistad->setUsuarioReceptor($amista[0]->usuarioReceptor);
          $amistad->setEstado("aceptado");
          $hoy = date("Y-m-d H:i:s", time());
          $amistad->setFecha($hoy);
          echo "<script>alert('estoy aca');</script>";
          $save=$amistad->save();
          $amistad=$amistad->getSolicitudes($_SESSION['id']);
          if($amistad){
            $this->view("amistad",array("amistad"=>$amistad));
          }else{
            echo "<script>alert('No tienes solicitudes en este momento');</script>";
            $this->view("amistad","");
          }

      }else{
        echo "<script>alert('No tienes solicitudes en este momento');</script>";
        $this->view("amistad","");
      }
    }

}

<?php
  class LoginController extends ControladorBase
  {
    public $conectar;
	  public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function iniciar(){
      if(isset($_POST['btn-accion']))
      {
        $email = $_POST['usuario'];
        $psw = openssl_encrypt($_POST['psw'], COD, KEY);
      	session_start();
        //Creamos el objeto usuario
      	$usuario=new UsuarioSitio($this->adapter);
        $administrador=new Administrador($this->adapter);
        $moderador= new Moderador($this->adapter);

        $usuario = $usuario->getByColumns("usuario", $email, "password", $psw);
        $administrador = $administrador->getByColumns("usuario", $email, "password", $psw);
        $moderador = $moderador->getByColumns("usuario", $email, "password", $psw);
        if($usuario){
          $_SESSION['id'] = $usuario[0]->id;
      		$_SESSION['usuario'] = $usuario[0]->usuario;
      		$_SESSION['password']=openssl_decrypt($usuario[0]->password,COD,KEY);
          $this->view("muro",array("usuario" => $usuario));
          }elseif($administrador){
            $_SESSION['id'] = $administrador[0]->id;
        		$_SESSION['usuario'] = $administrador[0]->usuario;
        		$_SESSION['password']=openssl_decrypt($administrador[0]->password,COD,KEY);
            $this->view("panelAdministrador",array("administrador" => $administrador));
            }elseif($moderador){
              $_SESSION['id'] = $moderador[0]->id;
        		  $_SESSION['usuario'] = $moderador[0]->usuario;
        		  $_SESSION['password']=openssl_decrypt($moderador[0]->password,COD,KEY);
              $this->view("panelModerador",array("moderador" => $moderador));
              }else{
                $mensaje='<span>usuario o contraseña incorrecta</span>';
                $this->view("index",array("mensaje"=>$mensaje));
              }

      }

    }

  }
?>

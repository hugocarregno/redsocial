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

    public function index(){
      $administrador=new Administrador($this->adapter);
      $administrador=$administrador->getAll();
      if($administrador){
        $mensaje="";
        $this->view("index",array("mensaje" => $mensaje ));
      }else{
        $this->redirect("Administrador","index");
      }
    }

    public function iniciar(){
      if(isset($_POST['btn-accion']) && isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['password']) && !empty($_POST['password']))
      {
        $nombreUsuario = $_POST['usuario'];
        $psw = openssl_encrypt($_POST['password'], COD, KEY);
      	session_start();
      	$usuario=new UsuarioSitio($this->adapter);
        $administrador=new Administrador($this->adapter);
        $moderador= new Moderador($this->adapter);
        if($usuario->getBy("usuario", $nombreUsuario)){
            $usuario = $usuario->getByColumns("usuario", $nombreUsuario, "password", $psw);
            if($usuario){
              $_SESSION['id'] = $usuario[0]->id;
          		$_SESSION['usuario'] = $usuario[0]->usuario;
          		$_SESSION['password'] = openssl_decrypt($usuario[0]->password,COD,KEY);
              $_SESSION['nombre'] = $usuario[0]->nombre;
              $_SESSION['apellido'] = $usuario[0]->apellido;
              $_SESSION['tipo'] = "Usuario";
              $_SESSION['fechaAlta'] = $usuario[0]->fechaAlta;
              $_SESSION['sexo'] = $usuario[0]->sexo;
              $_SESSION['mail'] = $usuario[0]->mail;
              $_SESSION['telefono'] = $usuario[0]->telefono;
              $_SESSION['imagenPerfil'] = $usuario[0]->imagenPerfil;
              $this->redirect("post","muro");
              //$this->view("muro",array("usuario" => $usuario));
            }else{
              $mensaje='<span>Contraseña incorrecta</span>';
              $this->view("index",array("mensaje"=>$mensaje));
            }
        }elseif($moderador->getBy("usuario", $nombreUsuario)){
          $moderador = $moderador->getByColumns("usuario", $nombreUsuario, "password", $psw);
          if($moderador){
            $_SESSION['id'] = $moderador[0]->id;
            $_SESSION['usuario'] = $moderador[0]->usuario;
            $_SESSION['password']=openssl_decrypt($moderador[0]->password,COD,KEY);
            $_SESSION['nombre'] = $moderador[0]->nombre;
            $_SESSION['apellido'] = $moderador[0]->apellido;
            $_SESSION['tipo'] = "Moderador";
            $_SESSION['fechaAlta'] = $moderador[0]->fechaAlta;
            $_SESSION['sexo'] = $moderador[0]->sexo;
            $_SESSION['mail'] = $moderador[0]->mail;
            $_SESSION['telefono'] = $moderador[0]->telefono;
            $_SESSION['imagenPerfil'] =$moderador[0]->imagenPerfil;
            $this->view("panelModerador",array("moderador" => $moderador));
          }else{
            $mensaje='<span>Contraseña incorrecta</span>';
            $this->view("index",array("mensaje"=>$mensaje));
          }
        }elseif($administrador->getBy("usuario", $nombreUsuario)){
          $administrador = $administrador->getByColumns("usuario", $nombreUsuario, "password", $psw);
          if($administrador){
            $_SESSION['id'] = $administrador[0]->id;
        		$_SESSION['usuario'] = $administrador[0]->usuario;
        		$_SESSION['password']=openssl_decrypt($administrador[0]->password,COD,KEY);
            $_SESSION['nombre'] = $administrador[0]->nombre;
            $_SESSION['apellido'] = $administrador[0]->apellido;
            $_SESSION['tipo'] = "Administrador";
            $_SESSION['fechaAlta'] = $administrador[0]->fechaAlta;
            $_SESSION['sexo'] = $administrador[0]->sexo;
            $_SESSION['mail'] = $administrador[0]->mail;
            $_SESSION['telefono'] = $administrador[0]->telefono;
            $_SESSION['imagenPerfil'] =$administrador[0]->imagenPerfil;
            $adm= new Administrador($this->adapter);
            $adm = $adm->getFirst();
            $_SESSION['idSuperAdmin']=$adm[0]->id;
            $this->view("panelAdministrador","");
          }else{
            $mensaje='<span>Contraseña incorrecta</span>';
            $this->view("index",array("mensaje"=>$mensaje));
          }
        }else{
            $mensaje='<span>usuario o contraseña incorrecta</span>';
            $this->view("index",array("mensaje"=>$mensaje));
        }

      }else{
        if(empty($_POST['usuario']) && empty($_POST['password'])){
            $mensaje='<span>Ingresar Usuario y contraseña</span>';
        }elseif(empty($_POST['usuario'])){
          $mensaje='<span>Ingresar Usuario</span>';
        }else{
          $mensaje='<span>Ingresar contraseña</span>';
        }
        $this->view("index",array("mensaje"=>$mensaje));

      }

    }

    public function cerrarSesion(){
      session_start();
      $_SESSION = array();
      if(ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
      }
      session_destroy();

      $this->redirect("Login","index");
    }

  }
?>

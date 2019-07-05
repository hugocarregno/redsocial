<?php
class AdministradorController extends ControladorBase{
  public $conectar;
  public $adapter;

  public function __construct() {
      parent::__construct();

      $this->conectar=new Conectar();
      $this->adapter =$this->conectar->conexion();
  }

  public function index(){
    $administrador=new Administrador($this->adapter);

    //Conseguimos todos los administradores
    $administrador=$administrador->getAll();
    //si no hay admin, se configura la cuenta admin
    if($administrador){
      $this->redirect("Login","index");
    }else{
      $this->view("administradorConfInicial","");
    }
  }


  public function crear(){
    $existeUsuario=new UsuarioSitio($this->adapter);
    $existeModerador=new Moderador($this->adapter);
    $existeAdmin=new Administrador($this->adapter);
    if(!$existeUsuario->getBy("usuario",$_POST['usuario']) && !$existeModerador->getBy("usuario",$_POST['usuario']) && !$existeAdmin->getBy("usuario",$_POST['usuario'])){
      if(isset($_POST["btn_accion"]) && isset($_POST['usuario']) && trim($_POST['usuario']," ") && isset($_POST['password']) && trim($_POST['password']," ") && isset($_POST['nombre']) && trim($_POST['nombre']," ") &&
        isset($_POST['apellido']) && trim($_POST['apellido']," ") && isset($_POST['sexo']) && trim($_POST['sexo']," ") && isset($_POST['mail']) && trim($_POST['mail']," ") && isset($_POST['telefono']) &&
        trim($_POST['telefono']," ") && !empty($_FILES['imagenPerfil']['name']) ){

          //Creamos un administrador
          $administrador=new Administrador($this->adapter);
          $admin=new Administrador($this->adapter);
          if($administrador=$administrador->getFirst()){
            $admin->setUsuarioAlta($administrador[0]->id);
          }else{
              $admin->setUsuarioAlta(1);
          }

          $admin->setUsuario($_POST["usuario"]);
          $admin->setPassword(openssl_encrypt($_POST["password"], COD, KEY));

          date_default_timezone_set("UTC");
          $hoy=strftime( "%Y-%m-%d", time() );
          $admin->setFechaAlta($hoy);
          //$usuario->setFechaUltMod(NULL);
          $admin->setNombre($_POST["nombre"]);
          $admin->setApellido($_POST["apellido"]);
          if($_POST["sexo"]=="masculino"){
              $admin->setSexo(1);
          }else{
              $admin->setSexo(0);
          }
          $admin->setMail($_POST["mail"]);
          $admin->setTelefono($_POST["telefono"]);
          $admin->setEstado(1);
          $fileName=$_FILES['imagenPerfil']['name'];
          $tmpName=$_FILES['imagenPerfil']['tmp_name'];

          $fileSize=$_FILES['imagenPerfil']['size'];
          $fileType=$_FILES['imagenPerfil']['type'];
          if($tmpName==""){
            echo "la carpeta temporal esta vacia";
          }else{
            //echo $tmpName;
          }
          //si es menor de 3 mega subirlo

          if($fileSize<3000000){
            if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){

               $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."administrador/";

               $extension=explode("/",$fileType);
               $fileName=$admin->getUsuario().'.'.$extension[1];
               $filePath=$imagenes.$fileName;

               if($result=move_uploaded_file($tmpName, $filePath)){
                  $admin->setImagenPerfil($fileName);
               }else{
                  echo "no se subio";
                  exit;
               }
               }else{
                  echo "debe subir imagen con extension .jpg .jpeg .gif o .png";
               }
            }else{
              echo "la imagen supera 3 MB";
            }
          $save=$admin->save();
          if($_GET['action']=="crear" && $administrador){
            $this->view("panelAdministrador", array("administrador" => $administrador ));
          }else{
          // ver si esta de mas este else
            $this->redirect("Administrador", "index");
          }
        }else{
          $mensaje='<span>Todos los campos son obligatorios</span>';
        $this->view("registrarAdministrador",array("mensaje"=>$mensaje));
        }
    }else{
      echo "<script>alert('El usuario ya existe'); </script>";
      $mensaje='<span>Ingrese un usuario diferente</span>';
      $this->view("registrarAdministrador",array("mensaje"=>$mensaje));
    }
  }

  public function panelAdministrador(){
    //Creamos el objeto usuario
    $administrador=new Administrador($this->adapter);

    //Conseguimos todos los usuarios
    //$allusers=$usuario->getAll();
  // lo llevo a entidad base para que controle
  $administrador = $administrador->getAll();
  //$administrador->setId(1);
  if($administrador){
    $this->view("panelAdministrador",array("administrador"=>$administrador));
  }
  else{
    echo "no";
  }

  }

  public function registrarAdministrador(){
    //session_start();
     //$_SESSION['id'];
    //$this->view("registrarAdministrador",array("session"=>$_SESSION));
    $this->view("registrarAdministrador","");
  }

  public function registrarModerador(){
    //session_start();
     //$_SESSION['id'];
    //$this->view("registrarAdministrador",array("session"=>$_SESSION));
    $this->view("registrarModerador","");
  }

  public function crearModerador(){
    session_start();
    $existeUsuario=new UsuarioSitio($this->adapter);
    $existeModerador=new Moderador($this->adapter);
    $existeAdmin=new Administrador($this->adapter);
    if(!$existeUsuario->getBy("usuario",$_POST['usuario']) && !$existeModerador->getBy("usuario",$_POST['usuario']) && !$existeAdmin->getBy("usuario",$_POST['usuario'])){
      var_dump($_POST);
      if(isset($_POST["btn_accion"]) && isset($_POST['usuario']) && trim($_POST['usuario']," ") && isset($_POST['password']) && trim($_POST['password']," ") && isset($_POST['nombre']) && trim($_POST['nombre']," ") &&
        isset($_POST['apellido']) && trim($_POST['apellido']," ") && isset($_POST['sexo']) && trim($_POST['sexo']," ") && isset($_POST['mail']) && trim($_POST['mail']," ") && isset($_POST['telefono']) &&
        trim($_POST['telefono']," ") && !empty($_FILES['imagenPerfil']['name']) ){
        //Creamos un administrador
        $moderador=new Moderador($this->adapter);
        $moderador->setUsuarioAlta($_SESSION['id']);


        $moderador->setUsuario($_POST["usuario"]);
        $moderador->setPassword(openssl_encrypt($_POST["password"], COD, KEY));



        date_default_timezone_set("UTC");
        $hoy=strftime( "%Y-%m-%d", time() );
        $moderador->setFechaAlta($hoy);
        //$usuario->setFechaUltMod(NULL);
        $moderador->setNombre($_POST["nombre"]);
        $moderador->setApellido($_POST["apellido"]);
        if($_POST["sexo"]=="masculino"){
            $moderador->setSexo(1);
        }else{
            $moderador->setSexo(0);
        }
        $moderador->setMail($_POST["mail"]);
        $moderador->setTelefono($_POST["telefono"]);
        $moderador->setEstado(1);
        $fileName=$_FILES['imagenPerfil']['name'];
        $tmpName=$_FILES['imagenPerfil']['tmp_name'];

        $fileSize=$_FILES['imagenPerfil']['size'];
        $fileType=$_FILES['imagenPerfil']['type'];
        if($tmpName==""){
          echo "la carpeta temporal esta vacia";
        }else{
          //echo $tmpName;
        }
        //si es menor de 3 mega subirlo

        if($fileSize<3000000){
          if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
             $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."moderador/";
             $extension=explode("/",$fileType);
             $fileName=$moderador->getUsuario().'.'.$extension[1];
             $filePath=$imagenes.$fileName;
             if($result=move_uploaded_file($tmpName, $filePath)){
                $moderador->setImagenPerfil($fileName);
             }else{
                echo "no se subio";
                exit;
             }
             }else{
                echo "debe subir imagen con extension .jpg .jpeg .gif o .png";
             }
          }else{
            echo "la imagen supera 3 MB";
          }
        $save=$moderador->save();
      }
        $this->view("panelAdministrador", "");
    }else{
      echo "<script>alert('El usuario ya existe'); </script>";
      $mensaje='<span>Ingrese un usuario diferente</span>';
      $this->view("registrarModerador",array("mensaje"=>$mensaje));
    }

  }

}
?>

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
    if(count($administrador)!=0){
      $this->redirect("Usuario","index");
    }else{
      $this->view("administradorConfInicial","");
    }
  }

  public function crear(){
    //mejorar condicion
    if(isset($_POST["nombre"])){

      //Creamos un administrador
      $administrador=new Administrador($this->adapter);
      $administrador=$administrador->getFirst();
      $admin=new Administrador($this->adapter);
      if(count($administrador)==1){
        $admin->setUsuarioAlta($administrador[0]->id);
      }else{
          $admin->setUsuarioAlta(1);
      }

      $admin->setUsuario($_POST["usuario"]);
      $admin->setPassword($_POST["password"]);



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
        echo "esta vacio";
      }else{
        echo $tmpName;
      }
      //si es menor de 1 mega subirlo

      if($fileSize<3000000){
        if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
           echo "<br>";
           echo $fileName;
           echo "<br>";
           echo $tmpName;
           $imagenes=$_SERVER['DOCUMENT_ROOT']."/mascotitas/assets/img/administrador/";
           echo "<br>";
           echo $imagenes;
           $extension=explode("/",$fileType);
           $fileName=$admin->getUsuario().'.'.$extension[1];
           $filePath=$imagenes.$fileName;
           echo "<br>";
           echo $filePath;
           echo "<br>";
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
          echo "la imagen supera 1 MB";
        }
      $save=$admin->save();
    }
    $this->redirect("Administrador", "index");

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
  }else{
    echo "no";
    //$nombre=$usuario->
    //$this->view("index",array("usuario"=>$usuario));
  }



    //$this->view("panelAdministrador", array('' => , ););
  }

}
?>

<?php
class PostController extends ControladorBase{
  public $conectar;
	public $adapter;

  public function __construct() {
      parent::__construct();
      $this->conectar=new Conectar();
      $this->adapter =$this->conectar->conexion();
    }

public function crearPublicacion(){
  session_start();

  //validar que se ingrese todo
  $n=1;
  $archivo="foto";
  //adjunto
  //palabras claves


  if($_POST['publicar'] && !empty($_FILES[$archivo.$n]['tmp_name'])){
    if(isset($_POST['titulo']) && trim($_POST['titulo']," ")){
      if(isset($_POST['descripcion']) && trim($_POST['descripcion']," ")){

        $publicacion = new Post($this->adapter);
        date_default_timezone_set("America/Argentina/San_Luis");
        //$timestamp = time();
        $hoy = date("Y-m-d H:i:s", time());
        $publicacion->setFecha($hoy);
        $fecha = str_replace(':',"",$publicacion->getFecha());
        $fecha = str_replace(' ',"",$fecha);
        $publicacion->setTitulo($_POST['titulo']);
        $publicacion->setDescripcion($_POST['descripcion']);
        while($n<=3){
          if(!empty($_FILES[$archivo.$n]['tmp_name'])){
            $fileName=$_FILES[$archivo.$n]['name'];
            $tmpName=$_FILES[$archivo.$n]['tmp_name'];
            $fileSize=$_FILES[$archivo.$n]['size'];
            $fileType=$_FILES[$archivo.$n]['type'];
            //si es menor de 3 mega subirlo
            if($fileSize<3000000){
              if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
                $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."post/";
                $extension=explode("/",$fileType);
                $fileName=$archivo.$n.$fecha.'.'.$extension[1];
                $filePath=$imagenes.$fileName;
                if(move_uploaded_file($tmpName, $filePath)){
                  if($n==3){
                    $publicacion->setFoto3($fileName);
                  }elseif ($n==2) {
                    $publicacion->setFoto2($fileName);
                  }else{
                    $publicacion->setFoto1($fileName);
                  }
                }else{
                      echo "<script>alert('foto ".$n." no se subio');</script>";
                      exit;
                      }
              }else{
                    echo "<script>alert('Debe subir imagen con extension .jpg .jpeg .gif o .png');</script>";
                    $this->view("muro","");
                    }
            }else{
                  echo "<script>alert('La imagen supera 3 MB');</script>";
                  $this->view("muro","");
                  }
          }
          $n++;
        }
        if(!empty($_FILES['adjunto']['tmp_name'])){
          //guarda en formato distinto
          $fileName=$_FILES['adjunto']['name'];
          $tmpName=$_FILES['adjunto']['tmp_name'];
          $fileType=$_FILES['adjunto']['type'];
          if($fileType!="image/jpeg" && $fileType!="image/jpg" && $fileType!="image/png" && $fileType!="image/gif"){
            $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."post/";
            $extension=explode("/",$fileType);
            $fileName='adjunto'.$fecha.'.'.$extension[1];
            $filePath=$imagenes.$fileName;
            if(move_uploaded_file($tmpName, $filePath)){
                $publicacion->setAdjunto($fileName);
            }else{
                  echo "<script>alert('adjunto no se subio');</script>";
                  exit;
                  }
          }else{
                echo "<script>alert('Debe subir imagen con extension .jpg .jpeg .gif o .png');</script>";
                $this->view("muro","");
                }
        }
        $publicacion->setEstado(1);
        $publicacion->setUsuario($_SESSION['id']);
        $publicacion->setVisibilidad($_POST['visibilidad']);
        //preguntar si hay adjunto y mandarlo
        //pregtuntar si hay fotos y mandarlo
        $save=$publicacion->save();

        $this->redirect("post","muro");
        //se actualice el muro en usuario muro o aca ver cuale s mejor

      }else{
        echo "<script>alert('Debe ingresar una descripción');</script>";
        $this->view("muro","");
      }
    }else{
      echo "<script>alert('Debe ingresar un título');</script>";
      $this->view("muro","");
    }


  }else{
    echo "<script>alert('La publicacion debe contener al menos una foto');</script>";
    $this->view("muro","");

  }
}

public function muro(){
  session_start();
  $post = new Post($this->adapter);
  $post=$post->getPublicaciones($_SESSION['id']);
  if($post){
    $this->view("muro",array("post"=>$post));
  }else{
        echo "<script>alert('Busca a tus amigos para ver publicaciones');</script>";
        $this->view("muro","");
      }
}

}

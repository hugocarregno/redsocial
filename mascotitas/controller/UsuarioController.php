<?php
class UsuarioController extends ControladorBase{
    public $conectar;
	public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function registrar(){
      $this->view("registrar","");
    }

		//Procesa los datos del formulario de inserción
		public function crear(){

      $existeUsuario=new UsuarioSitio($this->adapter);
      $existeModerador=new Moderador($this->adapter);
      $existeAdmin=new Administrador($this->adapter);

      if(!$existeUsuario->getBy("usuario",$_POST['usuario']) && !$existeModerador->getBy("usuario",$_POST['usuario']) && !$existeAdmin->getBy("usuario",$_POST['usuario'])){

        if(isset($_POST["btn_accion"]) && isset($_POST['usuario']) && trim($_POST['usuario']," ") && isset($_POST['password']) && trim($_POST['password']," ") && isset($_POST['nombre']) && trim($_POST['nombre']," ") &&
        isset($_POST['apellido']) && trim($_POST['apellido']," ") && isset($_POST['sexo']) && trim($_POST['sexo']," ") && isset($_POST['mail']) && trim($_POST['mail']," ") && isset($_POST['telefono']) &&
        trim($_POST['telefono']," ") && !empty($_FILES['imagenPerfil']['name']) ){
				      //Creamos un usuario
				  $usuario=new UsuarioSitio($this->adapter);
          $usuario->setUsuario($_POST["usuario"]);
          $usuario->setPassword(openssl_encrypt($_POST["password"], COD, KEY));
          //$usuario->setUsuarioUltMod(NULL);
          date_default_timezone_set("UTC");
          $hoy=strftime( "%Y-%m-%d", time() );
          $usuario->setFechaAlta($hoy);
          //$usuario->setFechaUltMod(NULL);
				  $usuario->setNombre($_POST["nombre"]);
				  $usuario->setApellido($_POST["apellido"]);
          if($_POST["sexo"]=="masculino"){
            $usuario->setSexo(1);
          }else{
            $usuario->setSexo(0);
          }
				  $usuario->setMail($_POST["mail"]);
          $usuario->setTelefono($_POST["telefono"]);
          $usuario->setEstado(1);
          $fileName=$_FILES['imagenPerfil']['name'];
          $tmpName=$_FILES['imagenPerfil']['tmp_name'];

          $fileSize=$_FILES['imagenPerfil']['size'];
  	      $fileType=$_FILES['imagenPerfil']['type'];
          if($tmpName==""){
            echo "esta vacio";
          }else{
            echo $tmpName;
          }
          //si es menor de 3 mega subirlo
          if($fileSize<3000000){
            if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
        	   echo "<br>";
        	   echo $fileName;
        	   echo "<br>";
        	   echo $tmpName;
        	   $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."usuario_sitio/";
        	   echo "<br>";
        	   echo $imagenes;
        	   $extension=explode("/",$fileType);
        	   $fileName=$usuario->getUsuario().'.'.$extension[1];
        	   $filePath=$imagenes.$fileName;
        	   if($result=move_uploaded_file($tmpName, $filePath)){
        		    $usuario->setImagenPerfil($fileName);
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
				$save=$usuario->save();
			  }else{
              $mensaje='<span>Completar Campos</span>';
              $this->view("registrar",array("mensaje"=>$mensaje));
    }
    $this->redirect("login", "index");
  }else{
      echo "<script>alert('El usuario ya existe'); </script>";
      $mensaje='<span>Ingrese un usuario diferente</span>';
      $this->view("registrar",array("mensaje"=>$mensaje));
    }


		}

		//Procesa el borrado de unUsuario
		public function borrar(){
			if(isset($_GET["id"])){
				$id=(int)$_GET["id"];

				$usuario=new Usuario($this->adapter);
				$usuario->deleteById($id);
			}
			$this->redirect();
		}


		//Muestra el formulario de Actualizacion
		public function editar(){
			if(isset($_GET["id"])){
				$id=(int)$_GET["id"];

				//Conseguimos todos los usuarios
				$provincia=new Provincia($this->adapter);
				$allProvincias= $provincia->getAll();

				//traemos todos los datos del usuario para mostrarlos en el formulario
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);

				//Cargamos la vista para mostrar formulario de insert
				$this->view("editar",array(
					"allProvincias"=>$allProvincias,
					"usuario"=>$usuario
				));
			}
		}
		//Procesa los datos del formulario de edición
		public function actualizar(){
			if(isset($_POST["nombre"])){

				//Creamos un usuario
				$usuario=new Usuario($this->adapter);
				$usuario->setId($_POST["id"]);
				$usuario->setNombre($_POST["nombre"]);
				$usuario->setApellido($_POST["apellido"]);
				$usuario->setEmail($_POST["email"]);

				//al constructor de provincia le paso el id
				$provincia = new Provincia($this->adapter);
				$provincia->setId($_POST["provincia"]);
				$usuario->setProvincia($provincia);

				$save=$usuario->save();
			}
			$this->redirect("Usuario", "index");
		}

    public function perfil(){
      session_start();
      $this->view("perfil","");
    }

    public function amigos(){
      session_start();
      $this->view("amistad","");
    }

    public function muro(){
      session_start();
      $this->view("muro","");
    }


}
?>

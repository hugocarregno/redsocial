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
        	   $imagenes=$_SERVER['DOCUMENT_ROOT'].DIRECTORIO."Usuario/";
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

/*		//Procesa el borrado de unUsuario
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
*/
    public function perfil(){
      session_start();
      if(isset($_POST['usuario']) || isset($_POST['lugar'])){
        $usuario= new UsuarioSitio($this->adapter);
        $usuario=$usuario->getBy("usuario",$_POST['busqueda']);
        if($usuario){
          //usuario existe
          $amistad = new Amistad($this->adapter);
          $amistad = $amistad->getAmistad($_SESSION['id'], $usuario[0]->id);
          if(($_POST['lugar'])=="muro" && $_SESSION['id'] == $usuario[0]->id){
            $this->view("perfil","");
            exit;
          }
          if($amistad){
            //ver que estado tiene
            $this->view("perfil",array("usuario"=>$usuario,"amistad"=>$amistad));
          }else{
            $this->view("perfil",array("usuario"=>$usuario));
          }
      }
    }
      $this->view("perfil","");
    }



  //  public function muro(){
  //    session_start();
  //    $this->view("muro","");
//    }



    public function buscarUsuario(){
      session_start();
      if(isset($_POST['buscar']) && trim($_POST['busqueda']," ")){
        //si no tiene # se supone que es una persona
        if($_POST['busqueda'][0]!='#'){
          //si es el usuario que esta logeado
          if($_POST['busqueda']==$_SESSION['usuario']){
            $this->view("perfil","");
            exit;
          }
          $usuario= new UsuarioSitio($this->adapter);
          $usuario=$usuario->getBy("usuario",$_POST['busqueda']);
          if($usuario){
            //usuario existe
            $amistad = new Amistad($this->adapter);
            $amistad = $amistad->getAmistad($_SESSION['id'], $usuario[0]->id);
            if($amistad){
              $this->view("perfil",array("usuario"=>$usuario,"amistad"=>$amistad));
            }else{
              $this->view("perfil",array("usuario"=>$usuario));
            }
          }else{
                echo "<script>alert('El usuario ingresado no existe');</script>";
                $this->view("muro","");
                }
        }else{
        //palabra clave
        echo "<script>alert('palabra clave');</script>";
        }
      }


    }



}
?>

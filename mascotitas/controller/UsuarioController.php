<?php
class UsuarioController extends ControladorBase{
    public $conectar;
	public $adapter;

    public function __construct() {
        parent::__construct();

        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios
		public function index(){

      $administrador=new Administrador($this->adapter);

      //Conseguimos todos los usuarios
      $administrador=$administrador->getAll();

      if(count($administrador)>=1){
        //Cargamos la vista index y le pasamos valores
        //$this->view("panelAdministrador",array("administrador"=>$administrador));
        $mensaje="";
        $this->view("index",array("mensaje" => $mensaje ));
      }else{
        $this->redirect("Administrador","index");
      }
			/*Creamos el objeto usuario
      $usuario=new UsuarioSitio($this->adapter);

			//Conseguimos todos los usuarios
			$allusers=$usuario->getAll();
      if($allusers){
        //Cargamos la vista index y le pasamos valores
        $this->view("index","");
      }else{
        $this->view("administradorConfInicial","");
      }

       /*
			$this->view("index",array(
				"allusers"=>$allusers,
				"UnaVariableDeLaVista"    =>"Valor de la Vista"
			));*/
		}

		//Muestra el formulario de inserción
		public function insertar(){

			//Conseguimos todos los usuarios
		//	$provincia=new Provincia($this->adapter);
	//		$allProvincias= $provincia->getAll();

			//Cargamos la vista para mostrar formulario de insert
			$this->view("insertar");

		}

    public function registrar(){
      //Creamos el objeto usuario
      $usuario=new UsuarioSitio($this->adapter);

      //Conseguimos todos los usuarios
    //  $allusers=$usuario->getAll();

       //Cargamos la vista index y le pasamos valores
      /*$this->view("registrar",array(
        "allusers"=>$allusers,
        "UnaVariableDeLaVista"    =>"Valor de la Vista"
      ));*/
      $this->view("registrar",array());
    }

		//Procesa los datos del formulario de inserción
		public function crear(){
			if(isset($_POST["nombre"])){

				//Creamos un usuario
				$usuario=new UsuarioSitio($this->adapter);
        $usuario->setUsuario($_POST["usuario"]);
        $usuario->setPassword($_POST["password"]);
        //$usuario->setUsuarioUltMod(NULL);
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
        //si es menor de 1 mega subirlo

        if($fileSize<3000000){
          if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
        	   echo "<br>";
        	   echo $fileName;
        	   echo "<br>";
        	   echo $tmpName;
        	   $imagenes=$_SERVER['DOCUMENT_ROOT']."clonaciones/mascotitas/assets/img/usuario_sitio/";
        	   echo "<br>";
        	   echo $imagenes;
        	   $extension=explode("/",$fileType);
        	   $fileName=$usuario->getUsuario().'.'.$extension[1];
        	   $filePath=$imagenes.$fileName;
        	   echo "<br>";
        	   echo $filePath;
        	   echo "<br>";
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
        	  echo "la imagen supera 1 MB";
        	}


				//al constructor de provincia le paso el id
			//	$provincia = new Provincia($this->adapter);
		//		$provincia->setId($_POST["provincia"]);
		//		$usuario->setProvincia($provincia);

				//$usuario->setPassword(sha1($_POST["password"]));
        //ver si se puede poner encriptacion

				$save=$usuario->save();
			}
			$this->redirect("Usuario", "index");
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

    //public function validarSesion(){

  //  }


}
?>

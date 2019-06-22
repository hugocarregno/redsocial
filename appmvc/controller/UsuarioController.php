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

			//Creamos el objeto usuario
			$usuario=new UsuarioSitio($this->adapter);

			//Conseguimos todos los usuarios
			$allusers=$usuario->getAll();

		   //Cargamos la vista index y le pasamos valores
			$this->view("index",array(
				"allusers"=>$allusers,
				"UnaVariableDeLaVista"    =>"Valor de la Vista"
			));
		}

		//Muestra el formulario de inserción
		public function insertar(){

			//Conseguimos todos los usuarios
			$provincia=new Provincia($this->adapter);
			$allProvincias= $provincia->getAll();

			//Cargamos la vista para mostrar formulario de insert
			$this->view("insertar",array(
				"allProvincias"=>$allProvincias
			));

		}

		//Procesa los datos del formulario de inserción
		public function crear(){
			if(isset($_POST["nombre"])){

				//Creamos un usuario
				$usuario=new Usuario($this->adapter);
				$usuario->setNombre($_POST["nombre"]);
				$usuario->setApellido($_POST["apellido"]);
				$usuario->setEmail($_POST["email"]);

				//al constructor de provincia le paso el id
				$provincia = new Provincia($this->adapter);
				$provincia->setId($_POST["provincia"]);
				$usuario->setProvincia($provincia);

				$usuario->setPassword(sha1($_POST["password"]));
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



}
?>

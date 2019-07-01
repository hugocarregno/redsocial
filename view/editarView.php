<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Ejemplo PHP MySQLi POO MVC</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
       
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
    </head>
    <body>
        <form action="<?php echo $helper->url("usuario","actualizar"); ?>" method="post" class="col-lg-5">
            <h3>Actualizar usuario</h3>
            <hr/>
			<input type="hidden" value="<?php echo $usuario->id;?>" name="id" class="form-control"/>
            Nombre: <input type="text" value="<?php echo $usuario->nombre;?>" name="nombre" class="form-control"/>
            Apellido: <input type="text" value="<?php echo $usuario->apellido;?>" name="apellido" class="form-control"/>
			Provincia de Nacimiento: <select name="provincia" class="form-control"/>
			 <?php foreach($allProvincias as $provincia) {
				 //Solo marco como seleccionada la provincia que tiene el usuario
				 if($usuario->provincia==$provincia->id){
					echo "<option value=\"$provincia->id\" selected> $provincia->descripcion </option> ";
				 }
				 else{
					 echo "<option value=\"$provincia->id\"> $provincia->descripcion </option> ";
				 }
			 }
			 ?>
			</select>
            Email: <input type="text" name="email" value="<?php echo $usuario->email;?>" class="form-control"/>
            Contraseña: <input type="password" disabled name="password" class="form-control"/>
            <input type="submit" value="enviar" class="btn btn-success"/>
        </form>
        <footer class="col-lg-12">
            <hr/>
        </footer>
    </body>
</html>
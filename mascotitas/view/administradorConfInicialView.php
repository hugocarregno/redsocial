<!DOCTYPE html>
<html lang="es">
<head>
    <title>+cotitas - Configuración </title>
    <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <meta name="description" content="Red social para amantes de los animales">
    <meta name="keywords" content="RedSocialAnimales">
    <link rel="icon" href="assets/img/icono.png" type="image/png" sizes="16x16">
</head>
<body>
    <h1>Bienvenido a la Configuración inicial</h1>
    <h2>Por favor complete los datos para la cuenta Administrador</h2>
    <form name="form_na" action="<?php echo $helper->url("administrador","crear"); ?>" enctype="multipart/form-data" method="post">
        <fieldset>
            <legend>Administrador</legend>
                <div>
                    <input type="text" name="usuario" id="username" maxlength="50" required autocomplete="off" placeholder="Usuario">
                </div>
            <div>
                <input type="password" name="password" id="password" maxlength="50" required autocomplete="off" placeholder="Contraseña">
            </div>
            <div>
                <input type="text" name="nombre" id="nombre" maxlength="50" required autocomplete="off" placeholder="Nombre">
            </div>
            <div>
                <input type="text" name="apellido" id="apellido" maxlength="50" autocomplete="off" required  placeholder="Apellido">
            </div>
            <div>
                <label for="masculino">Masculino</label><input type="radio" name='sexo' value='masculino' id='masculino'>
                <label for="femenino">Femenino</label><input type="radio" name='sexo' value='femenino' id='femenino'>
            </div>
            <div>
                <input type="tel" name="telefono" id="telefono" autocomplete="off" required placeholder="Teléfono">
            </div>
            <div>
                <input type="mail" name="mail" id="mail" autocomplete="off" placeholder="email">
            </div>
            <div>
                <label>Imagen de Perfil</label>
                <input type="file" name="imagenPerfil" accept="image/*">
            </div>
            <button type="button" class="btn btn-link"><a href="index.php">Volver</a></button>
            <input type="submit" name="btn-accion" value="Guardar Cambios" class="btn btn-info">
        </fieldset>
    </form>
<footer>
    +cotitas 2019
</footer>
</body>
</html>

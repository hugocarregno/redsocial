<!DOCTYPE html>
<html lang="es">
    <head>
        <title>+cotitas - Iniciar sesion</title>
        <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <meta charset="utf-8">
        <meta name="description" content="Red social para amantes de los animales">
        <meta name="keywords" content="RedSocialAnimales">
        <link rel="icon" href="assets/img/icono.png" type="image/png" sizes="16x16">
    </head>
    <body>
        <header class="inicio">
            <h1 class="titulo"><img src="img/icono.png" alt="logo mascotitas" /></h1>
            <h3>Una red social dedicada especialmente a la comunidad amante de los animales.</h3>
        </header>
        <div class="formulario">
        <form method="post" action="#" name="formularioAcceso">
            <fieldset>
                <legend>Autenticación</legend>
                <div>
                    <input name="usuario" type="text" id="usuario" size="30" placeholder="Usuario" required/>
                </div>
                <div>
                    <input name="psw" type="password" id="psw" size="30" placeholder="Contraseña" required/>
                </div>
                <div>
                    <button class="btn btn-info"><a href="<?php echo $helper->url("usuario","iniciar"); ?>">Iniciar Sesión</a></button>
                </div>
                <div>
                    <button class="btn btn-link"><a href="<?php echo $helper->url("usuario","insertar"); ?>">Registrarse</a></button>
                </div>
            </fieldset>
        </form>
        </div>
        <footer>
	        +cotitas 2019
        </footer>
    </body>
</html>

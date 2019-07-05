<?php if(!isset($_SESSION)){
        session_start(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>+cotitas - Menu Administrador </title>
  <link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8">
  <meta name="description" content="Red social para amantes de los animales">
  <meta name="keywords" content="RedSocialAnimales">
  <link rel="icon" href="assets/img/icono.png" type="image/png" sizes="16x16">
</head>
<body>
<?php include("cabeceraView.php"); ?>
<div class="container">
    <button type="button" class="btn btn-link"><a href="<?php echo $helper->url("administrador","registrarModerador"); ?>">Registrar Moderador</a></button>
    <?php if($_SESSION['idSuperAdmin']==$_SESSION['id']){
      echo "<button type=\"button\" class=\"btn btn-link\"><a href=\"{$helper->url('administrador','registrarAdministrador')}\">Registrar Administrador</a></button>";
    }
  ?>
    <p>Moderadores</p>
    <table border=1>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Sexo</th>
            <th>Mail</th>
            <th>Telefono</th>
            <th></th>
        </tr>
        <tr>
            <td>brisa20</td>
            <td>Brisa</td>
            <td>Funes</td>
            <td>Femenino</td>
            <td>brisa10@hotmail.com</td>
            <td>2664212399</td>
            <td><button type="submit" class="btn btn-danger">Desactivar</button></td>
            <!-- <td><button type="submit" class="btn btn-success">Activar</button></td> -->
        </tr>
    </table>
</div>
<footer>
    +cotitas 2019
</footer>
</body>
</html>

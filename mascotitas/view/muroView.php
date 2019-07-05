<!DOCTYPE html>
<html lang="es">
<head>
    <title>Masctotitas - Muro</title>
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
        <article>
            <section class="publicar">
                <div><input type="text" name="titulo" style="margin-right: 500px; width: 100%; border-radius: 8px 8px 0 0;" placeholder="Título"></div>
                <textarea placeholder="Cuentanos algo"></textarea>
                <div class="boton-publicar">
                    <button class="imagen">Imagen(max 3)</button>
                    <button class="adjunto">Adjunto</button>
                    <button class="btn btn-info">Publicar</button>
                </div>
            </section>
            <section>

                <div class="perfil">
                    <div class="foto">
                        <img src="assets/img/usuario_sitio/1.jpg" alt="persona1" width="50px" height="50px"/>
                    </div>
                    <div class="publicado">
                        <h2>Busco veterinaria
                        </h2>
                        <h3>
                            <a href="usuariox.html">Juan Sosa</a>
                        </h3>
                        <h3>
                            10-06-19 20:30
                        </h3>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="publicacion">
                    <p>Necesito la dirección o telefono de alguna veterinaria de confianza</p>
                </div>
                <div class="acciones">
                    <span>denunciar</span><input type="image" src="assets/img/denunciar.png" width="20px" height="20px">
                </div>
                <div class="comentarios">
                    <span>comentario1</span><input type="image" src="assets/img/denunciar.png" width="20px" height="20px">
                    <h6>10-06-19 20:31</h6>
                </div>
            </section>
            <section>
                    <div class="perfil">
                        <div class="foto">
                            <img src="assets/img/usuario_sitio/2.jpg" alt="persona2" width="50px" height="50px"/>
                        </div>
                        <div class="publicado">
                            <h2>Bienvenidos!
                            </h2>
                            <h3>
                                <a href="usuariox.html">Juan Sosa</a>
                            </h3>
                            <h3>
                                11-06-19 15:30
                            </h3>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="publicacion">
                        <p>Recien nacidos!! #adopta #gatos #gratiss</p>
                        <img src="assets/img/usuario_sitio/1.jpg" alt="nacidos"  width="100px" height="100px"/>
                    </div>
                    <div class="acciones">
                        <span>denunciar</span>
                        <input type="image" src="assets/img/denunciar.png" width="20px" height="20px">
                    </div>
                    <div class="comentarios">
                        <img src="assets/img/usuario_sitio/2.jpg" alt="persona2" width="50px" height="50px"/>
                        <span>comentario1</span><input type="image" src="assets/img/denunciar.png" width="20px" height="20px">
                        <h6>11-06-19 15:35</h6>
                    </div>
                </section>
        </article>
    </div>
<footer>
	+cotitas 2019
</footer>
</body>
</html>

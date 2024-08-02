<?php
session_start();

if (!isset($_SESSION['Loggedin'])) {
    header("Location: index.html ");
    exit();
} else {
    include('config.php');
    include 'procesos/usuarioupdate.php';

    $user = getUserById($_SESSION['Loggedin'], $conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <link rel="stylesheet" href="nicepage.css" media="screen">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <title>Actualizar</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-logo">
                <img src="images/logoconectune1.jpg" alt="Connectune Logo" />
            </a>
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="perfil.php" class="navbar-link">Perfil</a></li>
                <li class="navbar-item"><a href="logout.php" class="navbar-link">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <div class="container rounded bg-dark text-white mt-5 mb-5 p-5">
        <?php
            $usuactual = $_SESSION['Loggedin'];
            $sql = "SELECT * FROM usuarios WHERE idusuarios = '$usuactual'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="upload/PP/<?php echo $row['foto_perfil']; ?>">
                    <span class="font-weight-bold">Hola</span>
                    <span class="text-white-50"><h3><?php echo $row['nombre_artistico']; ?></h3></span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Actualizar</h4>
                    </div>
                    <form action="procesos/us-process.php" method="POST" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Nombre artistico</label><input type="text" class="form-control" value="<?php echo $row['nombre_artistico']; ?>" name="nombre_artistico"></div>
                            <div class="col-md-6"><label class="labels">Nombre</label><input type="text" class="form-control" value="<?php echo $row['nombre_completo']; ?>" name="nombre_completo"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Correo</label><input type="email" class="form-control" value="<?php echo $row['correo']; ?>" name="correo_electronico"></div>
                            <div class="col-md-12"><label class="labels">Dirección</label><input type="text" class="form-control" value="<?php echo $row['ubicacion']; ?>" name="ubicacion"></div>
                            <div class="col-md-12"><label class="labels">Celular</label><input type="text" class="form-control" value="<?php echo $row['celular']; ?>" name="numero_celular"></div>
                            <div class="col-md-12"><label class="labels">Instrumento(s)</label><input type="text" class="form-control" value="<?php echo $row['instrumentos']; ?>" name="instrumentos"></div>
                            <div class="col-md-12"><label class="labels">Genero(s)</label><input type="text" class="form-control" value="<?php echo $row['genero']; ?>" name="generos_musicales"></div>
                            <div class="col-md-12"><label class="labels">Biografía</label><input type="text" class="form-control" value="<?php echo $row['biografia']; ?>" name="biografia"></div>
                            <div class="col-md-12"><label class="labels">Enlace</label><input type="text" class="form-control" value="<?php echo $row['enlace']; ?>" name="redes_sociales"></div>
                            <div class="col-md-12"><label class="labels">Foto de perfil (PNG, JPG, JPEG)</label></div>
                            <div><input type="file" class="form-control-file" name="foto_perfil"><input type="hidden" name="vieja-foto" value="<?php echo $row['foto_perfil']; ?>"></div>
                        </div>
                        <div><input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                        <label class="form-check-label" for="terminos">Aceptar los cambios</label></div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Guardar</button></div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Multimedia</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i></span></div><br>
                    <div class="col-md-12"><label class="labels">Video</label><input type="text" class="form-control" placeholder="Enlace de youtube"></div> <br>
                    <div class="col-md-12"><label class="labels">Imagen</label><div><input type="file" class="form-control-file"></div></div>
                </div>
            </div>
        </div>
        <?php
                } // Fin del while
            } // Fin del if mysqli_num_rows
        } // Fin del if result
    } // Cierre del else de la parte superior
        ?>
    </div>
    <footer class="u-align-center-md u-align-center-sm u-align-center-xs u-black u-clearfix u-footer u-footer" id="sec-9182"><div class="u-clearfix u-sheet u-sheet-1">
        <p style="text-align: center;">Te invitamos a seguirnos en nuestras redes sociales.</p>
        <div class="u-align-center u-social-icons u-spacing-10 u-social-icons-1">
            <a class="u-social-url" title="facebook" target="_blank" href="https://www.facebook.com/profile.php?id=61561943430079&amp;mibextid=ZbWKwL"><span class="u-icon u-social-facebook u-social-icon u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112"><use xlink:href="#svg-943c"></use></svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-943c"><circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M73.5,31.6h-9.1c-1.4,0-3.6,0.8-3.6,3.9v8.5h12.6L72,58.3H60.8v40.8H43.9V58.3h-8V43.9h8v-9.2c0-6.7,3.1-17,17-17h12.5v13.9H73.5z"></path></svg></span></a>
            <a class="u-social-url" title="instagram" target="_blank" href="https://www.instagram.com/conectune?igsh=MW9iMzlqeWh4amszMw=="><span class="u-icon u-social-icon u-social-instagram u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112"><use xlink:href="#svg-957a"></use></svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-957a"><circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M55.9,38.2c-9.9,0-17.9,8-17.9,17.9C38,66,46,74,55.9,74c9.9,0,17.9-8,17.9-17.9C73.8,46.2,65.8,38.2,55.9,38.2z M55.9,66.4c-5.7,0-10.3-4.6-10.3-10.3c-0.1-5.7,4.6-10.3,10.3-10.3c5.7,0,10.3,4.6,10.3,10.3C66.2,61.8,61.6,66.4,55.9,66.4z"></path><path fill="#FFFFFF" d="M74.3,33.5c-2.3,0-4.2,1.9-4.2,4.2s1.9,4.2,4.2,4.2s4.2-1.9,4.2-4.2S76.6,33.5,74.3,33.5z"></path><path fill="#FFFFFF" d="M73.1,21.3H38.6c-9.7,0-17.5,7.9-17.5,17.5v34.5c0,9.7,7.9,17.6,17.5,17.6h34.5c9.7,0,17.5-7.9,17.5-17.5V38.8C90.6,29.1,82.7,21.3,73.1,21.3z M83,73.3c0,5.5-4.5,9.9-9.9,9.9H38.6c-5.5,0-9.9-4.5-9.9-9.9V38.8c0-5.5,4.5-9.9,9.9-9.9h34.5c5.5,0,9.9,4.5,9.9,9.9V73.3z"></path></svg></span></a>
        </div>
    </div></footer>
</body>
</html>


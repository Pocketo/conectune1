<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$server = "localhost:3306";
$database = "conectune";
$username = "root";
$password = "";
$conn = mysqli_connect($server, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el ID del usuario actual
$currentUserId = $_SESSION['Loggedin'] ?? null;

// Verificar si se envió el formulario de búsqueda
if (isset($_GET['criterio']) && isset($_GET['valor'])) {
    $criterio = $_GET['criterio'];
    $valor = mysqli_real_escape_string($conn, $_GET['valor']); // Escapar caracteres peligrosos

    // Validar el criterio para evitar inyecciones SQL
    $criteriosValidos = ["idusuarios", "nombre_completo", "nombre_artistico", "ubicacion", "instrumentos"];
    if (!in_array($criterio, $criteriosValidos)) {
        header('Location: buscar-in.html'); //Ahora si la consulta es nula simplemente lo devuelve
        die("Criterio de búsqueda no válido.");
        
    }

    // Construir la consulta basada en el criterio de búsqueda
    if ($criterio == "idusuarios") {
        $sql = "SELECT * FROM usuarios WHERE idusuarios = $valor";
    } else {
        $sql = "SELECT * FROM usuarios WHERE $criterio LIKE '%$valor%'";
    }

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    // Comprobar si se obtuvieron resultados
    if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Músicos</title>
    <link rel="stylesheet" href="buscar2.css" >
    <link rel="stylesheet" href="nicepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
            <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-logo">
                <!-- Asegúrate de que la ruta de la imagen sea correcta -->
                <img src="images/logoconectune1.jpg" alt="Connectune Logo" />
            </a>
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="perfil.php" class="navbar-link">Profile</a></li>
                <li class="navbar-item"><a href="buscar.html" class="navbar-link">Search</a></li>
                <li class="navbar-item"><a href="logout.php" class="navbar-link">Log out</a></li>
            </ul>
        </div>
    </nav>

    </nav>
    <section class="u-align-left u-clearfix u-container-align-left u-image u-shading" id="sec-68e1" data-image-width="1980" data-image-height="1400">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="container mt-5">
                <h1 class="text-center">Found musicians</h1>
                <div class="row">
                    
                    <!-- Tarjeta de Músico -->
                    <?php
                     $musicosEncontrados = false; // Variable para rastrear si se encontraron músicos
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Omitir la tarjeta si el usuario actual es el mismo que el resultado
                        if ($row['idusuarios'] == $currentUserId) {
                            continue;
                        }
                        $musicosEncontrados = true; // Se encontró al menos un músico
                    ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card user-info-left">
                <img class="img-fluid card-img-top" src="upload/PP/<?php echo $row['foto_perfil'];?>" alt="Profile Picture">
                <div class="card-body text-center">
                    <h2 class="card-title"><?php echo $row['nombre_artistico'];?></h2>
                    <div class="contact">
                        <a href="https://wa.me/<?php echo $row['celular'];?>" class="btn btn-block btn-danger mb-2"><i class="fa fa-envelope-o"></i>Conect</a>
                        <a href="perfil/index-in.php?id=<?php echo $row['idusuarios'];?>" class="btn btn-block btn-success"><i class="fa fa-book"></i>View profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    <?php
                          }
                          // Mostrar mensaje si no se encontraron músicos
                          if (!$musicosEncontrados) {
                              echo "<div class='text-center'><h4>No se encontraron músicos.</h4></div>";
                          }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
    } else {
          // Mostrar mensaje si no se encontraron usuarios
          echo "<div class='text-center my-4'><h4>No se encontraron usuarios.</h4></div>";
    }
}
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

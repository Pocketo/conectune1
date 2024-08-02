<?php
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

// Obtener el ID del usuario desde la URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si se proporcionó un ID válido
if ($user_id <= 0) {
    die("ID de usuario no válido.");
}

// Consulta a la base de datos para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE idusuarios = $user_id";
$result = mysqli_query($conn, $sql);

// Comprobar si se encontraron datos del usuario
if (mysqli_num_rows($result) > 0) {
    // Obtener los datos del usuario
    $user = mysqli_fetch_assoc($result);
} else {
    die("No se encontró el usuario.");
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Hola">
    <meta name="description" content="">
    <title><?php echo $user['nombre_artistico']; ?>'s profile</title>
    <link rel="stylesheet" href="index.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="generator" content="Nicepage 6.14.4, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|PT+Sans:400,400i,700,700i">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Casa">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body>
    <body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-logo">
                <!-- Asegúrate de que la ruta de la imagen sea correcta -->
                <img src="images/logoconectune1.jpg" alt="Connectune Logo" />
            </a>
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="../perfil-in.php" class="navbar-link">Profile</a></li>
                <li class="navbar-item"><a href="../buscar-in.html" class="navbar-link">Search</a></li>
                <li class="navbar-item"><a href="../logout.php" class="navbar-link">Log out</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="../upload/PP/<?php echo $user['foto_perfil'];?>" alt="Admin" class="rounded-circle" width="300">
                    <div class="mt-3">
                      <h4><?php echo $user['nombre_artistico'];?></h4>
                      <p class="text-secondary mb-1"><?php echo $user['instrumentos'];?></p>
                      <p class="text-muted font-size-sm"><?php echo $user['ubicacion'];?></p>
                      <a href="https://wa.me/<?php echo $user['celular'];?>"><button class="btn btn-primary">Conect</button></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Link</h6>
                    <span class="text-secondary"><?php echo $user['enlace'];?></span>
                  </li>

                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Real name: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['nombre_completo'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['correo'];?>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone number: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['celular'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Biography: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['biografia'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['ubicacion'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gener(s): </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['genero'];?>
                    </div>
                  </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Videos</i></h6>
                      <iframe width="383" height="210" src="https://www.youtube.com/embed/CYDP_8UTAus?si=wT-o_gHEryr6Ipku" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Images</i></h6>
                     <img width="383" height="210" src="images/images.jpeg" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>

  </body>
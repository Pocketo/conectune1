<?php
session_start();

if (!isset($_SESSION['Loggedin'])) {
    header("Location: index.html ");
    exit();
}

// Obtener información del usuario
include('config.php');
$user_id = $_SESSION['Loggedin'];

$sql = "SELECT nombre_completo, correo FROM usuarios WHERE idusuarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre_completo, $correo);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.13.8, nicepage.com">
    <meta name="referrer" content="origin">
   
    <title>Perfil propio</title>
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
                <li class="navbar-item"><a href="buscar-in.html" class="navbar-link">Search</a></li>
                <li class="navbar-item"><a href="logout.php" class="navbar-link">Log out</a></li>
                <li class="navbar-item"><a href="perfil.php" class="navbar-link">Spanish</a></li>
                
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
                    <img src="upload/PP/<?=$_SESSION['Foto_per'];?>" alt="Admin" class="rounded-circle" width="300">
                    <div class="mt-3">
                      <h4><?=$_SESSION['Nom_art'];?></h4>
                      <p class="text-secondary mb-1"><?=$_SESSION['Instrumento'];?></p>
                      <p class="text-muted font-size-sm"><?=$_SESSION['Ubicacion'];?></p>
                      <a href="update-in.php"><button class="btn btn-primary">Edit</button></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Link</h6>
                    <span class="text-secondary"><?=$_SESSION['Enlace'];?></span>
                  </li>

                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Real Name: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Nom_com'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Correo'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone Number: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Cel'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Biography: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Bio'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location: </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Ubicacion'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Genre(s): </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=$_SESSION['Genero'];?>
                    </div>
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

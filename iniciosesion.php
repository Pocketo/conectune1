<?php
session_start();
include('config.php'); // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['Correo'];
    $contra = $_POST['Contraseña']; 

    $sql = "SELECT idusuarios, nombre_completo, correo, nombre_artistico, genero, instrumentos, ubicacion, biografia, enlace, celular, foto_perfil, contraseña FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nomcom, $correo, $nomart, $genero, $instrumento, $ubicacion, $biografia, $enlace, $celular, $fo_pe, $hashed_password);
        $stmt->fetch();

        if (password_verify($contra, $hashed_password)) {
            $_SESSION['Loggedin'] = $id;
            $_SESSION['Nom_com'] = $nomcom;
            $_SESSION['Correo'] = $correo;
            $_SESSION['Nom_art'] = $nomart;
            $_SESSION['Genero'] = $genero;
            $_SESSION['Instrumento'] = $instrumento;
            $_SESSION['Ubicacion'] = $ubicacion;
            $_SESSION['Bio'] = $biografia;
            $_SESSION['Enlace'] = $enlace;
            $_SESSION['Cel'] = $celular;
            $_SESSION['Foto_per'] = $fo_pe;

            header("Location: perfil.php");
            exit();
        } else {
            echo "<p>Contraseña incorrecta</p>";
            echo "<form action='iniciosesion.html' method='GET'>";
            echo "<input type='hidden' name='correo' value='$correo'>";
            echo "<button type='submit'>Regresar a Iniciar Sesión</button>";
            echo "</form>";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }

    $stmt->close();
}
$conn->close();
?>

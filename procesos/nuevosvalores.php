<?php

include('../config.php'); // Conexión a la base de datos

    $mismaid = $_SESSION['Loggedin'];

        $sql = "SELECT * FROM usuarios WHERE idusuarios = '$mismaid'";
        
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($id, $nomcom, $correo, $nomart, $genero, $instrumento, $ubicacion, $biografia, $enlace, $celular, $fo_pe, $hashed_password);
        $stmt->fetch();


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

?>
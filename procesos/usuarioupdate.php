<?php

function getUserById($id, $db){
    $sql = "SELECT * FROM usuarios WHERE idusuarios = ?";
include 'config.php' ;

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->num_rows > 0) {
        $user = $stmt->fetch();
        return $user;
    }else {
        return 0;
    }
}

?>
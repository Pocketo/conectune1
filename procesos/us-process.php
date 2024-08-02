<?php
session_start();
include ('../config.php');
if (!isset($_SESSION['Loggedin'])) {
    header("Location: index.html ");
    exit();
} else{

$idact=$_SESSION['Loggedin'];

$nom=$_POST['nombre_completo'];
$corr=$_POST['correo_electronico'];
$nomA=$_POST['nombre_artistico'];
$gen=$_POST['generos_musicales'];
$ins=$_POST['instrumentos'];
$ubi=$_POST['ubicacion'];
$bio=$_POST['biografia'];
$red=$_POST['redes_sociales'];
$num=$_POST['numero_celular'];


$vieja_fp=$_POST['vieja-foto'];

$data = "Nombre_completo=".$nom."Nombre_artistico=".$nomA;



if (isset($_FILES['foto_perfil']['name'])){

  $img_name = $_FILES['foto_perfil']['name'];
  $img_size = $_FILES['foto_perfil']['size'];
  $tmp_name = $_FILES['foto_perfil']['tmp_name'];
  $error = $_FILES['foto_perfil']['error'];

  if($error === 0){
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_to_lc = strtolower($img_ex);

    $allowed_exs = array('jpg','jpeg','png');

    // Sube la imagen del usuario a la carpeta upload
    if(in_array($img_ex_to_lc, $allowed_exs)){
      $new_img_name = uniqid($nomA, true).'.'.$img_ex_to_lc;
      $img_upload_path = '../upload/PP/'.$new_img_name;

      //Eliminar antigua foto
      $vieja_fp_des = "../upload/PP/$vieja_fp";
      if (unlink($vieja_fp_des)) {
        // Se elimina
        move_uploaded_file($tmp_name, $img_upload_path);
      } else {
        // Un error o ya eliminada
        move_uploaded_file($tmp_name, $img_upload_path);
      }

      

      // actualizar base de datos
      $sql="UPDATE usuarios
        SET nombre_completo = '$nom', correo = '$corr', nombre_artistico = '$nomA', genero = '$gen', instrumentos = '$ins', ubicacion = '$ubi', biografia = '$bio', enlace = '$red', celular = '$num', foto_perfil = '$new_img_name'
        WHERE idusuarios = '$idact' ";
       
       $stmt = $conn->prepare($sql);
       $stmt->execute();
        
        
      if ($conn->query($sql) === TRUE) {
        include('nuevosvalores.php'); //Actualiza los datos les usuario mostrados en el perfil perdonal.

        header('Location: ../perfil.php');
         } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
         }
         $conn->close();



    } else{
      $em = "Formato no permitido.";
      header("Location: ../update.php?error=$em&$data");
    }
  } else{
    $em = "Ocurrio un error desconocido.";
    header("Location: ../update.php?error=$em&$data");
  }
}

}
?>
<?php
include ('config.php');
$nom=$_POST['nombre_completo'];
$corr=$_POST['correo_electronico'];
$nomA=$_POST['nombre_artistico'];
$gen=$_POST['generos_musicales'];
$ins=$_POST['instrumentos'];
$ubi=$_POST['ubicacion'];
$bio=$_POST['biografia'];
$red=$_POST['redes_sociales'];
$num=$_POST['numero_celular'];
$contra=$_POST['contrasena'];

$data = "Nombre_completo=".$nom."Nombre_artistico=".$nomA;

$hashed_contra = password_hash($contra, PASSWORD_DEFAULT);

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
      $img_upload_path = 'upload/PP/'.$new_img_name;
      move_uploaded_file($tmp_name, $img_upload_path);


      $sql="INSERT INTO usuarios(nombre_completo,correo,nombre_artistico,genero,instrumentos,ubicacion,biografia,enlace,celular,foto_perfil,contraseña)
      VALUES ('$nom','$corr','$nomA','$gen','$ins','$ubi','$bio','$red','$num','$new_img_name','$hashed_contra')";
      
      if ($conn->query($sql) === TRUE) {
         header('Location:iniciosesion.html');
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();



    } else{
      $em = "Formato no permitido.";
      header("Location: registro.html?error=$em&$data");
    }
  } else{
    $em = "Ocurrio un error desconocido.";
    header("Location: registro.html?error=$em&$data");
  }
}


?>
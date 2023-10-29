<?php
include('user.php');
session_start();
$user = new user();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = "SELECT * FROM Usuario WHERE email = '$email' && contrasena  = '$pass'";
    $result = $user->verificar($select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['UsuarioID'];

        if ($row['TipoUsuario'] == '1'){
            $_SESSION['admin_name'] = $row['nombre'];
            header('location:../MenuAdmin/index.php');
        }else if($row['TipoUsuario'] == '3') {
            $_SESSION['arqui_name'] = $row['nombre'];
            header('location:../MenuArquitecto/index.html');
        } else if ($row['TipoUsuario'] == '2') {
            $_SESSION['user_name'] = $row['nombre'];
            header('location:../MenuUsuario/index.php');
        }
    } else {
        
        echo 'incorrecto';
    
        header('location:index.html');
        
    }
}
?>
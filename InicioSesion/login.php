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
        $_SESSION['id'] = $row['idUsuario'];

        if ($row['idTipoUsuario'] == '1') {
            $_SESSION['admin_name'] = $row['nombre'];
            header('location:../MenuAdmin/base/index.php');
        } else if ($row['idTipoUsuario'] == '2') {
            $_SESSION['arqui_name'] = $row['nombre'];
            header('location:../MenuArquitecto/index.php');
        } else if ($row['idTipoUsuario'] == '3') {
            $_SESSION['user_name'] = $row['nombre'];
            header('location:../MenuUsuario/app/index.php');
        }
    } else {

        $_SESSION['error'] = true;
        header('location:index.php');
        exit();
    }
}
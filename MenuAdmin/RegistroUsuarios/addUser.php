<?php

include('../../InicioSesion/user.php');
$user = new user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM Usuario WHERE email = '$email'";
    $result = $user->verificar($select);

    if (mysqli_num_rows($result) > 0) {
        echo 'Usuario existe';
    } else {
        if ($pass != $cpass) {
            echo 'Contras no cuadran';
            header('location:register_form.php');
        } else {
            $user->setNombre($name);
            $user->setApPat($apPat);
            $user->setApMat($apMat);
            $user->setNumTel($numero);
            $user->setEmail($email);
            $user->setContra($pass);
            $user->setTipoUsuario($user_type);

            $newUserId = $user->setNewUser();
            if ($newUserId > 0) {
                echo 'Usuario registrado';
                header('location:login_form.php');
            } else {
                echo 'Algo salio mal';
            }
        }
    }
}




?>
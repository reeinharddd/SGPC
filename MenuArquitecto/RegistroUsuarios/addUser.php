<?php
include('../../InicioSesion/user.php');
$user = new user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $apPat = $_POST['apPat'];
    $apMat = $_POST['apMat'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $combLen = strlen($comb) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }
    $pass = (implode($pass));
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM Usuario WHERE email = '$email'";
    $result = $user->verificar($select);

    if (mysqli_num_rows($result) > 0) {
        echo 'Usuario existe';
    } else {
            session_start();
            $_SESSION['user_data'] = array(
                'Nombre' => $name,
                'Apellido Paterno' => $apPat,
                'Apellido Materno' => $apMat,
                'Número de Teléfono' => $numero,
                'Email' => $email,
                'Contraseña' => $pass,
                'Tipo de Usuario' => $user_type,
              
            );
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
                header('location:confirmacionRegistro.php');
            } else {
                echo 'Algo salio mal';
            }
        
    }
}
<?php
$correo = "'".$_POST['correo']."'";
$psw = "'".$_POST['pasword']."'";

$stringApi = "https://restaurantesofi.000webhostapp.com/serviciosMuebles/loguearUsuario.php?correo=".$correo."&pasword=".$psw;
$data = json_decode(file_get_contents($stringApi),true);

$idUsuario;
$tipoUser;

foreach ( $data as $d ) {
    $idUsuario = $d['idUsuario'];   
    $tipoUser = $d['usuario']; 
}
session_start();
$_SESSION["usuario"] = $correo;
$_SESSION["idUsuario"] = $idUsuario;


if($idUsuario == 0){
    header("Location: /LoginUsuario?mensaje='Usuario no registrado'");
    die();
} else{
    if($tipoUser =="administrador"){
        header("Location: /homeA?idUsuario=".$idUsuario."&usuario=".$tipoUser);
        die();
    }
    if($tipoUser =="cliente"){
        header("Location: /homeC?idUsuario=".$idUsuario."&usuario=".$tipoUser);
        die();
    }
}




?>
<?php

/*
 * mkdir( '../../archivos/'.$municipio, 0766);
 * is_dir();
 * isset()
 * is_number()
 * str_replace()
 * explode()
 * filter_var($va,FILTER_VALIDATE_EMAIL);
UPLOAD_ERR_OK
    $_FILES['AR']['error']
$partes_ruta = pathinfo('/www/htdocs/inc/lib.inc.php');

echo $partes_ruta['dirname'], "\n";
echo $partes_ruta['basename'], "\n";
echo $partes_ruta['extension'], "\n";
echo $partes_ruta['filename'], "\n"; // desde PHP 5.2.0
echo dirname(__FILE__);
move_uploaded_file($files['tmp_name'][$index]['uploadFiles'][$index2], $archivoFinal)

echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)

$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}

json_encode
json_decode

    file_get_contents('data.json');
file_put_contents('a','ALGO',FILE_APPEND | LOCK_EX)
 * */
var_dump($_POST);

if($_POST){
$array_error=[];
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        echo trim($nombre);
        if(!empty(trim($nombre))){
            $array_error[] = "si tiene";
        }else{
            $array_error[] = "no tiene";

        }
    }
    if(isset($_POST['email'])){
        $email = trim($_POST['email']);
        if(empty($email)){
            $array_error[] = "debe enviar un email";
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $array_error[] = "email invalido";
        }else{
            $array_error[] = "email valido";
        }
    }

    if(isset($_POST['dni'])){
        $dni = str_replace(['.',',','-'],['','/',''],trim($_POST['dni']));
        if(empty($dni)){
            $array_error[] = "debe enviar un dni";
        }elseif(!is_numeric($dni)) {
            $array_error[] = "el dni es invalido";
        }elseif($dni > 1000000 && $dni < 99999999) {
            $array_error[] = "el dni es fuera de rango";
        }else{
            $array_error[] = "dni valido";
        }
    }
    foreach ($array_error as $e){
        echo $e."<br>";
    }

    echo nl2br($_POST['text']);
}else{
 echo "no tiene";

}

?>
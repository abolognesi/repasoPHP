<?php
// setear valores de configuracion de php
ini_set('display_errors',on);
// imprimir el valor de la variable en este caso la variable global $_POST
var_dump($_POST);
echo "<br>";
var_dump($_FILES);

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
    echo nl2br($_POST['texto']);
}
if($_FILES){
    if($_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
        $flag = true;
        if ($ext != 'jpeg' && $ext != 'jpg' && $ext != 'png') {
            $flag = false;
            echo "extensión invalida";
        } else {
            echo "excelente";
        }
        if ($_FILES['archivo']['size'] > 200000) {
            $flag = false;
            echo "archivo muy grande";
        }
        if($flag){
            if(!is_dir("../img")){
                mkdir("../img",0766);
            }
            move_uploaded_file($_FILES['archivo']['tmp_name'],"../img/".$_FILES['archivo']['name']);
            echo "exito";
            ?>
            <a href="img/<?= $_FILES['archivo']['name']?>"><?= $_FILES['archivo']['name']?></a>
            <img src="img/<?= $_FILES['archivo']['name']?>">
<?php

        }

    }else{
        echo "no se pudo subir";
    }

    echo password_hash($_POST['password'], PASSWORD_DEFAULT);

}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>TEST</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $var = (isset($nombre)) ? $nombre : ''?>">
    <br>
    <label for="dni">DNI:</label>
    <input type="text" name="dni">
    <br>
    <label for="email">E-mail:</label><span style="color:red">*</span>
    <input type="text" name="email" required>

    <textarea name="texto" rows="10"></textarea>

    <br>
    <input type="file" name="archivo">
    <br>
    <label for="password">PASSWORD:</label><span style="color:red">*</span>
    <input type="password" name="password">
    <input type="submit">
    <input type="reset">
</form>
<?php
if(isset($array_error)){
    foreach ($array_error as $e){
        echo $e."<br>";
    }
}
?>
</body>
</html>

<?php
/*
$route = "images";
$result = scandir($route);
var_dump($result);
*/
//var_dump($_FILES["file"]);
//echo $FILES["file"]["name"];
//echo json_encode("Ramiro Pastrano");
//asignar base de directorio a guardar.
//$directory = "/var/www/html/ayc.local/images/";
//$directory = $_SERVER['DOCUMENT_ROOT']."/ayc.local/images/";
$directory = "images/";
//Asignar directorio para guardar archivo.
$archive = $directory . basename($_FILES["file"]["name"]);

//echo $archive;
//Validar tipo de archivo
$typeF = strtolower(pathinfo($archive, PATHINFO_EXTENSION));
//Validar Si es imagen 
$dimentions =  getimagesize($_FILES["file"]["tmp_name"]);
//obtener Directorio temporal
$setArchive = $_FILES["file"]["tmp_name"];
//asignar nuevo nombre de archivo y nueva ruta
$narchive = uniqid() . ".". $typeF;
$ndirectory = $directory . $narchive;
//Obtener tamaño de imagen
$size = $_FILES["file"]["size"];
/*
echo $setArchive;
echo $archive;
echo "<br>";
echo $typeF;*/
//var_dump($size);
//validar tipo de imagen - si es JPEG o JPG



if(($typeF == "jpg") || ($typeF == "jpeg")){
    //Validar el tamaño de la imagen
    if($size < 500000){
        $uploaded = move_uploaded_file($setArchive, $ndirectory);
        //$uploaded = copy($setArchive, $archive);
        $ready = array("Imagen de Usuario Cargada", $narchive);
        if($uploaded == true){
            echo json_encode($ready);
        }else{
            echo "Error al Cargar la Imagen";
            echo $_FILES["file"]['error'];
            var_dump($_FILES["file"]);
        }
        
    }else{
    
        echo "El archivo debe ser menor a 500kb";
    }

}else{
    echo "El archivo no es imagen, favor de añadir un archivo de tipo jpg o jpeg";
}


?>
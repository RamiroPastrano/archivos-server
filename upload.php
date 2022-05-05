<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json");
header('Content-Type: application/json; charset=utf-8');

//Definir Directorio Inicial o raiz para guardar imágenes o archivos
$directory = "images/";
//Asignar el array obtenido al enviar el formulario
$receive = $_FILES["file"];
//Obtener nombre de archivo
$name = $receive["name"];
//Obtener el tipo de archivo
$type = strtolower(pathinfo($name, PATHINFO_EXTENSION));
//Obtener el directorio temporal donde se aloja nuestro archivo al enviar el formulario
$tmpfile = $receive["tmp_name"];
//Directorio para guardar el nuevo archivo -- con el nombre de archivo original
$archive = $directory . basename($name);
//Asignar nuevo y único nombre de archivo con el tipo requerido
$uniqueName = uniqid() . '.' . $type;
//Directorio para guardar el nuevo archivo con un nombre único
$narchive = $directory . $uniqueName;
//Obtener el tamaño de nuestro archivo enviado por el formulario
$size = $receive["size"];

//Validar el tipo de archivo
if(($type == "jpg") || ($type == "jpeg")){
    //Validar Tamaño menor a 500KB
    if($size < 512000){
        $uploaded = move_uploaded_file($tmpfile, $narchive);
        //Validar si Archivo fue subido
        if($uploaded == true){
            $ready = array("Archivo Cargado Correctamente", $uniqueName);
            
            echo json_encode($ready);
        }else {
            $ready = array("Error al cargar archivo");
            
            echo json_encode($ready);
        }
    }else{
        $ready = array("Error! - Archivo demasiado pesado");
        
        echo json_encode($ready);
    }
}else {
    
    $ready = array("Error! - Archivo no soportado");

    echo json_encode($ready);

}

//imprimir pruebas.
//echo $size;

?>
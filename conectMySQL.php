<?php
require('dataTo.php');
//echo "localhost: ". $localhost . " Nombre de Usuario: ". $username . " Contraseña: " . $password . " Base de datos: " . $database;
$connect = mysqli_connect($localhost, $username, $password, $database);

if(!$connect){
    $response = array("Error de operación", mysqli_connect_errno());
    echo json_encode($response);
}else{
    $response = array("Conexión Satifactoria", mysqli_get_host_info($connect));
    echo json_encode($response);
    //$getTable = 'SHOW TABLES';
    //$table = mysqli_query($getTable);
    // = “SELECCIONAR * DESDE $usertable”;
	//echo json_encode($table);

    //$close = mysqli_close($connect);
    /*if($close){
        echo "Session Closed";
    }*/
	//$result = mysqli_query($query);

    
    $eject = $connect->query("SELECT *, CURDATE(), TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age FROM dataprobe");

    if($eject){
       /* echo "<br>________________________________________________________________________________________________________";
        echo "<br>|------------Nombre------------|--------------telephone-----------|------------birthday----------|----------age-------|<br/>";
        while($data = mysqli_fetch_assoc($eject)){
            $name = $data["name"];
            $telephone = $data["telephone"];
            $birthday =  $data["birthday"];
            $age = $data["age"];
			echo"|---".$name."---|---".$telephone."---|---"."---|---".$birthday."---|------". $age. "--------|<br/>";
        }
        echo $eject->num_rows;*/
        $datos = [];
        while($data = mysqli_fetch_assoc($eject)){
            array_push($datos, $data);
            //echo json_encode($data);
        }

        $id = count($datos);
        echo "<br>  Nombre      Telephone      Birthday     CURDATE()       Age";
        for($l = 0; $l<$id; $l++){
            echo "<br>" . $datos[$l]["name"] . "     "  . $datos[$l]["telephone"];
        }

        //echo json_encode($datos[0]["name"]);

        $connect->close();

        echo "sesión cerrada";
    }else{
        echo "no conseguido";
    }
}

?>
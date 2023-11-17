<?php 
    include ("db.php");
    
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    //INSERT INTO `contacto` (`id`, `nombre`, `numero`, `email`, `mensaje`, `dirección`) VALUES (NULL, 'Juancho', '9172829292', 'gmail@.com', 'hola', 'ate');
   $sql = "INSERT INTO contacto (id, nombre , numero,  email , mensaje ) VALUES (NULL , '$nombre' , '$numero' , '$correo' , '$mensaje' )";
   $resultado =$conexion-> prepare($sql);
   $resultado-> execute();
    $url = "http://".$_SERVER['HTTP_HOST']."/orquiedasvanda_";
   header("location:".$url)

?>
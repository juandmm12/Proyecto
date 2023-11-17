<?php

session_start();
require("./conexionbd/db.php");
$arreglo = $_SESSION['carrito'];

$total = 0;
for ($i = 0; $i < count($arreglo); $i++) {
    $total = $total + ($arreglo[$i]['precio'] * $arreglo[$i]['cantidad']);
}

$ig = 0.18;
$precio_mas_igv = $total * $ig;
$precio_final = $total + $precio_mas_igv;

date_default_timezone_set("America/Medellin");
date_default_timezone_set("America/Medellin");

$fecha = date("Y-m-d");
$hora = date("h:i:s");

if (isset($_POST['boleta'])) {

    $nombre = $_POST['nombres'];
    $dni = $_POST['dni'];
    $fecha_nac = $_POST['fecha'];
    $correo = $_POST['correo'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $fecha_cuenta = $_POST['fecha_cuenta'];
    $codigo_cuenta = $_POST['codigo_tarjeta'];
    $remitente = 'Franko Royel ';

    //INSERT INTO `cliente` (`cod_cliente`, `dni`, `nombre`, `fecha_nac`, `correo`) VALUES ('0001', '74433455', 'Juancho', '22/07/23', 'jdamrtinezm@gmailcom');

    $codigo_cliente =  substr($nombre, 0, 4) . substr($dni, 0, 4);
    $consulta = $conexion->prepare("INSERT INTO `cliente` (`cod_cliente`, `dni`, `nombre`, `fecha_nac`, `correo`) VALUES ('$codigo_cliente', '$dni', '$nombre', '$fecha_nac', '$correo');");
    $consulta->execute();

    //INSERT INTO `venta` (`cod_cliente`, `total`, `fecha`) VALUES ('001', '20', '22/12/23');
    $consulta = $conexion->prepare("INSERT INTO `venta` (`cod_cliente`, `total`, `fecha`, `hora`) VALUES ('$codigo_cliente', '$precio_final', '$fecha', '$hora');");
    $consulta->execute();
}

date_default_timezone_set("America/Lima");
date_default_timezone_set("America/Lima");
$fecha = date("Y-m-d ");
$hora = date("h:i:s");
$mensajePie = "gracias por su compra";

session_start();
/*if (!isset($_SESSION['carrito'])) {
    header("location: ./mama.php");
}*/
$arreglo = $_SESSION['carrito'];






?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOLETA FLORISTERIA ROSABELLA</title>
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/encabezado.css">
    <link rel="stylesheet" href="css/catalago1.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>
    <div class="menu">
        <a href="#" class="logo"><img src="img/LOGO-2.png" alt=""></a>
        <nav class="navbar">

            <a href="index.html" class="active">INICIO</a>
            <a href="ocaciones.html">ARREGLOS</a>
            <a href="catalogo.html">CATALOGO</a>
            <a href="ocaciones.html">OCACIONES</a>
            <a href="contactenos.php">CONTACTENOS</a>

            <a href="carrito.php" class="fs-4 rounded-circle bg-black ps-2 pe-2 pt-1 pb-1 text-light">
                carrito<i class="uil uil-shopping-cart loged-it"></i>
            </a>

        </nav>
        <div class="fas fa-bars"></div>
    </div>
    <h1 class="titulo"> ESTO ES SU BOLETA DE COMPRAS </h1>
    <div class="carritocontenedorT ">
        <div class="containercarrito">
            <div class="row">
                <div class="col-xs- ">
                    <h1>Factura</h1>
                </div>
                <div class="col-xs-2">
                    <img class="img img-responsive" src="img/LOGO-2.png" alt="Logotipo">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-2 ">
                    <strong>Fecha </strong>
                    <br>
                    <?php echo $fecha ?>
                    <br>
                    <strong>Hora </strong>
                    <br>
                    <?php echo $hora ?>
                    <br>
                    <strong>Factura No.</strong>
                    <br>
                    <?php echo $numerof ?>
                </div>
            </div>
            <hr>
            <div class="row " style="margin-bottom: 2rem;">
                <div class="col-xs-6">
                    <h1 class="h2">Cliente</h1>
                    <strong><?php echo 'NOMBRE : ' . $nombre ?></strong><br>
                    <strong><?php echo 'DNI : ' . $dni ?></strong><br>
                    <strong><?php echo 'FECHA NAC : ' . $fecha_nac ?></strong><br>
                    <strong><?php echo 'CORREO : ' . $correo ?></strong><br>
                    <strong><?php echo 'N° CUENTA : ' . $numero_cuenta ?></strong>
                </div>
                <hr>
                <div class="col-xs-6">
                    <h1 class="h2">Remitente</h1>
                    <strong><?php echo $remitente ?></strong>
                </div>
                <hr>

            </div>
            <div class="">
                <table class="table-cotenido table table-bordered ">
                    <thead>
                        <tr class="titulo">
                            <td>nombre</td>
                            <td>cantidad</td>
                            <td>precio</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($arreglo as $indice => $fila) {
                        ?>
                            <tr>
                                <td><?php echo $fila['nombre'] ?></td>
                                <td><?php echo $fila['cantidad'] ?></td>
                                <td><?php echo 'S/ ' . $fila['precio'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row">

                <table class="table table-bordered ">


                    <tfoot>

                        <tr>
                            <td colspan="3" class="text-right">Subtotal</td>
                            <td><span> <?php echo "S/. " . number_format($total, "2", ",", "") ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Descuento</td>
                            <td><span> <?php echo "S/. " . number_format($decuento, "2", ",", "") ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Subtotal con descuento</td>
                            <td><?php echo "S/. " . number_format($subtotalConDescuento, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Impuestos</td>
                            <td><?php echo "S/. " . number_format($ig, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">
                                <h4>Total</h4>
                            </td>
                            <td>
                                <h4><?php echo "S/. " . number_format($precio_final, 2) ?></h4>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p class="piepagina"><?php echo $mensajePie ?></p>
            </div>
        </div>
    </div>
    </div>
    <div class="botones">
        <a href="#">IMPRIMIR</a>
        <a href="catalogo.html">SEGUIR COMPRANDO</a>

    </div>
    <?php $arreglo = $_SESSION['carrito']; ?>
    <?php unset($_SESSION['carrito']) ?>
    <script src="./java/carrito.js"></script>
    <script src="/js/responsive.js"></script>
</body>

</html>
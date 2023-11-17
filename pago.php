<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    header("location: ./mama.php");
}
$arreglo = $_SESSION['carrito'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECIBO-OrquideasVanda</title>
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/sass.css">
    <link rel="stylesheet" href="./css/sass.css.map">
    <link rel="stylesheet" href="http://localhost/textrader/css/sass.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <section class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 ps-4 px-4" style="width: 600px;">
                <form action="./pedido.php" method="post">
                    <div class="form-group">
                        <label for="" class="form-label">Nombre Y Apellidos</label>
                        <input type="text" name="nombres" id="" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">CC</label>
                            <input type="text" name="dni" id="" class="form-control" maxlength="7" required>
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Fecha de Nac.</label>
                            <input type="date" name="fecha" id="" class="form-control" placeholder="dd / mm /aa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Correo </label>
                        <input type="email" name="correo" id="" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Numero de cuenta</label>
                            <input type="text" name="numero_cuenta" id="" class="form-control" maxlength="16" required>
                        </div>
                        <div class="col">
                            <label for="" class="form-label">MM/AA</label>
                            <input type="text" name="fecha_cuenta" id="" class="form-control" placeholder="00 / 00" value="" maxlength="5" required>
                        </div>
                        <div class="col">
                            <label for="" class="form-label">CVC</label>
                            <input type="text" name="codigo_tarjeta" id="" class="form-control " maxlength="3" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 15px 0 0 0;">
                        <input type="submit" value="Proceder compra" name="boleta" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <?php

            $total = 0;
            for ($i = 0; $i < count($arreglo); $i++) {
                $total = $total + ($arreglo[$i]['precio'] * $arreglo[$i]['cantidad']);

            ?>
            <?php }
            $ig = 0.18; ?>
            <div class="col-md-4 contn-total-pago">
                <div class="card ps-5 pe-5 py-3">
                    <h3 class="text-capitalize fw-light text-center">Resumen del pedido</h3>
                    <span class=" fs-5">Subtotal : <span> <?php echo "S/. " . number_format($total, "2", ",", "") ?></span></span>
                    <span class=" fs-5 ">IGV : <span><?php echo "S/. " . number_format($igv = $total * $ig, "2", ",", "") ?></span></span>
                    <?php $precio_final = $total + $igv ?>
                    <span class=" fs-5">Precio Final : <span><?php echo "S/. " . number_format($precio_final, "2", ",", "")  ?></span></span>
                    <a href="./mama.php" class="btn btn-warning">Seguir Comprando</a>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/responsive.js"></script>


</body>

</html>
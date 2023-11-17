<?php
session_start();
include("./conexionbd/db.php");

if (isset($_POST['id'])) {

    if (isset($_SESSION['carrito'])) {

        $arreglo = $_SESSION['carrito'];
        $encontro = false;
        $numero = 0;

        //metodo burbuja
        for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i]['id'] == $_POST['id']) {
                $encontro = true;
                $numero = $i;
            }
        }

        if ($encontro == true) {
            $arreglo[$numero]['cantidad'] = $arreglo[$numero]['cantidad'] + 1;
            $_SESSION['carrito'] = $arreglo;
        } else {
            //si es nuevo el producto debe de ejecutar esta consulta
            $buscar = $_POST['id'];

            $consultabuscar = $conexion->prepare("SELECT * FROM carrito WHERE id='$buscar' ");
            $consultabuscar->execute();
            $dato_entrada = $consultabuscar->fetch(PDO::FETCH_ASSOC);
            $imagen_producto = $dato_entrada['imagen'];
            $nombre_producto = $dato_entrada['nombre'];
            $precio_producto = $dato_entrada['precio'];
            $codigo_producto = $dato_entrada['id'];

            $arreglonuevo = array(
                'id' => $codigo_producto,
                'nombre' => $nombre_producto,
                'precio' => $precio_producto,
                'imagen' => $imagen_producto,
                'cantidad' => 1
            );
            array_push($arreglo, $arreglonuevo);
            $_SESSION['carrito'] = $arreglo;
        }
    } else {
        //creamos la seccion de carrito

        $buscar = $_POST['id'];

        $consultabuscar = $conexion->prepare("SELECT * FROM carrito WHERE id='$buscar' ");
        $consultabuscar->execute();
        $dato_entrada = $consultabuscar->fetch(PDO::FETCH_ASSOC);
        $imagen_producto = $dato_entrada['imagen'];
        $nombre_producto = $dato_entrada['nombre'];
        $precio_producto = $dato_entrada['precio'];
        $codigo_producto = $dato_entrada['id'];

        $arreglo[] = array(
            'id' => $codigo_producto,
            'nombre' => $nombre_producto,
            'precio' => $precio_producto,
            'imagen' => $imagen_producto,
            'cantidad' => 1
        );
        $_SESSION['carrito'] = $arreglo;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/sass.css">
    <link rel="stylesheet" href="./css/sass.css.map">
    <link rel="stylesheet" href="css/encabezado.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Carrito</title>
</head>

<body>
    <div class="menu">
        <a href="#" class="logo"><img src="img/LOGO-2.png" alt=""></a>
        <nav class="navbar">

            <a href="index.html" class="active">INICIO</a>
            <a href="ocaciones.html">ARREGLOS</a>
            <a href="catalogo.html">CATALOGO</a>


            <a href="carrito.php" class="fs-4 rounded-circle bg-black ps-2 pe-2 pt-1 pb-1 text-light">
                carrito<i class="uil uil-shopping-cart loged-it"></i>
            </a>

        </nav>
        <div class="fas fa-bars"></div>
    </div>


    <main class="contenedor-responsive">
        <section class="contenedor-shop-carrito-shop">
            <table class="mx-auto table table-bordered">
                <thead>
                    <tr>
                        <td>Nombre de Producto</td>
                        <td>Imagen</td>
                        <td>Precio</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td style="width: 100px;"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;

                    if (isset($_SESSION['carrito'])) {
                        $arreglocarrito = $_SESSION['carrito'];
                        for ($i = 0; $i < count($arreglocarrito); $i++) {
                            $total = $total + ($arreglocarrito[$i]['precio'] * $arreglocarrito[$i]['cantidad']);
                    ?>
                            <tr>
                                <td class="text-capitalize"><?php echo $arreglocarrito[$i]['nombre'] ?></td>
                                <td>
                                    <img style="width: 100px; height: 100px;" src="./img/<?php echo $arreglocarrito[$i]['imagen'] ?>" alt="flores">
                                </td>
                                <td class="ps-4 pe-4"><?php echo "S/." . number_format($arreglocarrito[$i]['precio']) ?></td>
                                <td>
                                    <div class="input-group" style="display: flex; width: 120px; margin: auto;">

                                        <div class="input-group-prepend">
                                            <button type="button" class="btn js-btn-minus btn-outline-primary btn_incrementar ">&minus;</button>
                                        </div>

                                        <input class="cantidadproducto form-control text-center" data-precio="<?php echo $arreglocarrito[$i]['precio'] ?>" data-id="<?php echo $arreglocarrito[$i]['id'] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" type="text" name="" id="" value="<?php echo $arreglocarrito[$i]['cantidad'] ?>">

                                        <div class="input-group-append">
                                            <button class="btn_incrementar btn js-btn-plus btn-outline-primary">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="cant<?php echo $arreglocarrito[$i]['id'] ?> ps-4 pe-4"><?php echo "S/. " . number_format(($arreglocarrito[$i]['precio'] * $arreglocarrito[$i]['cantidad']), "2", ",", "")  ?></td>
                                <td>
                                    <button class="btn btn-danger btn-eliminar" data-id="<?php echo $arreglocarrito[$i]['id'] ?>">
                                        X
                                    </button>
                                </td>
                            </tr>
                    <?php }
                    } ?>

                </tbody>
            </table>
        </section>
        <section>
            <div>
                <h1 class="text-center"> Total : <?php echo "S/. " . number_format($total, "2", ",", "") ?></h1>
            </div>
        </section>
        <section class="d-flex justify-content-center contn-link-compras">
            <div><a href="./mama.php" class="btn btn-primary">Seguir Comprando</a></div>
            <div><a href="./pago.php" class="btn btn-warning">Proceder Compra</a></div>
        </section>
    </main>
    <script>
        var sitePlusMinus = function() {
            $('.js-btn-minus').on('click', function(e) {
                e.preventDefault();
                if ($(this).closest('.input-group').find('.form-control').val() != 0) {
                    $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
                } else {
                    $(this).closest('.input-group').find('.form-control').val(parseInt(0));
                }
            });
            $('.js-btn-plus').on('click', function(e) {
                e.preventDefault();
                $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
            });
        };
        sitePlusMinus();


        $(document).ready(function() {
            $(".cantidadproducto").keyup(function() {
                var cantidad = $(this).val();
                var precio = $(this).data("precio");
                var codigo = $(this).data("id");

                incrementar(cantidad, precio, codigo);
            })
            $(".btn-eliminar").click(function(event) {
                var eliminar = $(this).data("id");
                var boton = $(this);
                $.ajax({
                        method: "POST",
                        url: "./eliminarcarrito.php",
                        data: {
                            eliminar: eliminar
                        }
                    })
                    .done(function(respuesta) {
                        boton.parent('td').parent('tr').remove()
                    })
            });

            $(".btn_incrementar").click(function() {
                var precio = $(this).parent('div').parent('div').find('input').data("precio");
                var codigo = $(this).parent('div').parent('div').find('input').data('id');
                var cantidad = $(this).parent('div').parent('div').find('input').val();
                incrementar(cantidad, precio, codigo);


            });


            function incrementar(cantidad, precio, codigo) {
                var multiplicacion = parseFloat(cantidad) * parseFloat(precio)
                $(".cant" + codigo).text(multiplicacion);
                $.ajax({
                    method: "POST",
                    url: "./actualizar.php",
                    data: {
                        codigo: codigo,
                        cantidad: cantidad
                    }
                })
            };
        });
    </script>
    <script src="./js/responsive.js"></script>
</body>

</html>
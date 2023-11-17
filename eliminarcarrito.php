<?php 
session_start();
$arreglo = $_SESSION['carrito'];
for($i=0 ; $i < count($arreglo) ; $i++){
    if($arreglo[$i]['id'] != $_POST['eliminar']){
        $arreglonuevo[] = array(
            'id' => $arreglo[$i]['id'],
            'nombre' => $arreglo[$i]['nombre'],
            'precio' => $arreglo[$i]['precio'],
            'imagen' => $arreglo[$i]['imagen'],
            'cantidad' =>$arreglo[$i]['cantidad'],
        );
    }
}
if(isset($arreglonuevo)){
    $_SESSION["carrito"] = $arreglonuevo;
}else{
    // Quiere decir que el registro a eliminar es el unico que habia 
    unset($_SESSION['carrito']);
}

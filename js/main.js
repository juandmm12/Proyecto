
$(document).ready(function(){
    $(".button-agregar").click(function(){
        var id = $(this).data("id");
        console.log(id)
       $.ajax({
        method:"POST",
        url: "./carrito.php",
        data : {
            id:id
        }
       })
    })
})
$(document).ready(function() {
    $("#modificar").hide();
    $("#eliminar").hide();
    $("#botonModificar").click(function() {
        $("#modificar").show(500);
        $("#eliminar").hide(500);
    }
    );
    $("#botonEliminar").click(function() {
        $("#eliminar").show(500);
        $("#modificar").hide(500);
    }); 
});
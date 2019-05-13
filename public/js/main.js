// Obtenemos csrf-token para validar la autenticación de Usuario
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Realizamos el envio del formulario
$("#form-search").submit(function(e){
    e.preventDefault();

    $("#export-pdf").fadeOut(0);

    // iniciamos el Load
    init_load();

    // Obtenemos el valor del campo Nombre y Apellidos
    var names = $("input[name=names]").val();
    var percentage = $("input[name=percentage]").val();

    // Realizamos la petición POST
    $.ajax({
       type:'POST',
       url:'/search-names',
       data:{names:names, percentage:percentage},
       success:function(data){
        // Finalizamos el Load
        end_load();

        // Verificamos los errores
        if (data.status == 400){
            alert_info(data.message);
        }

        // Verificamos los errores
        if ( data.status == 200 ) {
            $("#export-pdf").fadeIn(0);
            alert_success(data.message);
        }

        // Agregamos los resultados encontrados en la tabla
        $( ".table tbody" ).html('');
        $.each(data.data, function( index, value ) {
            $( ".table tbody" ).append( '<tr>' +
                '<th scope="col">'+value.nombre_buscado+'</th>' +
                '<th scope="col">'+parseFloat(value.porcentaje_buscado).toFixed(2)+'%</th>' +
                '<th scope="col">'+value.nombre_encontrado+'</th>' +
                '<th scope="col">'+parseFloat(value.porcentaje_encontrado).toFixed(2)+'%</th>' +
                '<th scope="col">'+value.otros_campos.tipo_cargo+'</th>' +
            '</tr>');
        });
       }
    });
});


function alert_success(texto){
    $('.message').html('<div class="alert alert-success agileits" role="alert"> <strong>¡Bien hecho!</strong> '+texto+' </div>').fadeIn(1000);

    setTimeout(function(){
        $('.message').fadeOut();
    }, 5000);

}

function alert_info(texto){
    $('.message').html('<div class="alert alert-info agileits" role="alert"> <strong>¡Aviso!</strong> '+texto+' </div>').fadeIn(1000);

    setTimeout(function(){
        $('.message').fadeOut();
    }, 5000);
}

function alert_warning(texto){
    $('.message').html('<div class="alert alert-warning agileits" role="alert"> <strong>¡Advertencia!</strong> '+texto+' </div>').fadeIn(1000);

    setTimeout(function(){
        $('.message').fadeOut();
    }, 5000);
}

function alert_danger(texto){
    $('.message').html('<div class="alert alert-danger agileits" role="alert"> <strong>Oh no!</strong> '+texto+' </div>').fadeIn(1000);

    setTimeout(function(){
        $('.message').fadeOut();
    }, 5000);
}

function init_load(){
    $('#search').fadeOut(0);
    $('.loader').fadeIn(1000);
}

function end_load(){
    $('.loader').fadeOut(0);
    $('#search').fadeIn(1000);
}

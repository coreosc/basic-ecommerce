$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.add-to-cart').unbind('click');
    $('.add-to-cart').click(function(){
        $.post('/dodaj-do-koszyka/' + $(this).attr('rel'), {}, function(response){
            if(response.success == true) {
                $('#minicart').html(response.minicartHtml);
            } else {
                alert('Przykro nam nie można dodać produktu. Prawdopodobnie stany magazynowe uległy wyczerpaniu.');
            }
        });
    });

    $('.remove-from-cart').unbind('click');
    $('.remove-from-cart').click(function(){
        $.post('/usun-z-koszyka/' + $(this).attr('rel'), {}, function(response){
            if(response.success == true) {
                $('#minicart').html(response.minicartHtml);
            } else {
                alert('Przykro nam, musisz to kupić!');
            }
        });
    });

});
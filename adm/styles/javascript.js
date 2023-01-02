$(document).ready(function(){

    $('#select').on('change', function(){
    
    var selectValor = '#'+$(this).val();
    
    $('#opcoes').children('div').hide(); 
    
    $('#opcoes').children(selectValor).show();
    
    });

});
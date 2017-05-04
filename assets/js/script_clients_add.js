$('input[name=address_zipcode]').on('blur', function(){
    var cep = $(this).val();

    if (cep !== "") {
        $.ajax({
            url:'http://api.postmon.com.br/v1/cep/'+cep,
            type:'GET',
            dataType:'json',
            success:function(json){
                if (json.logradouro != 'undefined') {
                    $('input[name=address]').val(json.logradouro);
                    $('input[name=address_neigh]').val(json.bairro);
                    $('input[name=address_city]').val(json.cidade);
                    $('input[name=address_state]').val(json.estado_info.nome);
                    $('input[name=address_country]').val("Brasil");
                }
            }
        });
    } else {
        cleanFormCEP();
    }

    function cleanFormCEP() {
        $('input[name=address]').val("");
        $('input[name=address_neigh]').val("");
        $('input[name=address_city]').val("");
        $('input[name=address_state]').val("");
        $('input[name=address_country]').val("");
    }
});
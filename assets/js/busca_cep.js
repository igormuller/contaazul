$('input[name=address_zipcode]').on('blur', function(){
    var cep = $(this).val().replace(/\D/g, '');


    if (cep !== "") {
        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {
            $('input[name=address]').val("...");
            $('input[name=address_neigh]').val("...");
            $('input[name=address_city]').val("...");
            $('input[name=address_state]').val("...");
            $('input[name=address_country]').val("...");

            $.ajax({
                url:'http://api.postmon.com.br/v1/cep/'+cep,
                type:'GET',
                dataType:'json',
                success:function(json){
                    if (json.logradouro !== 'undefined') {
                        $('input[name=address]').val(json.logradouro);
                        $('input[name=address_neigh]').val(json.bairro);
                        $('input[name=address_city]').val(json.cidade);
                        $('input[name=address_state]').val(json.estado_info.nome);
                        $('input[name=address_country]').val("Brasil");
                    }
                },
                error:function (json) {
                    if (json.statusText === "Not Found") {
                        cleanFormCEP();
                        alert("CEP não encontrado!");
                    }
                }
            });
        } else {
            cleanFormCEP();
            alert("CEP incorreto!");
        }
    } else {
        cleanFormCEP();
    }

});
function cleanFormCEP() {
    $('input[name=address_zipcode]').val("");
    $('input[name=address]').val("");
    $('input[name=address_neigh]').val("");
    $('input[name=address_city]').val("");
    $('input[name=address_state]').val("");
    $('input[name=address_country]').val("");
}
$(function () {
    //mascaras
    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.phone').mask(SPMaskBehavior, spOptions);
    $('.zipcode').mask('00000-000');
    $('.date').mask("00/00/0000");
    $('.cnpj').mask('00.000.000/0000-00');
    $('.cpf').mask('000.000.000-00');
    $('.money').mask('0000000000,00', {reverse: true});

    $('#busca').on('blur', function(){
        setTimeout(function(){
            $('.searchresults').hide();
        }, 500);
    });
    $('#busca').on('keyup', function(){
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{s:q},
                dataType:'json',
                success:function(json) {
                    if ($('.searchresults').length == 0) {
                        $('#busca').after('<div class="searchresults"></div>');
                    }

                    
                    $('.searchresults').css('top', '35px');

                    var html = '';

                    for(var i in json) {
                        html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }        
    });

    $('#buscaAdd').on('blur', function(){
        setTimeout(function(){
            $('.searchresults').hide();
        }, 500);
    });
    $('#buscaAdd').on('keyup', function(){
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{s:q},
                dataType:'json',
                success:function(json) {
                    if ($('.searchresults').length == 0) {
                        $('#buscaAdd').after('<div class="searchresults"></div>');
                    }

                    $('.searchresults').css('top', '35px');

                    var html = '';
                    for(var i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="selectClient(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });

    $('.client_add_button').on('click', function (){
        var name = $('#buscaAdd').val();
        if (name != '' && name.length >= 3){
            if (confirm('Você deseja adicionar um cliente com o nome: '+name+'?')) {
                $.ajax({
                    url:BASE_URL+'/ajax/add_client',
                    type:'POST',
                    data:{name:name},
                    dataType:'json',
                    success:function (json) {
                        $('.searchresults').hide();
                        $('#buscaAdd').attr('data-id', json.id);
                    }
                })
            }
        }
    });

});

function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $('.searchresults').hide();
    $('#buscaAdd').val(name);
    $('#buscaAdd').attr('data-id', id);
}
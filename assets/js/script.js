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
    $('.data').mask("00/00/0000");
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

                    for(var iclient in json) {
                        html += '<div class="si"><a href="'+json[iclient].link+'">'+json[iclient].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }        
    });
});
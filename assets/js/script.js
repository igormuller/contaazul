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

    //Search Client in View client.php
    $('#id_search_client').on('blur', function(){
        setTimeout(function(){
            $('.searchresults').hide();
        }, 500);
    });

    $('#id_search_client').on('keyup', function(){
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
                        $('#id_search_client').after('<div class="searchresults"></div>');
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
    //Search Client in View client.php

    //Search Client and Add Client in View saleAdd.php
    $('#client_add').on('blur', function(){
        setTimeout(function(){
            $('.searchresults').hide();
        }, 500);
    });
    $('#client_add').on('keyup', function(){
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
                        $('#client_add').after('<div class="searchresults"></div>');
                    }

                    $('.searchresults').css('top', '35px');

                    var html = '';
                    for(var i in json) {
                        html += '<div class="searchitemclient"><a href="javascript:;" onclick="selectClient(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });
    //Add Client in ajaxController.php
    $('.client_add_button').on('click', function (){
        var name = $('#client_add').val();
        if (name != '' && name.length >= 3){
            if (confirm('Você deseja adicionar um cliente com o nome: '+name+'?')) {
                $.ajax({
                    url:BASE_URL+'/ajax/add_client',
                    type:'POST',
                    data:{name:name},
                    dataType:'json',
                    success:function (json) {
                        $('.searchresults').hide();
                        $('input[name=client_id').val(json.id);
                    }
                })
            }
        }
    });
    //Search Client and Add Client in View saleAdd.php

    //Search Product and Add Product in View saleAdd.php
    $('#product_add').on('blur', function(){
        setTimeout(function(){
            $('.searchresults_product').hide();
        }, 500);
    });
    $('#product_add').on('keyup', function(){
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url:BASE_URL+'/ajax/'+datatype,
                type:'GET',
                data:{s:q},
                dataType:'json',
                success:function(json) {
                    if ($('.searchresults_product').length == 0) {
                        $('#product_add').after('<div class="searchresults_product"></div>');
                    }

                    $('.searchresults_product').css('top', '35px');

                    var html = '';
                    for(var i in json) {
                        html += '<div class="searchitemproduct"><a href="javascript:;" onclick="selectProduct(this)" data-id="'+json[i].id+'" data-price="'+json[i].price+'" data-name="'+json[i].name+'">'+json[i].name+' - R$'+json[i].price+'</a></div>';
                    }

                    $('.searchresults_product').html(html);
                    $('.searchresults_product').show();
                }
            });
        }
    });
    //Add product in sale
    $('.product_add_button').on('click', function (){
        var id = $('input[name=product_id').val();
        var name = $('input[name=product_name').val();
        var price = $('input[name=product_price').val();

        $('#product_add').val('');

        if ($('input[name="product['+id+']"]').length == 0) {
            var tr = 
            '<tr>'+
                '<td>'+id+'</td>'+
                '<td>'+name+'</td>'+
                '<td>R$ '+price+'</td>'+
                '<td>'+
                    '<input type="number" name="product['+id+']" class="form control p_qtd" value="1" data-price="'+price+'" onchange="updateSubtotal(this)" />'+
                '</td>'+
                '<td class="subtotal">R$ '+price+'</td>'+
                '<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
            '</tr>';

            $('#products_table').append(tr);
        } else {
            alert("Produto já adicionado à venda");
        }

        updateTotal();
        
    });
    //Search Product and Add Product in View saleAdd.php

});

//Search Product and Add Product in View saleAdd.php
function selectProduct(obj) {
    var id = $(obj).attr('data-id');
    var price = $(obj).attr('data-price');
    var name = $(obj).attr('data-name');
    
    $('.searchresults_product').hide();

    $('#product_add').val(name);
    $('input[name=product_id').val(id);
    $('input[name=product_name').val(name);
    $('input[name=product_price').val(price);
}
//Search Product and Add Product in View saleAdd.php

//Search Client and Add Client in View saleAdd.php
function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $('.searchresults').hide();
    $('#client_add').val(name);
    $('input[name=client_id').val(id);
}
//Search Client and Add Client in View saleAdd.php

function updateSubtotal(obj) {
    var qtd = $(obj).val();
    if (qtd <= 0) {
        $(obj).val(1);
        qtd = 1;
    }

    var price = $(obj).attr('data-price');
    var subtotal = price * qtd

    $(obj).closest('tr').find('.subtotal').html('R$ '+subtotal);
    updateTotal();
}

function excluirProd(obj) {
    $(obj).closest('tr').remove();
    updateTotal();
}

function updateTotal() {
    var total = 0;

    for (var i = 0; i < $('.p_qtd').length; i++) {
        var qtd = $('.p_qtd').eq(i);
        var price = qtd.attr('data-price');
        var subtotal = price * parseInt(qtd.val());

        total += subtotal;
    }
    $('input[name=total_price]').val(total);
}
/**
 * Created by igor.muller on 25/05/2017.
 */
$(function () {
    //Search Product and Select in input
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

    //Search Product and click Edit
    $('#search_product').on('blur', function(){
        setTimeout(function(){
            $('.searchresults_product').hide();
        }, 500);
    });
    $('#search_product').on('keyup', function(){
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
                        $('#search_product').after('<div class="searchresults_product"></div>');
                    }

                    $('.searchresults_product').css('top', '35px');

                    var html = '';
                    for(var i in json) {
                        html += '<div class="searchitemproduct"><a href="' + json[i].link + '">'+json[i].name+'</a></div>';
                    }

                    $('.searchresults_product').html(html);
                    $('.searchresults_product').show();
                }
            });
        }
    });

    //Add product in sale
    $('.product_add_button').on('click', function (){
        var id = $('input[name=product_id]').val();
        var name = $('input[name=product_name]').val();
        var price = $('input[name=product_price]').val();

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
    $('input[name=product_id]').val(id);
    $('input[name=product_name]').val(name);
    $('input[name=product_price]').val(price);
}
//Search Product and Add Product in View saleAdd.php

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
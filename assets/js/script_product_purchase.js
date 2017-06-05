/**
 * Created by igor.muller on 26/05/2017.
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

    //Create new product and include in purchase
    $('#saveNewProduct').on('click', function () {
        var newProduct = [$('input[name=nameNewProduct]').val(), $('input[name=qtd_minNewProduct]').val()];

        if ($('input[name=nameNewProduct]').val() != '') {
            $.ajax({
                url:BASE_URL+'/ajax/add_product',
                type:'POST',
                data:{newProduct:newProduct},
                dataType:'json',
                success:function (json) {

                    var id = json['id_product'];
                    var name = json['name'];
                    var price = 0;

                    var tr =
                        '<tr>'+
                        '<td>'+id+'</td>'+
                        '<td>'+name+'</td>'+
                        '<td>'+
                        '<input type="text" name="product['+id+'][price]" class="form control p_price" value="'+price+'" onchange="updatePrice(this)" />'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="product['+id+'][qtd]" class="form control p_qtd" value="1" data-price="'+price+'" onchange="updateSubtotal(this)" />'+
                        '</td>'+
                        '<td class="subtotal">R$ '+price+'</td>'+
                        '<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
                        '</tr>';

                    $('#products_table').append(tr);
                }

            });
        }
        $('input[name=nameNewProduct]').val("");
        $('input[name=qtd_minNewProduct]').val("");
    });

    //Add product in purchase
    $('.product_add_purchase').on('click', function (){
        var id = $('input[name=product_id]').val();
        var name = $('input[name=product_name]').val();
        var price = $('input[name=product_price]').val();

        $('#product_add').val('');

        if ($('input[name="product['+id+']"]').length == 0) {
            var tr =
                '<tr>'+
                '<td>'+id+'</td>'+
                '<td>'+name+'</td>'+
                '<td>'+
                '<input type="text" name="product['+id+'][price]" class="form control p_price" value="'+price+'" onchange="updatePrice(this)" />'+
                '</td>'+
                '<td>'+
                '<input type="number" name="product['+id+'][qtd]" class="form control p_qtd" value="1" data-price="'+price+'" onchange="updateSubtotal(this)" />'+
                '</td>'+
                '<td class="subtotal">R$ '+price+'</td>'+
                '<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
                '</tr>';

            $('#products_table').append(tr);
        } else {
            alert("Produto já adicionado à compra");
        }

        updateTotal();

    });
});

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

function updatePrice(obj) {
    var price = $(obj).val();
    $(obj).closest('tr').find('.p_qtd').attr('data-price',price);
    updateSubtotal($(obj).closest('tr').find('.p_qtd'));
}
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
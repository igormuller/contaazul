/**
 * Created by igor.muller on 25/05/2017.
 */
$(function () {

    $('#search_client').on('blur', function () {
        setTimeout(function () {
            $('.searchresults_client').hide();
        }, 500);
    });
    //Search Client and click Edit
    $('#search_client').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {s: q},
                dataType: 'json',
                success: function (json) {
                    if ($('.searchresults_client').length == 0) {
                        $('#search_client').after('<div class="searchresults_client"></div>');
                    }


                    $('.searchresults_client').css('top', '35px');

                    var html = '';

                    for (var i in json) {
                        html += '<div class="searchitemclient"><a href="' + json[i].link + '">' + json[i].name + '</a></div>';
                    }

                    $('.searchresults_client').html(html);
                    $('.searchresults_client').show();
                }
            });
        }
    });

    //Search Client and Add Client in View saleAdd.php
    $('#client_select').on('blur', function () {
        setTimeout(function () {
            $('.searchresults_client').hide();
        }, 500);
    });
    $('#client_select').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {s: q},
                dataType: 'json',
                success: function (json) {
                    if ($('.searchresults_client').length == 0) {
                        $('#client_select').after('<div class="searchresults_client"></div>');
                    }

                    $('.searchresults_client').css('top', '35px');

                    var html = '';
                    for (var i in json) {
                        html += '<div class="searchitemclient"><a href="javascript:;" onclick="selectClient(this)" data-id="' + json[i].id + '">' + json[i].name + '</a></div>';
                    }

                    $('.searchresults_client').html(html);
                    $('.searchresults_client').show();
                }
            });
        }
    });
    //Add Client in ajaxController.php
    $('.client_add_button').on('click', function () {
        var name = $('#client_select').val();
        if (name != '' && name.length >= 3) {
            if (confirm('Você deseja adicionar um cliente com o nome: ' + name + '?')) {
                $.ajax({
                    url: BASE_URL + '/ajax/add_client',
                    type: 'POST',
                    data: {name: name},
                    dataType: 'json',
                    success: function (json) {
                        $('.searchresults_client').hide();
                        $('input[name=client_id]').val(json.id);
                    }
                })
            } else {
                $('#client_select').val("");
            }
        }
    });
    //Search Client and Add Client in View saleAdd.php
});

function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $('.searchresults_client').hide();
    $('#client_select').val(name);
    $('input[name=client_id').val(id);
}
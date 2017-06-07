/**
 * Created by igor.muller on 06/06/2017.
 */
function openPopup(obj) {
    var data = $(obj).serialize();
    var url = BASE_URL+'/report/sales_pdf?'+data;
    window.open(url, "Relatório Vendas", "width=700, height=500");
    return false;
}

$(document).ready(function () {
	$(".datepicker").datepicker({
		format: "dd/mm/yyyy",
        language: "pt-BR",
        autoclose: true,
        toggleActive: true,
    	todayHighlight: true,
    	todayBtn: "linked",
    	clearBtn: true
	});

});
jQuery(function ($) {
$(function(){
	
	var sort_parameter = getURLParameter('sort');

	var search_type_parameter = getURLParameter('type');
	
	if("null" != search_type_parameter){
		$('#search_results_'+search_type_parameter).addClass('active');
	}else{		
		$('.search-result-menus li:first').addClass('active');
	}

	dropdown_select($("#"+sort_parameter));

	$('.sort-dropdown li a').click(function(){
		var search_type_parameter = getURLParameter('type');
		if("null" == search_type_parameter){
			search_type_parameter = "blogs";
		}
		window.location.href = 'search.html?type='+search_type_parameter+'&sort='+$(this).parent('li').attr('id');
	});
});
});

function dropdown_select(elm){
	var target = $('.sort-dropdown-toggle:first-child');
	target.text('Sort: '+elm.text());
	target.append(' <span class="caret"></span>');
	target.val(elm.text());
	elm.addClass('active');
}
function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}
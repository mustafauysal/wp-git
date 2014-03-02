$('.post-action-star-left-button').on('click',function(){

	count_element = $('.post-action-star-right-count');

	var _cur = parseInt(count_element.html());


	if(!$(this).hasClass('unstar')){		
		
		_cur = _cur+1;		

		$(this).addClass('unstar');

		$("#span_status").html("Unstar");

	}else{

		_cur = _cur-1;		

		$(this).removeClass('unstar');

		$("#span_status").html("Star");

	}

	count_element.html(_cur);
});
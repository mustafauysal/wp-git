jQuery(document).ready( function($) {

	$('.post-action-star').on('click', function() {

		count_element = $('.post-action-star-right-count');

		var _cur = parseInt(count_element.html());
		var $this = $(this);
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var ip_address = $this.data('ip-address');

		var post_data = {
			action: 'star_it',
			item_id: post_id,
			user_id: user_id,
			ip_address: ip_address,
			is_logged: wp_github_stargaze_vars.is_logged,
			star_it_nonce: wp_github_stargaze_vars.nonce
		};


		if(!$(this).hasClass('unstar')){

			_cur = _cur+1;

			$(this).addClass('unstar');

			$("#span_status").html("Unstar");

		}else{

			_cur = _cur-1;

			$(this).removeClass('unstar');

			$("#span_status").html("Star");

		}


		$.post(wp_github_stargaze_vars.ajaxurl, post_data, function(response) {
			if(response == 'ok') {
				count_element.html(_cur);
			} else {
				console.log(response);
			}
		});
		return false;




	});



});
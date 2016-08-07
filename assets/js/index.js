jQuery(function ($) {

template="<li class='all-posts-one'>\
<a href='' class='all-posts-one_blog_permalink_real'>\
<div class='all-posts-one_blog_permalink hide'></div>\
<div class='row'>\
<div class='col-xs-1 pull-left pencil-icon'><span class='glyphicon glyphicon-pencil'></span></div>\
<div class='col-xs-8 pull-left'><span class='all_posts_one_blog_name'></span>\
<div class='clearfix'></div><span class='all_posts_one_blog_description'></span>\
<div class='clearfix'></div>\
<span class='all_posts_one_blog_ago'></span></div>\
<div class='col-xs-3 blog-star_count'>\
<span class='all_posts_one_category'></span><span class='glyphicon glyphicon-star'></span> <span class='star_count'></span></div>\
</div></a></li>";

options = {
	valueNames: [ 'all_posts_one_blog_name', 'all-posts-one_blog_permalink', 'all_posts_one_blog_description','all_posts_one_blog_ago','all_posts_one_category','star_count' ],
	item: template
};

	if (typeof(List) != "undefined") {

		userList = new List('posts', options);

		userList.add(posts, function () {

			$('.all-posts-one_blog_permalink_real').each(function () {
				href = $(this).find('.all-posts-one_blog_permalink').html();
				$(this).attr('href', href);
			});
		});


		dropdown = false;

		$(function () {
			$('.filter-by-categories-dropdown .dropdown-menu li').on('click', function () {

				var a = $(this).find('a');

				var cat = a.html();

				if ('All Categories' == cat) {
					userList.filter();
					userList.search();

				} else {

					userList.filter(function (item) {
						if (item.values().all_posts_one_category == cat) {
							return true;
						} else {
							return false;
						}

					});
				}
				$('.filter-by-categories-dropdown .dropdown-toggle').html(cat);

				$('.filter-by-categories-dropdown .dropdown-toggle').append(' <span class="caret"></span>');
			});
		});

		var calendar = new CalHeatMap();
		calendar.init({
			displayLegend           : true,
			tooltip                 : true,
			data                    : wp_github_vars.data,
			domain                  : "month",
			range                   : 10,
			cellSize                : 10,
			start                   : new Date(new Date().getFullYear(), 0, 1),
			label                   : {
				position: "top"
			},
			legendCellSize          : 10,
			legendCellPadding       : 3,
			legendHorizontalPosition: 'right',
			itemName                : wp_github_vars.item_name,
			cellLabel               : {
				empty : "{date}",
				filled: wp_github_vars.cell.filled
			}
		});
	}

});
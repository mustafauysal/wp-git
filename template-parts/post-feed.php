<script>
	posts = [
<?php
$latest_posts = new WP_Query( 'post_type=post&posts_per_page=10' );
if ( $latest_posts->have_posts() ) {
	while ( $latest_posts->have_posts() ) {
		$latest_posts->the_post();
		$category = get_the_category();
		echo '{';
			echo '"all_posts_one_blog_name":"'.get_the_title().'",';
			echo '"all-posts-one_blog_permalink":"'.get_permalink().'",';
			echo '"all_posts_one_blog_description":"'. get_the_excerpt().'",';
			echo '"all_posts_one_blog_ago":"'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'",';
			echo '"all_posts_one_category":"'.$category[0]->cat_name.'",';
			echo '"star_count":"'.wp_github_get_starred_count(get_the_ID()).'"';
		echo '},';
	}
}
?>
	];
</script>

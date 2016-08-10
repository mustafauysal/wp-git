<?php get_header();?>
	<div class="container">
		<div class="row">

			<div class="col-xs-12 no-padding-left no-padding-right">

				<!-- Post Owner Username / Post Title -->
				<div class="col-xs-3 post-meta-info">
					<div class="search-title pull-left no-padding-left">
						Search
					</div>
				</div>

				<!-- Star / Unstar Post -->
				<div class="col-xs-9 no-padding-right no-padding-left">

					<form role="form" action="/" method="get">
						<div class="col-xs-10">
							<input type="text" class="form-control" name="s" autocomplete="off" value="<?php the_search_query(); ?>">
						</div>
						<div class="col-xs-2 pull-right">
							<button class="btn btn-success search-button" type="submit">
								<i class="glyphicon glyphicon-search"></i> <?php _e('Search','wp-git');?>
							</button>
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>
	<hr/>
	<div class="container">
	<div class="row">
	<div class="col-xs-12 no-padding-left no-padding-right">

	<div class="col-xs-3">
		<?php if ( is_active_sidebar( 'search_sidebar' ) ) : ?>
			<div id="search-sidebar" class="search-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'search_sidebar' ); ?>
			</div><!-- #search-sidebar -->
		<?php endif; ?>
	</div>

	<div class="col-xs-9 tab-content no-padding-left no-padding-right">
		<?php if ( have_posts() ) : ?>

		<div class="col-xs-9 search-result-heading pull-left">
			<h4><?php echo sprintf(__("We've found %s results for your search",'wp-git'),number_format($wp_query->found_posts));?></h4>
		</div>

		<div class="clearfix"></div>
		<hr class="ml15"/>

		<div class="col-xs-12">
			<?php 	while ( have_posts() ) : the_post(); ?>
			<ul class="all-posts list">
				<li class="all-posts-one">
					<a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>" class="all-posts-one_blog_permalink_real">
						<div class="row">
							<div class="col-xs-1 pull-left pencil-icon">
												<span class="glyphicon glyphicon-pencil">
												</span>
							</div>
							<div class="col-xs-8 pull-left">
												<span class="all_posts_one_blog_name">
												<?php echo get_the_title(); ?>
												</span>

								<div class="clearfix">
								</div>
												<span class="all_posts_one_blog_description">
													<?php echo wp_git_excerpt( get_the_ID(), 5 ); ?>
												</span>
								<div class="clearfix">
								</div>
												<span class="all_posts_one_blog_ago">
													<?php printf( _x( '%s ago', '%s = human-readable time difference', 'wp-git' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
												</span>
							</div>
							<div class="col-xs-3 blog-star_count">
												<span class="all_posts_one_category">
													 <?php $category = get_the_category();?>
													 <?php echo $category[0]->name; ?>
												</span>
												<span class="glyphicon glyphicon-star">
												</span>

												<span class="star_count">
													<?php echo wp_git_get_starred_count( get_the_ID() ); ?>
												</span>
							</div>
						</div>
					</a>
				</li>

			</ul>
			<?php endwhile;?>
			<div class="text-center">
						<?php wp_git_pagination();?>
			</div>
		</div>
		<?php else:?>
					Ooops! there is nothing...
		<?php endif?>
	</div>

	</div>

	</div>

	</div>
	</div>
<?php get_footer();?>
<div class="container">
<div class="row">
<?php get_template_part( 'template-parts/profile' ); ?>

<div class="col-xs-12 col-md-9">
	<ul class="nav nav-tabs ">
		<li class="active">
			<a href="#summary" data-toggle="tab">
				<span class="glyphicon glyphicon-stats"></span>
				<?php _e( 'Summary', 'wp-git' ); ?>
			</a>
		</li>
		<li>
			<a href="#posts" data-toggle="tab">
				<span class="glyphicon glyphicon-list-alt"></span>
				<?php _e( 'Posts', 'wp-git' ); ?>
			</a>
		</li>
		<li>
			<a href="#latest-feed" data-toggle="tab">
				<span class="glyphicon glyphicon-fire"></span>
				<?php _e( 'Latest Feed', 'wp-git' ); ?>
			</a>
		</li>
	</ul>
<div class="tab-content">
<div class="tab-pane active" id="summary">

	<div class="row">
		<?php get_template_part( 'template-parts/popular', 'posts' ); ?>
		<?php get_template_part( 'template-parts/latest', 'posts' ); ?>
	</div>

	<div class="row hidden-xs">
		<div class="col-xs-12">
			<div class="summary-box calendar-activity">

				<div class="summary-box-header">
					<h3 class="box-title"><?php _e( 'Calendar Activity', 'wp-git' ); ?></h3>
				</div>
				<div id="summary-box-wrapper">
					<div class="summary-box-content" id="cal-heatmap">

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="tab-pane" id="posts">
	<div class="row">
		<div class="col-xs-12">
			<div class="row filter-form">

				<div class="col-xs-12 col-sm-6">

					<div class="row">

						<div class="col-xs-12 col-sm-8">
							<input class="form-control filter-blogs search" name="filter" id="filter" type="text" placeholder="<?php _e( 'Filter Posts', 'wp-git' ); ?>" />
						</div>

						<div class="col-xs-6 col-sm-2">
							<button type="button" class="btn btn-info filter-blogs-button search"><?php _e( 'Search', 'wp-git' ); ?></button>
						</div>

						<div class="col-xs-6 col-sm-2  filter-by-categories-dropdown">

							<div class="btn-group">
								<button type="button" class="btn btn-info dropdown-toggle category-filter-btn" data-toggle="dropdown">
									<?php _e( 'All Categories', 'wp-git' ); ?><span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#"><?php _e( 'All Categories', 'wp-git' ); ?></a></li>
									<?php
									$available_cats = array();
									$cat_posts = wp_git_data('posts_page');
									if ( $cat_posts->have_posts() ) {
										while ( $cat_posts->have_posts() ) {
											$cat_posts->the_post();
											$category = get_the_category();
											if(!in_array( $category[0]->cat_name,$available_cats)){
												$available_cats[] = $category[0]->cat_name;
											}
										}
										foreach($available_cats as $cat_name){
											echo '<li><a href="#">'.$category[0]->cat_name.'</a></li>';
										}
									}
									?>
								</ul>
							</div>
						</div>

					</div>



				</div>



			</div>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-xs-12">
			<ul class="all-posts list"></ul>
		</div>
	</div>
</div>
<?php get_template_part( 'template-parts/latest', 'activities' ) ?>
</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
<?php get_template_part( 'template-parts/profile' ); ?>

<div class="col-sm-9 col-md-9">
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#summary" data-toggle="tab">
			<span class="glyphicon glyphicon-stats"></span>
			<?php _e( 'Summary', 'wp-github' ); ?>
		</a>
	</li>
	<li>
		<a href="#posts" data-toggle="tab">
			<span class="glyphicon glyphicon-list-alt"></span>
			<?php _e( 'Posts', 'wp-github' ); ?>
		</a>
	</li>
	<li>
		<a href="#latest-feed" data-toggle="tab">
			<span class="glyphicon glyphicon-fire"></span>
			<?php _e( 'Latest Feed', 'wp-github' ); ?>
		</a>
	</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="summary">

	<div class="row">
		<?php get_template_part( 'template-parts/popular', 'posts' ); ?>
		<?php get_template_part( 'template-parts/latest', 'posts' ); ?>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="summary-box calendar-activity">

				<div class="summary-box-header">
					<h3 class="box-title"><?php _e( 'Calendar Activity', 'wp-github' ); ?></h3>
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

				<div class="col-xs-6">

					<div class="row">

						<div class="col-xs-10">
							<input class="form-control filter-blogs search" name="filter" id="filter" type="text"
							       placeholder="<?php _e( 'Filter Blogs', 'wp-github' ); ?>" />
						</div>

						<div class="col-xs-2">
							<button type="button"
							        class="btn btn-info filter-blogs-button search"><?php _e( 'Search', 'wp-github' ); ?></button>
						</div>
					</div>
				</div>

				<div class="col-xs-2 filter-by-categories-dropdown">

					<div class="btn-group">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
							<?php _e( 'All Categories', 'wp-github' ); ?><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">All Categories</a></li>
							<?php $categories = get_categories();
							foreach ( $categories as $category ):
								?>
								<li><a href="#"><?php echo $category->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
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
<div class="col-xs-12 col-sm-6">

	<div class="summary-box">

		<div class="summary-box-header">
			<h3 class="box-title"><?php _e( 'Latest Posts', 'wp-git' ); ?></h3>
		</div>

		<div class="summary-box-content	">

				<ul class="blogs row">
					<?php $latest_posts = wp_git_data('latest_posts'); ?>
					<?php if ( false !== $latest_posts ): ?>
					<?php foreach($latest_posts as $latest_post):?>
					<li class="blog col-xs-12">
						<a href="<?php echo esc_url( get_the_permalink( $latest_post->ID ) ); ?>">
							<div class="row">
								<div class="col-xs-1">
									<span class="glyphicon glyphicon-fire"></span>
								</div>

								<div class="col-xs-7">
									<span class="blog-name">
										<?php echo get_the_title( $latest_post->ID ) ?>
									</span>

									<div class="clearfix"></div>

									<span class="blog-description">
										<?php echo wp_git_excerpt( $latest_post->ID, 5 ); ?>
									</span>

								</div>

								<div class="col-xs-3 pull-right blog-star_count">
									<?php echo wp_git_get_starred_count( $latest_post->ID ); ?>
									<span class="glyphicon glyphicon-star"></span>
								</div>
							</div>
						</a>
					</li>
						<?php endforeach;?>
					<?php endif;?>
				</ul>
		</div>
	</div>

</div>
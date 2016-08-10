<div class="col-xs-12 col-sm-6">

<div class="summary-box">

		<div class="summary-box-header">
			<h3 class="box-title"><?php _e( 'Popular Posts', 'wp-git' ); ?></h3>
		</div>

		<div class="summary-box-content	">

			<ul class="blogs row">

			<?php
			$popular_posts =  wp_github_data('popular_posts');
			?>
				<?php if ( false !== $popular_posts ): ?>
					<?php foreach($popular_posts as $starred_post):?>
					<li class="blog col-xs-12">
						<a href="<?php echo esc_url( get_the_permalink( $starred_post->ID ) ); ?>">
						<div class="row">
								<div class="col-xs-1">
									<span class="glyphicon glyphicon-star"></span>
								</div>
								<div class="col-xs-7">
									<span class="blog-name">
										<?php echo get_the_title( $starred_post->ID ) ?>
									</span>

									<div class="clearfix"></div>
									<span class="blog-description">
										<?php echo wp_github_excerpt( $starred_post->ID, 5 ); ?>
									</span>
								</div>

								<div class="col-xs-3 pull-right blog-star_count">
									<?php echo wp_github_get_starred_count($starred_post->ID);?>
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

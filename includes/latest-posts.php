<div class="col-xs-6">

	<div class="summary-box">

		<div class="summary-box-header">
			<h3 class="box-title">Latest Writings</h3>
		</div>

		<div class="summary-box-content	">
			<?php
			$query = new WP_Query( array(
				'posts_per_page' => 5,
			) );

			while ( $query->have_posts() ): $query->the_post(); ?>

				<ul class="blogs row">

					<li class="blog col-xs-12">
						<a href="#">
							<div class="row">
								<div class="col-xs-1">
									<span class="glyphicon glyphicon-pencil"></span>
								</div>

								<div class="col-xs-7">
									<span class="blog-name">
										<?php the_title(); ?>
									</span>

									<div class="clearfix"></div>

									<span class="blog-description">
										<?php echo excerpt( 5 ); ?>
									</span>

								</div>

								<div class="col-xs-3 pull-right blog-star_count">
									3 <span class="glyphicon glyphicon-star"></span>
								</div>
							</div>
						</a>
					</li>
				</ul>
			<?php endwhile; ?>
		</div>
	</div>

</div>
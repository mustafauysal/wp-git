
<div class="tab-pane" id="latest-feed">
	<div class="row">
		<div class="col-xs-12">
			<ul class="latest-activities">

			<?php
			$activities = wp_github_data( 'latest_feed' );
			foreach ( $activities as $activity ):?>
				<li class="latest-activity">
					<div class="row">
						<div class="col-xs-2 col-sm-1 latest-activity-icon">
							<span class="glyphicon <?php echo esc_attr($activity['icon']); ?>"></span>
						</div>
						<div class="col-xs-10 col-sm-11 latest-activity-text">
							<span class="latest-activity-ago"><?php echo esc_attr($activity['time_ago']); ?></span>
							<div class="clearfix"></div>
							<div>
								<span class="latest-activity-photo pull-left">
									<?php echo $activity['avatar']; ?>
								</span>
								<span class="latest-activity-subject">
									<?php echo $activity['description']; ?>
								</span>
							</div>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>

<?php
/**
 * profile.php created by PhpStorm.
 * User: mustafauysal
 * Date: 16.03.2014
 * Time: 19:15
 */

?>
<div class="col-md-3  col-sm-3">
	<a href="<?php echo esc_url( wp_github_data( 'profile_url' ) ); ?>">
		<img src="<?php echo esc_url( wp_github_data( 'avatar_url' ) ); ?>" class="img-responsive img-rounded" height="220" width="220">
	</a>

	<h1 class="user-names">
		<?php
		$profile_name = wp_github_data( 'profile_name' );
		if ( ! empty( $profile_name ) ): ?>
			<span class="user-fullname"><?php echo esc_attr( $profile_name ); ?></span>
		<?php endif; ?>

		<?php
		$user_name = wp_github_data( 'profile_username' );
		if ( ! empty( $user_name ) ): ?>
			<span class="user-username"><?php echo esc_attr( $user_name ); ?></span>
		<?php endif; ?>

		<?php
		$user_bio = wp_github_data( 'profile_bio' );
		if ( ! empty( $user_bio ) ): ?>
		<span class="user-bio"> <?php echo esc_attr($user_bio); ?></span>
		<?php endif; ?>

	</h1>

	<div class="row">

		<ul class="user-details col-xs-12">
			<?php
			$company = wp_github_data( 'profile_company' );
			if ( ! empty( $company ) ): ?>
			<li class="user-detail ">
				<span class="glyphicon icon glyphicon-briefcase"></span>
				<span class="wp_github_company"><?php echo esc_attr( $company ); ?></span>
			</li>
			<?php endif; ?>

			<?php
			$location = wp_github_data( 'profile_location' );
			if ( ! empty( $location ) ): ?>
			<li class="user-detail">
				<span class="glyphicon icon glyphicon-map-marker"></span>
				<span class="wp_github_location"><?php echo esc_attr($location); ?></span>
			</li>
			<?php endif; ?>

			<?php
			$email = wp_github_data( 'profile_email' );
			if ( ! empty( $email ) ): ?>
			<li class="user-detail">
				<span class="glyphicon icon glyphicon-envelope"></span>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="wp_github_email">
					<?php echo esc_attr( $email ); ?>
				</a>
			</li>
			<?php endif; ?>

			<?php
			$website_address = wp_github_data( 'profile_website_url' );
			if ( ! empty( $website_address ) ): ?>
			<li class="user-detail">
				<span class="glyphicon icon glyphicon-link"></span>
				<a href="<?php echo esc_url( $website_address ); ?>" class="wp_github_url">
					<?php echo esc_url( $website_address ); ?>
				</a>
			</li>
			<?php endif; ?>

			<?php
			$since = wp_github_data( 'profile_date' );
			if ( ! empty( $since ) ): ?>
			<li class="user-detail">
				<span class="glyphicon icon glyphicon-time"></span>
				<span class="wp_github_date"><?php echo esc_attr( $since ); ?></span>
			</li>
			<?php endif; ?>

		</ul>
	</div>

	<div class="user-stats">
		<a class="user-stat">
			<?php echo sprintf( __( '<strong class="user-stat-count">%s</strong> posts', 'wp-github' ), intval( wp_github_data( 'post_count' ) ) ); ?>
		</a>

		<a class="user-stat">
			<?php echo sprintf( __( '<strong class="user-stat-count">%s</strong> comments', 'wp-github' ), intval( wp_github_data( 'comment_count' ) ) ); ?>
		</a>

		<a class="user-stat">
			<?php echo sprintf( __( '<strong class="user-stat-count">%s</strong> stars gotten', 'wp-github' ), intval( wp_github_data( 'star_count' ) ) ); ?>
		</a>
	</div>
</div>
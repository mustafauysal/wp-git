<?php
/**
 * profile.php created by PhpStorm.
 * User: mustafauysal
 * Date: 16.03.2014
 * Time: 19:15
 */

?>
<div class="col-xs-3">
	<a href="<?php echo home_url( '/' ); ?>">
		<img src="<?php echo wp_github_get_logo(); ?>" class="img-responsive img-rounded" height="220" width="220">
	</a>

	<h1 class="user-names">
		<span class="user-fullname">Said Özcan</span>
		<span class="user-username">s</span>
		<span class="user-bio"> Example bio </span>
	</h1>

	<div class="row">

		<ul class="user-details col-xs-12">
			<li class="user-detail ">
				<span class="glyphicon icon glyphicon-briefcase"></span>
				<span class="wp_github_company">Ubit</span>
			</li>

			<li class="user-detail">
				<span class="glyphicon icon glyphicon-map-marker"></span>
				<span class="wp_github_location">İstanbul</span>
			</li>

			<li class="user-detail">
				<span class="glyphicon icon glyphicon-envelope"></span>
				<a href="mailto:said@ozcan.co" class="wp_github_email">
					said@ozcan.co
				</a>
			</li>

			<li class="user-detail">
				<span class="glyphicon icon glyphicon-link"></span>
				<a href="http://said.ozcan.co" class="wp_github_url">
					http://said.ozcan.co
				</a>
			</li>

			<li class="user-detail">
				<span class="glyphicon icon glyphicon-time"></span>
				<span class="wp_github_date">Started on Jul 13, 2012</span>
			</li>
		</ul>
	</div>

	<div class="user-stats">

		<a class="user-stat">
			<strong class="user-stat-count">4</strong>
			posts
		</a>

		<a class="user-stat">
			<strong class="user-stat-count">9</strong>
			comments
		</a>

		<a class="user-stat">
			<strong class="user-stat-count">93</strong>
			stars gotten
		</a>

	</div>
</div>
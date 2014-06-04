<?php
/**
 * profile.php created by PhpStorm.
 * User: mustafauysal
 * Date: 16.03.2014
 * Time: 19:15
 */

?>
<div class="col-xs-3">
	<a href="<?php echo get_gravatar_url( 'saidozcn@gmail.com', 256 ); ?>">
		<img src="<?php echo get_gravatar_url( 'saidozcn@gmail.com', 256 ); ?>" class="img-responsive img-rounded" alt="User Name" height="220" width="220">
	</a>

	<h1 class="user-names">
		<span class="user-fullname">Said Özcan</span>
		<span class="user-username">s</span>
	</h1>

	<div class="row">

		<ul class="user-details col-xs-12">
			<li class="user-detail">
				<span class="glyphicon glyphicon-briefcase"></span>
				Ubit
			</li>

			<li class="user-detail">
				<span class="glyphicon glyphicon-map-marker"></span>
				İstanbul
			</li>

			<li class="user-detail">
				<span class="glyphicon glyphicon-envelope"></span>
				<a href="mailto:said@ozcan.co">
					said@ozcan.co
				</a>
			</li>

			<li class="user-detail">
				<span class="glyphicon glyphicon-link"></span>
				<a href="http://said.ozcan.co">
					http://said.ozcan.co
				</a>
			</li>

			<li class="user-detail">
				<span class="glyphicon glyphicon-time"></span>
				Started on Jul 13, 2012
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
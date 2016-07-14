<!doctype html>
<html lang="en">
<head>
	<title>Wp-Github Theme</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head();?>

</head>
<body>

<div id="wrap">
	<header class="navbar navbar-static-top" role="navigation">
		<div class="container">
			<div class="col-xs-12 no-padding-left no-padding-right">
				<div class="col-xs-3 no-padding-left navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo home_url();?>">Wp-GitHub</a>
				</div>

				<div class="col-xs-5 navbar-header">
					<form class="navbar-form" role="search" action="search.html" method="post">
						<div class="input-group add-on">
							<input type="text" class="form-control" placeholder="Search blog or page" name="q" id="q" autocomplete="off">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>

				<div class="col-xs-4 pull-right collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>
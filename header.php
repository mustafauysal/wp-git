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
				<div class="col-xs-12 col-md-3 no-padding-left navbar-header">
					<a class="navbar-brand" href="<?php echo home_url();?>"><?php echo get_bloginfo('name');?></a>
				</div>

				<div class="col-xs-5 col-md-5 navbar-header">
					<form class="navbar-form" role="search" action="/" method="get">
						<div class="input-group add-on">
							<input type="text" class="form-control" placeholder="Search blog or page" name="s" value="<?php the_search_query(); ?>"  id="s" autocomplete="off">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>

				<div class="col-xs-4 col-md-4 pull-right collapse navbar-collapse">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'items_wrap' => '<ul class="nav navbar-collapse navbar-nav navbar-right">%3$s'  ) ); ?>
				</div>
			</div>
		</div>
	</header>
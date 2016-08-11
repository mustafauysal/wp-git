<!doctype html>
<html lang="en">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head();?>

</head>
<body>

<div id="wrap">
	<header class="navbar navbar-static-top" role="navigation">

		<div class="container">
			<div class="col-xs-12 no-padding-left no-padding-right">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'wp-git' ); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="col-xs-6 col-md-3 no-padding-left navbar-header">
					<a class="navbar-brand" href="<?php echo home_url();?>"><?php echo get_bloginfo('name');?></a>
				</div>

				<?php if ( ! is_search() ): ?>
				<div class="col-xs-12 col-md-5 navbar-header">
					<form class="navbar-form" role="search" action="/" method="get">
						<div class="input-group add-on" id="header-search">
							<input type="text" class="form-control" placeholder="<?php _e('Search...','wp-git'); ?>" name="s" value="<?php the_search_query(); ?>"  id="s" autocomplete="off">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<?php endif; ?>

				<div class="col-xs-12 col-md-4  collapse navbar-collapse">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'items_wrap' => '<ul id="headmenu" class="nav navbar-collapse navbar-nav navbar-right">%3$s' ) ); ?>
				</div>


			</div>
		</div>
	</header>
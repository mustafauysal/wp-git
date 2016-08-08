<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-md-4 ">
				2014 <a href="http://github.com/path/to/repo">Wp-Github-Theme</a>
			</div>

			<div class="col-xs-6 col-md-4 footer-center footer-brand-logo">
				<i class="fa fa-bolt"></i>
			</div>

			<div class="col-xs-12  col-md-4  pull-right hidden-xs">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'items_wrap' => '<ul class="footer-menu pull-right no-padding-right">%3$s'  ) ); ?>
			</div>
		</div>
	</div>
</div>

<?php get_template_part('template-parts/post','feed');?>
<?php wp_footer();?>

</body>
</html>
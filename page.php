<?php get_header(); ?>

<div class="container">
	<div class="row">
<?php while ( have_posts() ) : the_post(); ?>

	<!-- Post Owner Username / Post Title -->
	<div class="col-xs-10 post-meta-info">
		<span class="glyphicon glyphicon-pencil pull-left"></span>

		<div class="post-left-info pull-left">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
				<span class="post-owner-username"><?php the_author(); ?></span>
			</a>
			<span class="slash-divider">/</span>
			<a href="<?php echo get_the_permalink();?>">
								<span class="post-title">
									<?php the_title(); ?>
								</span>
			</a>
		</div>
	</div>

	<!-- Star / Unstar Post -->
	<?php echo wp_github_star_it_btn();?>

	</div>
	</div>
	<hr />

	<div class="container">
	<div class="row">
	<div class="col-xs-12 tab-content">

	<div class="tab-content">

	<div class="tab-pane active" id="post">

		<div class="row post-content-wrapper">

			<div class="col-xs-12 post-inner-wrapper">


				<div class="row post-owner-ago">

					<div class="col-xs-4 pull-left post-owner-ago-content">

						<a href="assets/img/test.jpeg" class="post-owner-img pull-left">
							<img src="<?php echo wp_github_get_author_gravatar_url( array('size' => 20)); ?>" class="" alt="User Name" height="20" width="20">
						</a>

						<div class="post-owner-ago-text pull-left">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
								<?php echo get_the_author();?>
							</a>
							<?php printf( _x( '%s ago', '%s = human-readable time difference', 'wp-github' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
						</div>
					</div>
					<div class="col-xs-4 post-owner-latest-update pull-right">
					<?php $last_rev = wp_github_get_latest_revision(get_the_ID());
					$diff_url = get_permalink().'?rev='.$last_rev->ID;
					?>

						<a href="<?php echo esc_url($diff_url);?>">
							latest update
							<span class="commit">
							<?php echo wp_github_get_post_hash(get_the_date());?>
							</span>
						</a>
					</div>
				</div>


				<div class="row post-content">
					<?php if(isset($_REQUEST['rev']) && intval($_REQUEST['rev'])>0):?>
					<?php echo wp_github_compare_revision(get_the_ID(),$_REQUEST['rev'],$_REQUEST['to']);?>
					<?php else:?>
					<?php the_content(); ?>
					<?php endif;?>
				</div>

			</div>
		</div>
	</div>

<?php endwhile; // end of the loop. ?>

	<div class="tab-pane" id="comments">
		<div class="row no-padding-left all-comments">
			<div class="col-xs-12">
				<?php
				$comments = get_comments( 'post_id=' . $wp_query->post->ID );
				foreach ( $comments as $comment ) :
					echo( $comment->comment_author );
					?>
					<div class="any-comment">

						<div class="col-xs-1 no-padding-left any-comment-image">
							<img class="img-rounded" alt="<?php echo get_the_author();?>" src="<?php echo wp_github_get_gravatar_url( $comment->comment_author_email, 80 ); ?>" width="40">
						</div>

						<div class="col-xs-11 no-padding-right any-comment-right no-padding-left">
							<div class="any-comment-header">

								<a href="#" class="bold any-comment-username"><?php echo $comment->comment_author; ?> </a> <?php echo human_time_diff( strtotime($comment->comment_date_gmt), current_time( 'timestamp' ) ) . ' ago'; ?>

							</div>
							<div class="any-comment-content">
								<?php echo $comment->comment_content; ?>
							</div>
						</div>

						<div class="clearfix"></div>

					</div>

				<?php endforeach; ?>
				<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );

				$arg = array(
					'comment_notes_before' => "",
					'logged_in_as'         => false,
					'title_reply'          => "",
					'label_submit'         => __( 'Comment' ),
					'fields'               => array(

						'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />',
						'email'  => '<label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',
					),
					'comment_field'        => '<textarea name="comment" class="form-group col-xs-12 leave-comment" rows="5" placeholder="Leave a comment"></textarea>',
					'comment_notes_after'  => '<button type="submit" class="btn btn-success pull-right"> <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comment </button>',
					'id_submit'            => 'comment_submit',

				);
				comment_form( $arg ); ?>

			</div>
		</div>
	</div>
	<div class="tab-pane" id="revisions">
	<div class="row no-padding-left all-revisions">
	<div class="col-xs-12">

		<?php
		$revisions = wp_github_post_revisions();
		if(!empty($revisions)):?>
			<?php foreach($revisions as $rev_group => $revisions_by_date):?>
				<div class="revision-group">
					<div class="revision-group-header">

					 <?php echo date_i18n( get_option( 'date_format' ), strtotime( $rev_group ) ); ?>

					</div>
				<?php foreach($revisions_by_date as $revision):?>
					<div class="any-revision">
						<div class="row">
							<div class="col-xs-12">
								<div class="col-xs-1 no-padding-left any-revision-image">
									<img class="img-rounded img-revision" alt="Said Özcan" src="<?php echo wp_github_get_author_gravatar_url(array('size'=>40));?>" width="40">
								</div>

								<div class="col-xs-9 no-padding-left any-revision-right-group">
									<div class="any-revision-message no-padding-left">
										<?php echo $revision->post_title;?>
									</div>
									<div class="any-revision-author">
										<a href=""><?php
										$user_info = get_userdata($revision->post_author);
										echo $user_info->display_name;
										?></a> authored <?php printf( _x( '%s ago', '%s = human-readable time difference', 'wp-github' ), human_time_diff( strtotime($revision->post_date), current_time( 'timestamp' ) ) ); ?>

									</div>
								</div>

								<div class="col-xs-2 pull-right no-padding-right">
									<div class="post-owner-latest-update pull-right">
										<a href="<?php echo  get_permalink().'?rev='.$last_rev->ID.'&to='.$revision->ID;?>">
																				<span class="commit">
																					#<?php echo wp_github_get_post_hash($revision->post_date);?>
																				</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					<div class="clearfix"></div>
					</div>
				<?php endforeach;?>
							</div>
			<?php endforeach;?>

		<?php endif;?>

	</div>
	</div>
	</div>
</div>
</div>
	</div>
	</div>
	</div>

<?php get_footer(); ?>
<?php get_header(); ?>

<div class="container">
	<div class="row">
<?php while ( have_posts() ) : the_post(); ?>

	<!-- Post Owner Username / Post Title -->
	<div class="col-xs-10 post-meta-info">
		<span class="glyphicon glyphicon-pencil pull-left"></span>

		<div class="post-left-info pull-left">
			<a href="#">
								<span class="post-owner-username">
									<?php the_author(); ?>
								</span>
			</a>
			<span class="slash-divider">/</span>
			<a href="#">
								<span class="post-title">
									<?php the_title(); ?>
								</span>
			</a>
		</div>
	</div>

	<!-- Star / Unstar Post -->
	<div class="col-xs-2">
		<div class="post-action-star pull-right">

			<!-- If not starred -->
			<div class="btn post-action-star-left-button pull-left">
				<span class="glyphicon glyphicon-star"></span> <span id="span_status">Star</span>
			</div>
			<!-- Endif -->
			<!--
				*** : Differences
				If already starred
					<div class="btn post-action-star-left-button ***unstar*** pull-left">
						<span class="glyphicon glyphicon-star"></span> <span id="span_status">***Unstar***</span>
					</div>
				Endif
			-->
			<div class="post-action-star-right-count pull-left">
				4
			</div>
		</div>
	</div>


	</div>
	</div>
	<hr />

	<div class="container">
	<div class="row">
	<div class="col-xs-10 tab-content">

	<div class="tab-content">
	<!-- Post Excerpt + Permalink -->
	<div class="row">

		<div class="col-xs-12">
			<div class="post-excerpt-info">
				<span class="post-excerpt"><?php echo wp_github_custom_excerpt( 25 ); ?></span>
										<span class="post-permalink">
											<a href="<?php the_permalink(); ?>">
												<?php the_permalink(); ?>
											</a>
										</span>
			</div>
		</div>

	</div>

	<!-- Post Basic Stats -->
	<div class="row">

		<div class="col-xs-12">

			<div class="row post-basic-stats">

				<div class="col-xs-4">
					<span class="glyphicon glyphicon-time"></span>
					<span class="post-basic-stat-count"><?php echo wp_github_get_post_revision_count();?></span> <span class="post-basic-stat-text"><?php _e('versions','wp-github');?></span>
				</div>

				<div class="col-xs-4">
					<span class="glyphicon glyphicon-comment"></span>
					<span class="post-basic-stat-count"><?php echo get_comments_number();?></span> <span class="post-basic-stat-text"><?php _e('comments','wp-github');?></span>
				</div>

				<div class="col-xs-4">
					<span class="glyphicon glyphicon-align-left"></span>
					<span class="post-basic-stat-count"><?php echo wp_github_word_count();?></span> <span class="post-basic-stat-text"><?php _e('words','wp-github');?></span>
				</div>

			</div>

		</div>

	</div>

	<div class="tab-pane active" id="post">

		<div class="row post-content-wrapper">

			<div class="col-xs-12 post-inner-wrapper">


				<div class="row post-owner-ago">

					<div class="col-xs-4 pull-left post-owner-ago-content">

						<a href="assets/img/test.jpeg" class="post-owner-img pull-left">
							<img src="<?php echo wp_github_get_gravatar_url( 'saidozcn@gmail.com', 80 ); ?>" class="" alt="User Name" height="20" width="20">
						</a>

						<div class="post-owner-ago-text pull-left">
							<a href="#">
								s
							</a>
							authored 1 hour ago
						</div>
					</div>

					<div class="col-xs-4 post-owner-latest-update pull-right">
						<a href="#">
							latest update
							<span class="commit">
							<?php echo substr(sha1(get_the_date()),0,7);?>
							</span>
						</a>
					</div>
				</div>


				<div class="row post-content">
					<?php the_content(); ?>
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
							<img class="img-rounded" alt="Said Özcan" src="<?php echo wp_github_get_gravatar_url( $comment->comment_author_email, 80 ); ?>" width="40">
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

	<div class="revision-group">
		<div class="revision-group-header">
			Feb 26, 2014
		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/test.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">s</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343515
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/test.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">s</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343515
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/test.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">s</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343515
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

	</div>

	<div class="revision-group">
		<div class="revision-group-header">
			Feb 23, 2014
		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/mustafa.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">mustafa uysal</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343511
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/mustafa.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">mustafa uysal</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343512
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

		<div class="any-revision">

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1 no-padding-left any-revision-image">
						<img class="img-rounded img-revision" alt="Said Özcan" src="assets/img/mustafa.jpeg" width="40">
					</div>

					<div class="col-xs-9 no-padding-left any-revision-right-group">
						<div class="any-revision-message no-padding-left">
							Phasellus et neque nec elit varius ultrices. Nunc aliquam, neque sit.
						</div>
						<div class="any-revision-author">
							<a href="#">mustafa uysal</a> authored today.
						</div>
					</div>

					<div class="col-xs-2 pull-right no-padding-right">
						<div class="post-owner-latest-update pull-right">
							<a href="#">
																	<span class="commit">
																		#343513
																	</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

		</div>

	</div>
	</div>
	</div>
	</div>
</div>
</div>
	<div class="col-xs-2 blog-tab-pane tabbable tabs-right no-padding-left">
		<ul class="nav nav-tabs blog-tabs">
			<li class="active">
				<a href="#post" data-toggle="tab"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Post</a>
			</li>
			<li>
				<a href="#comments" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;&nbsp;Comments</a>
			</li>
			<li>
				<a href="#revisions" data-toggle="tab"><span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;&nbsp;Revisions</a>
			</li>
		</ul>

		<hr />

		<ul class="social-share">
			<li class="any-social-share first-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-facebook"></i> <span class="social-share-text"> Facebook</span>
				</button>
			</li>

			<li class="any-social-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-twitter"></i> <span class="social-share-text"> Twitter</span>
				</button>
			</li>

			<li class="any-social-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-google-plus"></i> <span class="social-share-text"> Google+</span>
				</button>
			</li>

			<li class="any-social-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-linkedin"></i> <span class="social-share-text"> LinkedIn</span>
				</button>
			</li>

			<li class="any-social-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-pinterest"></i> <span class="social-share-text"> Pinterest</span>
				</button>
			</li>

			<li class="any-social-share">
				<button class="btn btn-default social-share-button">
					<i class="fa fa-tumblr"></i> <span class="social-share-text"> Tumblr</span>
				</button>
			</li>
		</ul>
	</div>
</div>
</div>
	</div>

<?php get_footer(); ?>
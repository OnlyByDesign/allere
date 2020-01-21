<?php

	$zerif_total_posts = get_option('posts_per_page'); /* number of latest posts to show */
	
	if( !empty($zerif_total_posts) && ($zerif_total_posts > 0) ):

		zerif_before_latest_news_trigger();
	
		$zerif_latest_news_show = get_theme_mod('zerif_latest_news_show');
				
		if( !empty($zerif_latest_news_show) ):
			
			echo '<section class="latest-news" id="latestnews">';
			
		elseif ( is_customize_preview() ):
		
			echo '<section class="latest-news zerif_hidden_if_not_customizer" id="latestnews">';
			
		endif;

		zerif_top_latest_news_trigger();
	
		if( !empty($zerif_latest_news_show) || is_customize_preview() ):
			
			echo '<div class="container">';

				/* SECTION HEADER */
				
				echo '<div class="section-header">';

					/* Title */
					zerif_latest_news_header_title_trigger();

					/* Subtitle */
					zerif_latest_news_header_subtitle_trigger();

				echo '</div><!-- END .section-header -->';

				echo '<div class="clear"></div>';
				
				echo '<div id="carousel-homepage-latestnews" class="carousel slide" data-ride="carousel">';
					
					/* Wrapper for slides */
					
					echo '<div class="carousel-inner" role="listbox">';

						$zerif_latest_loop = new WP_Query( apply_filters( 'zerif_latest_news_parameters', array( 'post_type' => 'post', 'posts_per_page' => $zerif_total_posts, 'order' => 'DESC','ignore_sticky_posts' => true )) );

						$newSlideActive = '<div class="item active" role="option">';
						$newSlide 		= '<div class="item">';
						$newSlideClose 	= '<div class="clear"></div></div>';
						$i_latest_posts= 0;
						
						while ( $zerif_latest_loop->have_posts() ) : $zerif_latest_loop->the_post();

							$i_latest_posts++;

							if ( !wp_is_mobile() ){

									if($i_latest_posts == 1){
										echo $newSlideActive;
									}
									else if($i_latest_posts % 4 == 1){
										echo $newSlide;
									}
								
									echo '<div class="col-sm-3 latestnews-box">';

										echo '<div class="latestnews-img">';
										
											echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';

												if ( has_post_thumbnail() ) :

													echo get_the_post_thumbnail($post->ID, 'post-thumbnail'); 
													
												else:
													
													echo '<img src="'.get_template_directory_uri().'/images/blank-latestposts.png" alt="Post image">';
												
												endif;

											echo '</a>';
											
										echo '</div>';

										echo '<div class="latesnews-content">';

											echo '<h5 class="latestnews-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h5>';

											$ismore = @strpos( $post->post_content, '<!--more-->');
											if($ismore) : the_content( sprintf( esc_html__('[...]','zerif'), '<span class="screen-reader-text">'.esc_html__('about ', 'zerif').get_the_title().'</span>' ) );
											else : the_excerpt();
											endif;

										echo '</div>';

									echo '</div><!-- .latestnews-box"> -->';

									/* after every four posts it must closing the '.item' */
									if($i_latest_posts % 4 == 0){
										echo $newSlideClose;
									}

							} else {

								if( $i_latest_posts == 1 ) $active = 'active'; else $active = ''; 
		
								echo '<div class="item '.esc_html($active).'">';
									echo '<div class="col-md-3 latestnews-box">';
										echo '<div class="latestnews-img">';
											echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
												echo get_the_post_thumbnail($post->ID, 'post-thumbnail'); 
											echo '</a>';
										echo '</div>';
										echo '<div class="latesnews-content">';
											echo '<h5 class="latestnews-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h5>';
											$ismore = @strpos( $post->post_content, '<!--more-->');
											if($ismore) : the_content( sprintf( esc_html__('[...]','zerif'), '<span class="screen-reader-text">'.esc_html__('about ', 'zerif').get_the_title().'</span>' ) );
											else : the_excerpt();
											endif;
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						
						endwhile;

						if ( !wp_is_mobile() ) {

							// if there are less than 10 posts
							if($i_latest_posts % 4!=0){
								echo $newSlideClose;
							}

						}

						wp_reset_postdata(); 
						
					echo '</div><!-- .carousel-inner -->';

					/* Controls */
					echo apply_filters( 'zerif_latest_news_left_arrow','<a class="left carousel-control" href="#carousel-homepage-latestnews" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">'.__('Previous','zerif').'</span>
					</a>' );
					echo apply_filters( 'zerif_latest_news_right_arrow','<a class="right carousel-control" href="#carousel-homepage-latestnews" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">'.__('Next','zerif').'</span>
					</a>' );
				echo '</div><!-- #carousel-homepage-latestnews -->';

			echo '</div><!-- .container -->';

			zerif_bottom_latest_news_trigger();

		echo '</section>';
	endif;

	zerif_after_latest_news_trigger();
endif; ?>
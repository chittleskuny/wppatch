<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version.
 */
?>
	<header id="masthead" class="<?php echo is_singular() && twentynineteen_can_show_post_thumbnail() ? 'site-header featured-image' : 'site-header'; ?>">

		<div class="site-branding-container">
			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
		</div><!-- .site-branding-container -->

		<?php if ( is_singular() && twentynineteen_can_show_post_thumbnail() ) : ?>
			<div class="site-featured-image">
				<?php
					twentynineteen_post_thumbnail();
					the_post();
					$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;

					$classes = 'entry-header';
				if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
					$classes = 'entry-header has-discussion';
				}
				?>
				<div class="<?php echo $classes; ?>">
					<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
				</div><!-- .entry-header -->
				<?php rewind_posts(); ?>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="sidebar" class="site-sidebar", role="complementary">
		<?php
			get_search_form();
			twentynineteen_mix_list();
		?>
		<ul>
			<?php
			/* Widgetized sidebar, if you have the plugin installed. */
			if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar() ) :
				?>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2><?php _e( 'Author' ); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

				<?php
				if ( is_404() || is_category() || is_day() || is_month() ||
				is_year() || is_search() || is_paged() ) :
					?>
			<li>

					<?php if ( is_404() ) : /* If this is a 404 page */ ?>
			<?php elseif ( is_category() ) : /* If this is a category archive */ ?>
				<p>
				<?php
					printf(
						/* translators: %s: Category name. */
						__( 'You are currently browsing the archives for the %s category.' ),
						single_cat_title( '', false )
					);
				?>
				</p>

			<?php elseif ( is_day() ) : /* If this is a daily archive */ ?>
				<p>
				<?php
					printf(
						/* translators: 1: Site link, 2: Archive date. */
						__( 'You are currently browsing the %1$s blog archives for the day %2$s.' ),
						sprintf( '<a href="%1$s/">%2$s</a>', get_bloginfo( 'url' ), get_bloginfo( 'name' ) ),
						get_the_time( __( 'l, F jS, Y' ) )
					);
				?>
				</p>

			<?php elseif ( is_month() ) : /* If this is a monthly archive */ ?>
				<p>
				<?php
					printf(
						/* translators: 1: Site link, 2: Archive month. */
						__( 'You are currently browsing the %1$s blog archives for %2$s.' ),
						sprintf( '<a href="%1$s/">%2$s</a>', get_bloginfo( 'url' ), get_bloginfo( 'name' ) ),
						get_the_time( __( 'F, Y' ) )
					);
				?>
				</p>

			<?php elseif ( is_year() ) : /* If this is a yearly archive */ ?>
				<p>
				<?php
					printf(
						/* translators: 1: Site link, 2: Archive year. */
						__( 'You are currently browsing the %1$s blog archives for the year %2$s.' ),
						sprintf( '<a href="%1$s/">%2$s</a>', get_bloginfo( 'url' ), get_bloginfo( 'name' ) ),
						get_the_time( 'Y' )
					);
				?>
				</p>

			<?php elseif ( is_search() ) : /* If this is a search result */ ?>
				<p>
				<?php
					printf(
						/* translators: 1: Site link, 2: Search query. */
						__( 'You have searched the %1$s blog archives for <strong>&#8216;%2$s&#8217;</strong>. If you are unable to find anything in these search results, you can try one of these links.' ),
						sprintf( '<a href="%1$s/">%2$s</a>', get_bloginfo( 'url' ), get_bloginfo( 'name' ) ),
						esc_html( get_search_query() )
					);
				?>
				</p>

			<?php elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) : /* If this set is paginated */ ?>
				<p>
				<?php
					printf(
						/* translators: %s: Site link. */
						__( 'You are currently browsing the %s blog archives.' ),
						sprintf( '<a href="%1$s/">%2$s</a>', get_bloginfo( 'url' ), get_bloginfo( 'name' ) )
					);
				?>
				</p>

			<?php endif; ?>

			</li>
			<?php endif; ?>
		</ul>

		<?php if ( is_home() || is_page() ) { /* If this is the frontpage */ ?>
			<?php wp_list_bookmarks(); ?>

		<li><h2><?php _e( 'Meta' ); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
		</li>
	<?php } ?>

	<?php endif; /* ! dynamic_sidebar() */ ?>

	</div>

	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
		<div class="site-info">
			<?php $blog_info = get_bloginfo( 'name' ); ?>
			<?php if ( ! empty( $blog_info ) ) : ?>
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
			<?php endif; ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentynineteen' ) ); ?>" class="imprint">
				<?php
				/* translators: %s: WordPress. */
				printf( __( 'Proudly powered by %s.', 'twentynineteen' ), 'WordPress' );
				?>
			</a>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
			?>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'twentynineteen' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav><!-- .footer-navigation -->
			<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


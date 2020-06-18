<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version.
 */
?>
	<header id="masthead" class="site-header">

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

	<div id="patch-sidebar-search-form" class="patch-sidebar-search-form", role="complementary">
		<?php
			get_search_form();
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
		</ul>

	<?php endif; /* ! dynamic_sidebar() */ ?>

	</div>

	<div id="patch-sidebar-mix" class="patch-sidebar-mix", role="complementary"><ul>
		<?php twentynineteen_mix_list(); ?>
	</ul></div>

	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
		<div class="site-account">
			<ul class="site-account-list">
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div>

		<div class="site-info">
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


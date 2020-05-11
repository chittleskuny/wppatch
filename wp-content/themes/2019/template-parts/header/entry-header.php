<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null; ?>

<?php
/* translators: Used between list items, there is a space after the comma. */
$categories_list = get_the_category_list( __( ', ', 'twentynineteen' ) );
if ( $categories_list ) {
	printf(
		/* translators: 1: SVG icon. 2: Posted in label, only visible to screen readers. 3: List of categories. 4: Number. */
		'<span class="cat-links">%1$s<span class="screen-reader-text"> %2$s</span> %3$s</span> %4$s</span>',
		twentynineteen_get_icon_svg( 'archive', 16 ),
		__( 'Posted in', 'twentynineteen' ),
		$categories_list,
		get_post_meta( get_the_ID(), 'number', true )
	); // WPCS: XSS OK.
}
the_title( '<h1 class="entry-title">', '</h1>' );
?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			twentynineteen_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php twentynineteen_comment_count(); ?>
	</span>
</div><!-- .entry-meta -->
<?php endif; ?>

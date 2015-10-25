<?php
/**
 * Template for RNS specific Test Category archive page only
 *
 */
get_header();

global $tags, $paged, $post, $shown_ids;

$title = single_cat_title('', false);
$description = category_description();
$rss_link = get_category_feed_link(get_queried_object_id());
$posts_term = of_get_option('posts_term_plural', 'Stories');
?>

<div class="clearfix">
	<header class="archive-background clearfix">
		<a class="rss-link rss-subscribe-link" href="<?php echo $rss_link; ?>"><?php echo __( 'Subscribe', 'largo' ); ?> <i class="icon-rss"></i></a>
		<h1 class="page-title"><?php echo $title; ?></h1>
		<div class="archive-description"><?php echo $description; ?></div>
		<?php get_template_part('partials/archive', 'category-related'); ?>
	</header>

	<?php if ( $paged < 2 && of_get_option('hide_category_featured') == '0' ) {
		$featured_posts = largo_get_featured_posts_in_category( $wp_query->query_vars['category_name'] );
		if ( count( $featured_posts ) > 0 ) {
			$top_featured = $featured_posts[0];
			$shown_ids[] = $top_featured->ID; ?>

			<div class="primary-featured-post">
				<?php largo_render_template(
					'partials/archive',
					'category-primary-feature',
					array( 'featured_post' => $top_featured )
				); ?>
			</div>

			<?php $secondary_featured = array_slice($featured_posts, 1);
			if ( count($secondary_featured) > 0 ) { ?>
				<div class="secondary-featured-post">
					<div class="row-fluid clearfix"><?php
						foreach ( $secondary_featured as $idx => $featured_post ) {
								$shown_ids[] = $featured_post->ID;
								largo_render_template(
									'partials/archive',
									'category-secondary-feature',
									array( 'featured_post' => $featured_post )
								);
						} ?>
					</div>
				</div>
		<?php }
	}
} ?>
</div>

<div class="row-fluid clearfix">
	<div class="stories span8" role="main" id="content">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				//$shown_ids[] = get_the_ID();
				get_template_part( 'partials/content', 'archive' );
			}
			largo_content_nav( 'nav-below' );
		} else {
			get_template_part( 'partials/content', 'not-found' );
		} ?>
	</div>
	<?php

	if ((is_single() || is_singular()) && !largo_is_sidebar_required())
		return;

	$showey_hidey_class = (of_get_option('showey-hidey'))? 'showey-hidey':'';
	$span_class = largo_sidebar_span_class();

	do_action('largo_before_sidebar'); ?>
	<aside id="sidebar" class="<?php echo $span_class; ?> nocontent">
		<?php do_action('largo_before_sidebar_content'); ?>
		<div class="widget-area <?php echo $showey_hidey_class ?>" role="complementary">
			<?php
				do_action('largo_before_sidebar_widgets');

				if (is_archive() && !is_date())
					get_template_part('partials/sidebar', 'archive');
				else if (is_single() || is_singular())
					get_template_part('partials/sidebar', 'single');
				else
					get_template_part('partials/sidebar');

				do_action('largo_after_sidebar_widgets');
			?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('test_cat_arch') ) : 

			endif; ?>
		</div>
		<?php do_action('largo_after_sidebar_content'); ?>
	</aside>
	<?php do_action('largo_after_sidebar'); ?>

	
	
</div>

<?php get_footer(); ?>

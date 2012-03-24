<?php get_header(); ?>

<?php get_sidebar(); ?>

<?php get_template_part( 'loop', 'page' ); 
/* echo get_post_meta(get_the_ID(), 'wp_custom_attachment', true); */ ?>
	
<?php get_footer(); ?>
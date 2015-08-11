<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	
	<body <?php body_class('fuelux'); ?> >
		<?php get_template_part('templates/menu'); ?>
        <div style=" height: 50px"></div>
        <?php get_template_part('templates/header');?>
		<?php get_template_part('templates/page'); ?> 
		
		
		<?php 	
		$args = array( 
				'post_type' => 'footer_section', 
			);
		
		$loop = new WP_Query( $args );
		
	    while ( $loop->have_posts() ) : 
			$loop->the_post();

	 	?>
	 		<?php get_template_part('templates/footer'); ?>
	 	<?php endwhile; ?> 
	</body>
</html>
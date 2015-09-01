<?php if(is_home() || is_front_page()) : ?>
	<?php 	
		$args = array( 
				'post_type' => 'nimbus_home_section', 
				'orderby'  => 'meta_value_num', 
				'order'     => 'ASC',
				'meta_key'  => '_nimbus_home_section_position_meta_key'
			);
		
		$loop = new WP_Query( $args );
		
	    while ( $loop->have_posts() ) : 
			$loop->the_post();
			$meta  = get_post_meta($loop->post->ID);
			$class = 'section' . isset($meta['_nimbus_home_section_class_meta_key'][0])? $meta['_nimbus_home_section_class_meta_key'][0] : "" ; 
			$style = isset($meta['_nimbus_home_section_bg_img_meta_key'][0])? "asfd" : "";
	 ?>
	 	<section class="section <?php echo $class ?>" id="section-<?php the_ID(); ?>">
	 		<div class="container">
	 			<div class="page-header">
	 				<div class="text-center">
	 					<h2><?php the_title(); ?></h2>
	 				</div>
	 			</div>
  				<?php the_content(); ?>
	 		</div>
	 	</section>
	 <?php endwhile; ?>
<!-- Define la vista para una página simple -->
<?php elseif(is_page()) : ?>
		<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p><?php the_content('Read more...'); ?></p>
			<p class="postmetadata after">
			<?php edit_post_link(__('Edit this entry' ), '<br /><span class="edit_link">',' &raquo;</span>'); ?>
			</p>
			</div> <!-- #post-n -->
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</div>
<?php endif; ?>
<!-- Define el encabezado cuando es el home o front page -->
<?php if(is_home() || is_front_page()) :  ?><!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<!--<a class="navbar-brand scroll" href="#top">Intermodalexpress</a>-->
			<img src="wp-content/uploads/2015/08/nav_intermodal.png" width="80%" height="80%" style="margin-top: 5px;"/>
			<!--<img src="wp-content/uploads/sites/5/2015/08/logo-intermodalexpress.png" width="30%" height="20%" style="margin-top: 5px;"/>-->
		</div>
		<div class="collapse navbar-collapse">
			<?php
				wp_nav_menu(array(
					'theme_location'  => 'nimbus_nav_menu_home',
					'menu' 			  => '',
					'container'		  => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav navbar-nav navbar-right',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => new nimbus_walker_nav_menu_home()
				));
			?>
		</div><!-- .collapse navbar-collapse -->
	</div><!-- .container-fluid -->
</nav>

<!-- Define el encabezado cuando es cualquier otra página -->
<?php elseif(is_page()) : ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<!--<a class="navbar-brand scroll" href="#top">Intermodalexpress</a>-->
			<img src="wp-content/uploads/2015/08/nav_intermodal.png" width="80%" height="80%" style="margin-top: 5px;"/>
			<!--<img src="wp-content/uploads/sites/5/2015/08/logo-intermodalexpress.png" width="30%" height="20%" style="margin-top: 5px;"/>-->
		</div>
		<div class="collapse navbar-collapse">
			<?php
				wp_nav_menu(array(
					'theme_location'  => 'nimbus_nav_menu_page',
					'menu' 			  => '',
					'container'		  => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav navbar-nav navbar-right',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => new nimbus_walker_nav_menu_home()
				));
			?>
		</div><!-- .collapse navbar-collapse -->
	</div><!-- .container-fluid -->
</nav>
<!-- Define el encabezado para una página de ERROR 404 -->
<?php elseif(is_404()) : ?>
    <h2>ERROR 404</h2>	
	<p>NO SE ENCONTRO LA PÁGINA...</p>	
<?php endif; ?>
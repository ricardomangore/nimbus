<!-- Define el encabezado cuando es el home o front page -->
<?php if(is_home() || is_front_page()) :  ?><!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
<<<<<<< HEAD
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
=======
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
>>>>>>> master
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
<<<<<<< HEAD
	      <a class="navbar-brand" href="#" style="padding: 3px 0px 0px 0px"><img src="http://intermodalexpress.com.mx/wp-content/uploads/2015/08/nav_intermodal.png"/></a>
		</div><!-- navbar-header -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
=======
			<!--<a class="navbar-brand scroll" href="#top">Intermodalexpress</a>-->
			<img src="http://intermodalexpress.com.mx/wp-content/uploads/2015/08/nav_intermodal.png" width="80%" height="80%" style="margin-top: 5px;"/>
			<!--<img src="wp-content/uploads/sites/5/2015/08/logo-intermodalexpress.png" width="30%" height="20%" style="margin-top: 5px;"/>-->
		</div>
		<div class="collapse navbar-collapse">
>>>>>>> master
			<p class="navbar-text" style="font-size: 18px"><a href="tel:+525556831500"><span class="glyphicon glyphicon-earphone"></span> (55) 56 83 15 00</a></p>
			<p class="navbar-text" style="font-size: 18px"><a href="mailto:info@intermodalexpress.com.mx"><span class="glyphicon glyphicon-envelope"></span>  info@intermodalexpress.com.mx</a></p>
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
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#" style="padding: 3px 0px 0px 0px"><img src="http://intermodalexpress.com.mx/wp-content/uploads/2015/08/nav_intermodal.png"/></a>
		</div><!-- navbar-header -->
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
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=1000"/>
	
	<title><?php bloginfo('name'); ?>  <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/foundation.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.collapse.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/easing.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.ui.totop.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/app.js"></script>
	
	
    <script src="<?php bloginfo('template_url'); ?>/js/json2.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/underscore-min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/backbone-min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/backbone-forms.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/Backbone.ModalDialog.js" type="text/javascript"></script>

	<script src="<?php bloginfo('template_url'); ?>/js/jquery-ui-editors.js" type="text/javascript"></script>
	
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.ui.widget.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.iframe-transport.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.fileupload.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/form.js" type="text/javascript"></script> 


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(qtrans_getLanguage()=='en') { ?>
<div class="container">
<div class="row">
	<div class="twelve columns header">
    	<div class="language">
			<a class="dieciocho-populaire" href="http://kandor.d3s.es">Spanish Version ></a>
		</div>
		<div class="logo">
		<a href="http://kandor.d3s.es/en" alt="Kandor Graphics"><img src="http://kandor.d3s.es/images/logo.png" alt="Kandor Graphics"/></a>
		</div>
		<div class="menu">
			<div class="cabecera">
				<h5>A place where animation takes shape</h5>
			</div>
			<ul>
				<li><a href="http://kandor.d3s.es/en/history" tittle="Company">company</a></li>
				<li><a href="http://kandor.d3s.es/en/projects" alt="Projects">projects</a></li>
				<li><a href="http://kandor.d3s.es/en/video-channel" alt="Video channel">video channel</a></li>
				<li><a href="http://kandor.d3s.es/en/offers" alt="employment">employment</a></li>
				<li><a href="http://kandor.d3s.es/en/contact" alt="Contact">contact</a></li>
			</ul>
		</div>
	</div>
</div>

<?php } elseif(qtrans_getLanguage()=='es') { ?>

<div class="container">
<div class="row">
	<div class="twelve columns header">
    	<div class="language">
			<a class="dieciocho-populaire" href="http://kandor.d3s.es/en">English Version ></a>
		</div>
		<div class="logo">
			<a href="http://kandor.d3s.es" alt="Kandor Graphics"><img src="http://kandor.d3s.es/images/logo.png" alt="Kandor Graphics"/></a>
		</div>
		<div class="menu">
			<div class="cabecera">
				<h5>A place where animation takes shape</h5>
			</div>
			<ul>
				<li><a href="http://kandor.d3s.es/historia/" tittle="Nosotros">compa&ntilde;&iacute;a</a></li>
				<li><a href="http://kandor.d3s.es/proyectos" alt="Proyectos">proyectos</a></li>
				<li><a href="http://kandor.d3s.es/canal-video" alt="Canal video">canal video</a></li>
				<li><a href="http://kandor.d3s.es/nuestro-compromiso" alt="Empleo">empleo</a></li>
				<li><a href="http://kandor.d3s.es/contacto" alt="Contacto">contacto</a></li>
			</ul>
		</div>
	</div>
</div>



<?php }?>
<!-- Begin Container -->


<!-- Main Row -->
<div class="row cuarenta-top">

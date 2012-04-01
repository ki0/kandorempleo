<script type="text/javascript">
	$(document).ready(function () {
		/* to top */
		$().UItoTop({ easingType: 'easeOutQuart' });
	});
</script>


<div class="nine columns">
		<h1><?php _e("<!--:en-->Press<!--:--><!--:es-->Empleo");?></h1>
		<div id="titular">	
            <div id="titulotop"><img src="http://kandor.d3s.es/images/RecuadroAzulArriba.png" width="700" height="20"></div>
            <div id="titular_txt">	
            	<?php _e("<!--:en--><p>In this section, you will find the most relevant news about KANDOR Graphics. A historical view of our trajectory seen from the outside.</p><!--:--><!--:es--><p>En KANDOR Graphics buscamos a gente creativa, con talento, resolutiva y eficiente. Profesionales con ganas de progresar y que se comprometan con su trabajo.</p>");?>
			</div>
			<div id="titulobottom"><img src="http://kandor.d3s.es/images/RecuadroAzulAbajo.png" width="700" height="21"></div>
		</div>

<?php if(qtrans_getLanguage()=='en') { ?>
<div class="row">
<div class="nine columns cuarenta-top">			
	<p>If you wish to contact our Press department, you may do so at: <spam style="text-decoration:underline;"><a href=mailto:"press@kandorgraphics.com">press@kandorgraphics.com <img src="/images/icoSobre.png"></a></spam></p>
</div>
</div>
<?php } elseif(qtrans_getLanguage()=='es') { ?>
<div class="row">
<div class="nine columns cuarenta-top">			
	<p>Si te sientes identificado con esos valores, selecciona una o varias de las ofertas disponibles que aparecen a continuaci&oacute;n  y te incluiremos en el proceso de selecci&oacute;n.</p>
</div>
</div>
<?php }?>

<div class="row">		
	<div class="nine columns cuarenta-top">
		<dl class="nice contained tabs">
			<dd><a href="#perfil-artistico-tecnico" class="active-empleo">perfil art&iacute;stico y t&eacute;cnico</a></dd>
			<dd><a href="#otros-perfiles">otros perfiles</a></dd>
		</dl>

	<ul class="nice tabs-content contained">
		<li class="active-empleo" id="perfil-artistico-tecnicoTab"> <!-- perfil artistico tecnico -->
			<?php $count_posts = wp_count_posts( 'ofertas' )->publish;?> <!-- /numero de ofertar publicadas/ -->
			
			<div class="row" id="mostrar">
				<div class="demo-1">
					<p><strong>Mostrando un total de <?php echo $count_posts;?> ofertas laborales de perfil art&iacute;stico y t&eacute;cnico.</strong></br>
				</p>
				Puedes filtrar los resultados por <span class="filter sub-italic">habilidades requeridas</span>
				<div id="filtro">
					<div class="habilidad">
				<div class="titulo-habilidad">Habilidades art&iacute;sticas</div>
				<hr class="negro">
			<?php 
				$terms = get_terms("habilidad-artistica");
				$count = count($terms);
					if ( $count > 0 ){
		   			echo "<ul>";
		    		foreach ( $terms as $term ) {
			?>
				<?php echo "<div class=items>"; ?>
				<input class="habilidades" type="checkbox" value="<?php echo $term->term_id;?>" id="<?php echo $term->slug;?>">
					<?php echo $term->name;?> 
					<?php echo "</div>"; ?>
            <?php } echo "</ul>";
			}?>
			</div>
			
			<div class="habilidad">
				<div class="titulo-habilidad">Habilidades t&eacute;cnicas</div>
				<hr class="negro">
			<?php 
				$terms = get_terms("habilidad-tecnica");
				$count = count($terms);
					if ( $count > 0 ){
		   			echo "<ul>";
		    		foreach ( $terms as $term ) {
			?>
			<?php $slug = $term->slug;?>
			<?php echo "<div class=items>"; ?>
			<input class="habilidades" type="checkbox" value="<?php echo $term->term_id;?>" id="<?php echo $term->slug;?>">
				<?php echo $term->name;?>
				<?php echo "</div>"; ?>
            <?php		
            		
            		}
		   			echo "</ul>";
					}
			?>
			</div>

			<div class="habilidad">
				<div class="titulo-habilidad">Manejo de Software</div>
				<hr class="negro">
			<?php 
				$terms = get_terms("habilidad-software");
				$count = count($terms);
					if ( $count > 0 ){
		   			echo "<ul>";
		    		foreach ( $terms as $term ) {
			?>

			<?php echo "<div class=items>"; ?>
			<input class="habilidades" type="checkbox" value="<?php echo $term->term_id;?>" id="<?php echo $term->slug;?>">
				<?php echo $term->name;?> 
				<?php echo "</div>"; ?>
            <?php		
            		
            		}
		   			echo "</ul>";
					}
			?>
			</div>
			
			<div class="row">
				<div class="two columns float-right" id="filtrar">
					<a class="nice radius blue button full-width" id="filter">filtrar</a>
				</div>
			</div>	

				</div>
			</div>
			
			<div class="row" id="seleccionar">
				<p>Seleccionar <img src="<?php bloginfo('template_url');?>/images/seleccionar.png" style="vertical-align:bottom;padding-left: 10px;"></p>
			</div>
			
  			<?php query_posts( array( 'post_type' => 'ofertas', 'perfil' => 'artistico-y-tecnico' ) );?>
  			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<? $slug = basename(get_permalink());?>
			
			<?php  
			$taxo_text = "";  
			$tipos_list = get_the_term_list( $post->ID, 'departamento', '', ' / ', '' );
			?>
			
			<article>
					<div class="demo-2">
						<input class="float-right" type="checkbox" value="<?php the_id();?>" id="<?php echo $slug?>">	
						<div class="oferta"><?php the_title();?></div>
						<span class="departamento"><?php echo strip_tags($tipos_list);?></span>
						<div class="prueba">
							<?php the_content(); ?>
						</div>
					</div>
			</article>
		
			<?php endwhile; wp_reset_query(); else: ?>
		
			<p>Sorry, no posts matched your criteria.</p>
	
			<?php endif; ?>
	
			<!-- Begin Pagination -->
			<?php if (function_exists("emm_paginate")) {
	    	emm_paginate();
			} ?>	        	
			<!-- End Pagination -->
		</li>
  
  		<li id="otros-perfilesTab"><!-- otros perfiles -->
  		
  		<div id="content-main">

		<?php
		$args = array(
			"perfil" => 'otros',
			'post_type' => 'ofertas',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'caller_get_posts'=> 1
		);
	
		$my_query = null;
		$my_query = new WP_Query($args);

		if( $my_query->have_posts() ) : ?>
		
		<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		
		<article>
			<div class="demo-2">
				<input class="float-right" type="checkbox" value="<?php the_id();?>" id="<?php echo $slug?>">	
				<div class="oferta"><?php the_title();?></div>
				<span class="departamento"><?php echo strip_tags($tipos_list);?></span>
				<div class="prueba">
					<?php the_content(); ?>
				</div>
			</div>
		</article>

		<?php endwhile; // end of loop ?>

		<?php else : ?>
<p>Lo sentimos, pero no tenemos procesos de selecci&oacute;n abiertos para Otros Perfiles.</p>
<p>Si est&aacute;s interesado en puestos <strong>Administrativos, Comerciales, Marketing, RRHH, Producci&oacute;n, Finanzas, IT, </strong>etc... puedes inscribirte en nuestra <a href="<?php bloginfo('url');?>/bolsadeempleo" id="bolsadeempleo2">Bolsa de Empleo</a> y en cuanto surja una oferta que se ajuste a tu perfil te incluiremos en el proceso de selecci&oacute;n.</p>
		<?php endif; // if have_posts()
		wp_reset_query();
		?>
  			
		</li>
	</ul>
	<div class="row cuarenta-top">
		<div class="five columns">
			<p class="selecciona"><strong>Selecciona las ofertas de la lista y</strong></p>
		</div>
		<div class="four columns" id="volver">
			<a class="nice radius blue button float-right full-width" id="form">solicita estos puestos </a>
		</div>
	</div>
	<div class="row cuarenta-top">
<p><strong>&iquest;No has encontrado ninguna oferta que se ajuste a tu perfil?</strong></p>
<p>No te preocupes en KANDOR Graphics estamos continuamente buscando nuevos talentos para nuestros proyectos. <span class="sub-italic"><a href="<?php bloginfo('url');?>/bolsadeempleo" id="bolsadeempleo1">Inscr&iacute;bete en nuestra Bolsa de Empleo</a></span> y en cuanto surja una oferta que se ajuste a tu perfil te incluiremos en el proceso de selecci&oacute;n.</p>

<p>Si deseas estar informado acerca de nuestras ofertas de empleo <span class="sub-italic"><a href="<?php bloginfo('rss2_url');?>">suscr&iacute;bete a esta lista</a></span> y estar&aacute;s siempre al tanto de nuestros procesos de selecci&oacute;n.</p>
</div>



</div>
</div>
</div>

<script type="text/javascript">
$('#form').bind("click", function(){
    var str = '/kandor/empleo/formulario?';
    $('input.float-right').each(function(i, item){
        if (this.checked){
            str += "id" + i + "=" + item.value + "&" + "name" + i + "=" + item.id + "&"
        }
    });
    console.log(str);
    if (str != '/kandor/empleo/formulario?') {
        str = str.substring(0, str.length - 1);
        console.log(str);
        jQuery.fancybox({
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 200,
            'speedOut': 200,
            'width': 680,
            'height':620,
            'type': 'iframe',
            'href': str 
        });
    }
});
</script>

<script type="text/javascript">
$('#filter').bind("click", function(){
    var str = '/kandor/empleo/?s=';
    $('input.habilidades').each(function(i, item){
        if (this.checked){
            str += "id" + i + "=" + item.value + "&" + "name" + i + "=" + item.id + "&"
        }
    });
    console.log(str);
     if (str != '/kandor/empleo/formulario?') {
        str = str.substring(0, str.length - 1);
        console.log(str);
        jQuery.fancybox({
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 200,
            'speedOut': 200,
            'width': 680,
            'height':620,
            'type': 'iframe',
            'href': str 
        });
    }

});
</script>

<script type="text/javascript">
$(".demo-2").collapse({show: function(){
	        this.animate({
	            opacity: 'toggle',
	            height: 'toggle'
	        }, 300);
	    },
	    hide : function() {
			this.animate({
	            opacity: 'toggle', 
	            height: 'toggle'
	        }, 300);
	    }
	});
</script>

<script type="text/javascript">
$(".demo-1").collapse({show: function(){
	        this.animate({
	            opacity: 'toggle',
	            height: 'toggle'
	        }, 300);
	    },
	    hide : function() {
			this.animate({
	            opacity: 'toggle', 
	            height: 'toggle'
	        }, 300);
	    }
	});
</script>

</script>
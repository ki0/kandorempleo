<script type="text/javascript">
	$(document).ready(function () {
		/* to top */
		$().UItoTop({ easingType: 'easeOutQuart' });
	});
</script>

	<script src="<?php bloginfo('template_url'); ?>/js/form1.js" type="text/javascript"></script>

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
			<dd><a href="" class="active-empleo">perfil art&iacute;stico y t&eacute;cnico</a></dd>
			<dd><a href="#nice2">otros perfiles </a></dd>
		</dl>

	<ul class="nice tabs-content contained">
		<li class="active-empleo" id="perfin-artistico-tecnico"> <!-- perfil artistico tecnico -->
			<?php $count_posts = wp_count_posts( 'ofertas' )->publish;?> <!-- /numero de ofertar publicadas/ -->
			
			<div class="row" id="mostrar">
				<div class="demo-1">
				<p><strong>Mostrando un total de <?php echo $count_posts;?> ofertas laborales de perfil art&iacute;stico y t&eacute;cnico.</strong></br>
				</p>
				<span class="flecha">Puedes filtrar los resultados por habilidades requeridas <img src="<?php bloginfo('template_url');?>/images/empleo-flecha-filtro.png"></span>

				
				<div id="filtro">
				<div class="habilidad">
					<p>Habilidades art&iacute;sticas</p>
					<hr class="negro">
				<?php 
					$terms = get_terms("habilidad-artistica");
					$count = count($terms);
						if ( $count > 0 ){
			   			echo "<ul>";
			    		foreach ( $terms as $term ) {
				?>
					<?php echo "<div class=items>"; ?>
					<input type="checkbox" value="" id="">
 					<?php echo $term->name;?> 
 					<?php echo "</div>"; ?>
                <?php } echo "</ul>";
				}?>
				</div>
				
				<div class="habilidad">
					<p>Habilidades t&eacute;cnicas</p>
					<hr class="negro">
				<?php 
					$terms = get_terms("habilidad-tecnica");
					$count = count($terms);
						if ( $count > 0 ){
			   			echo "<ul>";
			    		foreach ( $terms as $term ) {
				?>

				<?php echo "<div class=items>"; ?>
				<input type="checkbox" value="" id="">
 				<?php echo '<a href="'.get_term_link($term->slug, 'habilidad-tecnica').'">'.$term->name.'</a>'?> 
 				<?php echo "</div>"; ?>
                <?php		
                		
                		}
			   			echo "</ul>";
						}
				?>
				</div>

				<div class="habilidad">
					<p>Manejo de Software</p>
					<hr class="negro">
				<?php 
					$terms = get_terms("habilidad-software");
					$count = count($terms);
						if ( $count > 0 ){
			   			echo "<ul>";
			    		foreach ( $terms as $term ) {
				?>

				<?php echo "<div class=items>"; ?>
				<input type="checkbox" value="" id="">
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
						<a class="nice radius blue button full-width" href="#" id="">filtrar</a>
					</div>
				</div>
				
				</div>
			</div>
			
			</div> <!-- demo-1 -->
			
  			<?php query_posts( array( 'post_type' => 'ofertas', 'perfiles' => 'artistico-y-tecnico' ) );?>
  			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- Begin the first article -->
			<?php  
				/* $taxo_text = "";   */
				/* $tipos_list = get_the_term_list( $post->ID, 'departamento', '', ' / ', '' ); */
				/* echo $tipos_list; */
			?>
			<? $slug = basename(get_permalink()); ?>
			<?php  
			$taxo_text = "";  
			$tipos_list = get_the_term_list( $post->ID, 'departamento', '', ' / ', '' );
			?>
			<article>
					<div class="demo-2">
						<span class="oferta"><?php the_title();?> <span class="departamento"><?php echo strip_tags($tipos_list);?></span>
							<input class="float-right" type="checkbox" value="" id="">
							<hr>
						</span>
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
  
  		<li id="nice2Tab"><!-- otros perfiles -->
  			
  		<p>Lo sentimos, pero no tenemos procesos de selecci&oacute;n abiertos para Otros Perfiles.</p>
		<p>Si est&aacute;s interesado en puestos <strong>Administrativos, Comerciales, Marketing, RRHH, Producci&oacute;n, Finanzas, IT, </strong>etc... puedes inscribirte en nuestra <a href="#" id="windowModal2">Bolsa de Empleo</a> y en cuanto surja una oferta que se ajuste a tu perfil te incluiremos en el proceso de selecci&oacute;n.</p>
  			
		</li>
	</ul>
	<div class="row cuarenta-top">
	<div class="five columns">
		<p class="selecciona"><strong>Selecciona las ofertas de la lista y</strong></p>
	</div>
	<div class="four columns" id="volver">
		<a class="nice radius blue button float-right full-width" href="#" id="windowModal1">solicita estos puestos</a>
	</div>
	</div>
	<div class="row cuarenta-top">
<p><strong>&iquest;No has encontrado ninguna oferta que se ajuste a tu perfil?</strong></p>
<p>No te preocupes en KANDOR Graphics estamos continuamente buscando nuevos talentos para nuestros proyectos. Inscr&iacute;bete en nuestra
<a href="#" id="windowModal3">Bolsa de Empleo</a> y en cuanto surja una oferta que se ajuste a tu perfil te incluiremos en el proceso de selecci&oacute;n.</p>

<p>Si deseas estar informado acerca de nuestras ofertas de empleo suscr&iacute;bete a esta lista y estar&aacute;s siempre al tanto de nuestros procesos de selecci&oacute;n.</p>
</div>



</div>
</div>
</div>


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

<script type="text/javascript">
$(document).ready(
    function(){
    $('#windowModal1').click(function(event) {

		$('html, body').animate({ scrollTop: 0 }, 'slow');
		
		event.preventDefault();
        event.stopPropagation();
		
		var view = new ModalFormView1();
        view.render().showModal({
            y: 20,
            localWidth: 780
        });

    });     
});

$(document).ready(
    function(){
    $('#windowModal2').click(function(event) {
    
		$('html, body').animate({ scrollTop: 0 }, 'slow');		
		
		event.preventDefault();
        event.stopPropagation();
		
		var view = new ModalFormView2();
        view.render().showModal({
            y: 20,
            localWidth: 780
        });

    });     
});

$(document).ready(
    function(){
    $('#windowModal3').click(function(event) {
    
		$('html, body').animate({ scrollTop: 0 }, 'slow');		
		
		event.preventDefault();
        event.stopPropagation();
		
		var view = new ModalFormView2();
        view.render().showModal({
            y: 20,
            localWidth: 780
        });

    });     
});


</script>

<?php
	/*
	Template Name: form
	*/
	?>

<?php get_header(); ?>



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
							
							<?php 
							
							
							$term_list = get_the_terms($post->ID, 'habilidad-artistica');
							
							foreach ( $term_list as $term ) {
								echo "<div class=items>"; ?>
								<input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
								<?php echo $term->name;
								echo "</div>"; 
							}
							?>
							<?php 
							
							
							$term_list = get_the_terms($post->ID, 'habilidad-tecnica');
							
							foreach ( $term_list as $term ) {
								echo "<div class=items>"; ?>
								<input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
								<?php echo $term->name;
								echo "</div>"; 
							}
							?>	
							<?php 
							
							
							$term_list = get_the_terms($post->ID, 'habilidad-software');
							
							foreach ( $term_list as $term ) {
								echo "<div class=items>"; ?>
								<input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
								<?php echo $term->name;
								echo "</div>"; 
							}
							?>
							<?php gravity_form (1,false,false,false,'',true); ?>
						</div>
					</div>
			</article>
		
			<?php endwhile; wp_reset_query(); else: ?>
		
			<p>Sorry, no posts matched your criteria.</p>
	
			<?php endif; ?>

<?php get_footer(); ?>
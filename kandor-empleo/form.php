<?php
	/*
	Template Name: form
	*/
	?>

<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/javascripts/foundation.js"></script>
<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.collapse.js"></script>
	
        <div class="form-offers">
        
		<div class="puestos-info">			
			<p>Estas solicitando el puesto de <?php echo get_the_title($id);?> por tanto tus habilidades son:</p>
		</div>

		   <div class="skills" id="habilidades" style="display: block">
				<?php
                $term_list = array();
                $i = 0;
                foreach ( $_GET as $ids => $id ){
                    if ( $ids === ("id" . $i)) {
                        $aux = get_the_terms($id, 'habilidad-artistica');
                        if ( !empty($aux) ){
                            foreach ( $aux as $term ){
                                $terms_art[] = $term->name;
                            }
                            if (!empty( $terms_art ) && is_array( $terms_art )){
                                $term_list = array_unique(array_merge( $term_list, $terms_art ));
                            }
                        }

                        $aux = get_the_terms($id, 'habilidad-tecnica');
                        if ( !empty($aux) ){
                            foreach ( $aux as $term ){
                                $terms_tec[] = $term->name;
                            }
                            if (!empty( $terms_tec ) && is_array( $terms_tec )){
                                $term_list = array_unique(array_merge( $term_list, $terms_tec ));
                            }
                        }

                        $aux = get_the_terms($id, 'habilidad-software');
                        if ( !empty($aux) ){
                            foreach ( $aux as $term ){
                                $terms_soft[] = $term->name;
                            }
                            if (!empty( $terms_soft ) && is_array( $terms_soft )){
                                $term_list = array_unique(array_merge( $term_list, $terms_soft ));
                            }
                        }
                    $i = $i + 1;
                    }
                }
                foreach ( $term_list as $term => $name ){
                    echo "<div class=items>";?>
                    <input type="checkbox" checked="true" value="" id="<?php echo $name;?>">
                    <?php echo $name;
                    echo "</div>"; 
                }
                ?>
            </div>
		            
            <div class="demo-3">
            	<span class="more-skills active-ofertas">&iquest;Quieres a&ntilde;adir alguna habilidad m&aacute;s?</span>
				<?php gravity_form (1,false,false,false,'',true); ?>
			</div>
        
        </div>


<?php wp_footer(); ?>

<script type="text/javascript">
$('body').css({"background-color":"#FFF"});
</script>

<script type="text/javascript">
	jQuery('#gform_next_button_1_2').bind("click", function() {
	    jQuery('#habilidades').hide();
	    jQuery('.more-skills').hide();
	    jQuery('.puestos-info').hide();
	});
</script>

<script type="text/javascript">
$(".demo-3").collapse({show: function(){
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

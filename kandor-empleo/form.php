<?php
	/*
	Template Name: form
	*/
	?>

<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

<article>
        <div class="form-offers">
            <div class="skills" id="habilidades" style="display: block">
				<?php
                $i = 0;
                foreach ( $_GET as $ids => $id ){
                    if ( $ids === ("id" . $i)) {
                        $term_list = get_the_terms($id, 'habilidad-artistica');
                        foreach ( $term_list as $term ) {
                            echo "<div class=items>"; ?>
                            <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                            <?php echo $term->name;
                            echo "</div>"; 
                        }
                        $term_list = get_the_terms($id, 'habilidad-tecnica');
                        
                        foreach ( $term_list as $term ) {
                            echo "<div class=items>"; ?>
                            <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                            <?php echo $term->name;
                            echo "</div>"; 
                        }
                        $term_list = get_the_terms($id, 'habilidad-software');
                        
                        foreach ( $term_list as $term ) {
                            echo "<div class=items>"; ?>
                            <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                            <?php echo $term->name;
                            echo "</div>"; 
                        }
                    $i = $i + 1;
                    }
                }
                ?>
            </div>
            
            <?php gravity_form (1,false,false,false,'',true); ?>
            
        </div>
</article>


<?php wp_footer(); ?>
</body>
</html>

<script type="text/javascript">
jQuery('#gform_next_button_1_2').bind("click", function(){
    jQuery('#habilidades').hide();
});
</script>

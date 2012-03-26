<?php
	/*
	Template Name: form
	*/
	?>

<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

<?php $id = $_GET['id'];?>

<article>
        <div class="demo-2">
            <div class="prueba" id="habilidades" style="display: block">
                
                <?php 
                
                
                $term_list = get_the_terms($id, 'habilidad-artistica');
                
                foreach ( $term_list as $term ) {
                    echo "<div class=items>"; ?>
                    <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                    <?php echo $term->name;
                    echo "</div>"; 
                }
                ?>
                <?php 
                
                
                $term_list = get_the_terms($id, 'habilidad-tecnica');
                
                foreach ( $term_list as $term ) {
                    echo "<div class=items>"; ?>
                    <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                    <?php echo $term->name;
                    echo "</div>"; 
                }
                ?>	
                <?php 
                
                
                $term_list = get_the_terms($id, 'habilidad-software');
                
                foreach ( $term_list as $term ) {
                    echo "<div class=items>"; ?>
                    <input type="checkbox" checked="true" value="" id="<?php echo $term->name;?>">
                    <?php echo $term->name;
                    echo "</div>"; 
                }
                ?>
            </div>
            <?php gravity_form (1,false,false,false,'',true); ?>
        </div>
</article>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
<script type="text/javascript">
jQuery('#gform_next_button_1_2').bind("click", function(){
    jQuery('#habilidades').hide();
});
</script>

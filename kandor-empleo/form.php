<?php
	/*
	Template Name: form
	*/
	?>

<?php get_header(); ?>

<?php $id = $_GET['id'];?>

<article>
        <div class="demo-2">
            <div class="prueba">
                
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
                <?php gravity_form (1,false,false,false,'',true); ?>
            </div>
        </div>
</article>


<?php get_footer(); ?>

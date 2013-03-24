<?php
/*
Template Name: template-home
*/
?>

<?php echo ('<img src="'.get_template_directory_uri().'/images/tattoos_olympia.jpg" class="bg"/>'); ?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>            

        <div class="home_heading">

            <h1><?php the_field('heading'); ?></h1>

            <img src="<?php the_field('hero_image'); ?>" alt="" />

            <?php the_field('description'); ?>

        </div>

 
 
        <div class="home_heading_main">

            <h1><?php the_field('heading_main'); ?></h1>

            <?php the_content(); ?>

        </div>
        

 
        <div class="home_heading_aside">

            <?php the_field('aside'); ?>

        </div>         

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
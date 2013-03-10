<?php
/*
Template Name: template-artist
*/
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>    


       <!-- <div class="home_heading">

            <h1><?php the_field('heading'); ?></h1>

            <img src="<?php the_field('hero_image'); ?>" alt="" />

            <?php the_field('description'); ?>

        </div> -->
 
        <div class="artist_main">
			    <img src="<?php the_field('artist_image'); ?>" alt="" />
				<h1><?php the_field('name'); ?></h1>
				<?php the_field('contact'); ?>
        <?php the_content(); ?>
        </div>   

        <div class="artist_aside">
            <img src="<?php the_field('gallery_main'); ?>" alt="" />
            <div class="thumbnails">
            <img src="<?php the_field('thumbnail_1'); ?>" alt="" />
            <img src="<?php the_field('thumbnail_2'); ?>" alt="" />
            <img src="<?php the_field('thumbnail_3'); ?>" alt="" />
            <img src="<?php the_field('thumbnail_4'); ?>" alt="" />
            <img src="<?php the_field('thumbnail_5'); ?>" alt="" />
            </div>
        </div>

 

     

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
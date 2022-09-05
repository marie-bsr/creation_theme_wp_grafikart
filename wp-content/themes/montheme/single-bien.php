<?php get_header() ?>

<div class="container">
    <?php if (have_posts()) : ?>


        <?php while (have_posts()) : the_post(); ?>


            <h1><?php the_title() ?> </h1>
            

            <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
            <p><img src="<?php the_post_thumbnail_url() ?>" alt="" style="width: 100%"></p>
            
            <p class="card-text"><?php the_content() ?></p>

</div>



<?php endwhile; ?>

<?php else : ?>
<?php endif ?>



</div>

<?php get_footer() ?>
<?php get_header() ?>

<div class="container">
    <?php if (have_posts()) : ?>


        <?php while (have_posts()) : the_post(); ?>


            <h1><?php the_title() ?> </h1>


            <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
            <p><img src="<?php the_post_thumbnail_url() ?>" alt="" style="width: 60%"></p>

            <p class="card-text"><?php the_content() ?></p>
            <!--nouveau champ lié à au plugin ACF -->
            <p>
                Surface : <?= get_field('surface') ?> m2
            </p>

            <?php if (get_field('jardin') === true) : ?>

                <p>
                    Surface du jardin : <?= get_field('surface_jardin') ?> m2
                </p>
            <?php endif ?>





</div>



<?php endwhile; ?>

<?php else : ?>
<?php endif ?>



</div>

<?php get_footer() ?>
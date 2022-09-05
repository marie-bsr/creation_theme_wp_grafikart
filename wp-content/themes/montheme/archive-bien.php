<?php get_header() ?>

<div class="container text-center">
<h1>Voir tous nos biens</h1>
</div>

<div class="container">
    <?php if (have_posts()) : ?>
        <div class="row">

            <?php while (have_posts()) : the_post(); ?>
                <div class="col-sm-4">
                    <?php 
                  
                    get_template_part ('parts/card', 'post'); 
                    ?>
                    
                </div>

            <?php endwhile; ?>

        <?php else : ?>
            <h1>pas d'articles</h1>
        <?php endif ?>
       

        </div>
        
</div>
<div><?= paginate_links() ?></div>
<div><?= montheme_pagination() ?></div>
<?php wp_get_theme()->get_page_templates( ); ?>

<?php get_footer() ?>
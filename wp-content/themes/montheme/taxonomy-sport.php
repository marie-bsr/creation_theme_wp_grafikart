<?php get_header() ?>

<?php get_template_part ('parts/taxo-header'); ?>





<div class="container">
    <?php if (have_posts()) : ?>
        <div class="row">

            <?php while (have_posts()) : the_post(); ?>
                <div class="col-sm-4">
                    <?php 
                    //le contenu d'un post se trouve dans un fichier à part
                    //require ('parts/card.php'); 
                    //ci-dessous equivalent a require mais mieux pour wp
                    //get_template_part ('parts/card'); 
                    get_template_part ('parts/card', 'post'); //idem mais mieux, avec un style pour les articles, si card-post existe il l'utilise, sinon il utilise card.php
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
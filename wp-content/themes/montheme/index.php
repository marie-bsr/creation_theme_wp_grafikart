<?php get_header() ?>


<?php 
//affichage des taxonomies, sous forme de liste à puce. le 2eme param permet d'enlever le titre "categories"
wp_list_categories(['taxonomy' => 'sport', 'title_li' => '']); 

?>

<?php
//autre présentation, plus flexible avec get_terms
//var_dump(get_terms([ 'taxonomy' => 'sport']));
 $sports = get_terms(['taxonomy' => 'sport']); ?>
<?php if (is_array($sports)): ?>
<ul class="nav nav-pills my-4">
    <?php foreach($sports as $sport): ?>
    <li class="nav-item">
        <?php // is_tax: si on est sur la taxonomie sport, et sur cette taxonomie en particlulier (term_id) ajout d'une classe active ?>
        <a href="<?= get_term_link($sport) //affichage d'un lien cliquable ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif ?>



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
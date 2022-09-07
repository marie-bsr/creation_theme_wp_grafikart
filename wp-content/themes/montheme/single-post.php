<?php get_header() ?>

<div class="container">
    <?php if (have_posts()) : ?>


        <?php while (have_posts()) : the_post(); ?>


            <h1><?php the_title() ?> </h1>
            <h6> par <?php the_author() ?></h6>

            <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
            <p><img src="<?php the_post_thumbnail_url() ?>" alt="" style="width: 100%"></p>

            <p class="card-text"><?php the_content() ?></p>

            <h2>Articles relatifs</h2>
            <div class="row">
                <?php
                //on veut une variable $sports qui contient les valeurs liée à notre articles
//$sports = get_the_terms( get_post(), 'sport');
//var_dump($sports); die();
$sports = array_map(function($term){
    return $term->term_id;
}, get_the_terms(get_post(), 'sport'));

                $query = new WP_Query([
                    'post__not_in' => [get_the_id()], //l'article courant ne doit pas faire partie des articles relatifs
                    'post_type' => 'post', //on veut récupérer les articles uniquement
                    'posts_per_page' => 3,
                       'orderby' => 'rand', //ordre aléatoire
                       'tax_query' => [
                           [
                               'taxonomy' => 'sport',
                                  'field' =>' slug',
                               'terms' => $sports //on pourrait mettre 'football' ou 'tennis' mais ça ne serait pas dynamique,d 'ou l'usage des terms
                           ]
                       ]
                ]);
                //boucle classqiue
                while ($query->have_posts()) : $query->the_post();
                ?>
                    <div class="col-sm-4">
                        <?php get_template_part('parts/card', 'post'); ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
                //il faut réinitatiliser les choses car on les a écrasé (l'id des posts)
                ?>
            </div>


        <?php endwhile; ?>

    <?php else : ?>
    <?php endif ?>





</div>

<?php get_footer() ?>
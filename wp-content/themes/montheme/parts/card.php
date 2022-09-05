<div class="card ">
    <?php the_post_thumbnail('post-thumbnail', ['class ' => 'card-img-top ',  'alt' => '', 'style' => 'height:auto; ']) ?>

    <div class="card-body">
        <h5 class="card-title"><?php the_title() ?> </h5>
        <h6> par <?php the_author() ?></h6>
        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
        <h6 class="card-subtitle mb-2 text-muted"><?php the_terms(get_the_ID(), 'sport') ?></h6>
        <p class="card-text"><?php the_excerpt() ?></p>
        <a href="<?php the_permalink() ?>" class="btn btn-primary">Lire la suite</a>
    </div>
</div>
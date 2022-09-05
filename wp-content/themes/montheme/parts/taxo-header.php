<?php 
//recupere l'objet qui est la cible de notre requete
//var_dump(get_queried_object());

//esc_html permet d'échapper ce que saisi l'admin 

?>

<div class="container text-center">
<h1> <?= esc_html(get_queried_object()-> name)?> </h1>

<p> <?= esc_html(get_queried_object()-> description)?> </p>

</div>
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
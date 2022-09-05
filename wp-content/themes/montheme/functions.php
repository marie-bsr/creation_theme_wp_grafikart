<?php
//code executé à chaque chargement du theme
require get_template_directory() . '/walker.php'; //recuperation du walker
require_once('walker.php'); //idem


function montheme_register_assets()
{
    wp_enqueue_style('load_css', get_theme_file_uri('/style.css'));
    wp_enqueue_style('bootstrap-cdn-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-cdn-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', 'jquery', false, true);
   
    
    // wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') ); 
       
}


function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus'); //pour avoir un menu
    register_nav_menu('header', 'En tête du menu'); //pour avoir une barre de navigation
    register_nav_menu('footer', 'Pied de page');

    add_image_size('post-thumbnail', 350, 215, true); //permet de donner une taille qui nous convient , on utilise le nom post-thumbnail car il ets libre, mais on peut l'appeler comme on veut. on peut aussi remove_image_size('medium') pour suppr le format medium par example, puis réutiliser ce nom pour éviter d'avoir trop de formats différents car a chaque fois qu'on DL une img, elle se charge en x formats différents
    
}


function montheme_title_separator()
{
    return '|';
}

function montheme_menu_class()
{
    //var_dump(func_get_args());
   $classes[] = 'nav-item';
   return $classes;

}

function montheme_menu_link_class($attrs)
{
   
   $attrs['class'] = 'nav-link';
   return $attrs;

}

//pagination personnalisée avec le style bootstrap
function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function montheme_init(){
    register_taxonomy('sport', 'post', [
        'labels' =>[
            'name' => 'Sport', //nom utilisé dans l'admin
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true, //affiche la taxonomie dans l'aPI REST et dans l'éditeur de l'admin (a droite)
        'hierarchical' => true, // pour avoir des checkbox plutot que écrire un sport à la volée
        'show_admin_column' => true,
    ]); //nom de la taxonomie, elle s'applique aux articles, tableau de params


    //permet de créer un type de post customisé
    register_post_type('bien', [
        'label' => 'Biens',
        'public' => true, //gérable dans l'admin wp
        'menu_position' => 2, //au dessus des articles
        'menu_icon'   => 'dashicons-building', //icone de menu, à chercher dans dashicons wp
        'supports' => [ 'title', 'editor', 'thumbnail'],
        'show_in_rest' => true, //affiche la taxonomie dans l'aPI REST et dans l'éditeur de l'admin (a droite)
        'has_archive' => true,

    ]); 

}

//penser à refraichir les permaliens après création taxonomie

add_action('init', 'montheme_init'); //la chronologie a son importance
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_action('after_setup_theme', 'montheme_supports');

add_filter('document_title_separator', 'montheme_title_separator'); //on ajoute un filtre au document_title_separator via la fonction montheme_title_separator
add_filter('nav_menu_css_class', 'montheme_menu_class'); //transfo des elements de la navbar //KO
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class'); //KO


require_once('options/agence.php');

AgenceMenuPage::register();
<?php
//création d'un sous menu "Agence" dans la partie règlages de l'admin 

//ajout de js dan sl'admin:
// utilisation de la librairie flatpicker
// utilisation hook admin_enqueue_scripts avec en param une fonction qui importe les scripts de la librairie

class AgenceMenuPage{

    const GROUP = 'agence_options'; //nom de la page et du groupe

    public static function register(){
//quand le hook admin_menu est executé, on apelle la methode addMenu
        add_action('admin_menu', [self::class, 'addMenu' ]);
        add_action('admin_init', [self::class, 'registerSettings']);
        //permet d'ajouter du js dans l'admin de l'agence avec le hook admin_enqueue_scripts
        //admin_enqueue_scripts prend en param un suffix qui permet de filtrer et afficher les choses en fonction d'une certaine page
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    //ajout de JS pour utiliser flatpicker
    public static function registerScripts ($suffix) {
        //on ne veut ce js que sur la page admin de l'agence, faire un var_dump de get_current_screen  pour connaitre le nom de la page courrante
        if ($suffix === 'settings_page_agence_options') {
            //import du CSS (lien dans la page getting started de flatpicker)
            //params: clé, URL, pas de dependance; ps de version, dans le footer
            wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);
            //import du JS
            wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
            //lien avec le fichier de js admin.js qui se trouve dans assets . get_template_directory_uri() permet de recupérer l'url de notre template (faire un var_dump)
            wp_enqueue_script('montheme_admin', get_template_directory_uri() . '/assets/admin.js', ['flatpickr'], false, true);
            //enqueue du css
            wp_enqueue_style('flatpickr');
        }
    }

    //enregistre les paramètres
    public static function registerSettings () {
        register_setting(self::GROUP, 'agence_horaire', ['default' => '9h-17h']);
        register_setting(self::GROUP, 'agence_date');
        //permet d'administrer 
        add_settings_section('agence_options_section', 'Paramètres', function () {
            echo "Vous pouvez ici gérer les paramètres liés à l'agence immobilière";
        }, self::GROUP);
        //ajout des noms des champs et html associé
        add_settings_field('agence_options_horaire', "Horaires d'ouverture", function () {
            ?>
            <textarea name="agence_horaire" cols="30" rows="10" style="width: 100%"><?= esc_html(get_option('agence_horaire')) ?></textarea>
            <?php
        }, self::GROUP, 'agence_options_section');
        //ajout d'un champ pour choisr la date d'ouverture
        //mettre dans la value le nom de l'option enregistrée plus haut
        add_settings_field('agence_options_date', "Date d'ouverture", function () {
            ?>
            <input type="text" name="agence_date" value="<?= esc_attr(get_option('agence_date')) ?>" class="montheme_datepicker">
            <?php
        }, self::GROUP, 'agence_options_section');
    }


    public static function addMenu(){
        //params = titre de la page, titre dans l'admin, capabilities qu'il faut avoir pour l'utiliser ;slug de la page, fonction à appeler pour afficher contenu de cette page
add_options_page("Gestion de l'agence", "Agence", "manage_options", self::GROUP, [self::class, 'render']);
    }

    public static function render(){
       //gestion de l'affichage par une API

       ?>
       <h2>Gestion de l'agence</h2>
       <form action="options.php" method="post">
            <?php 
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP); //affichage des champs en paramètres
            submit_button();
            ?>
        </form>


       <?php

    }
}
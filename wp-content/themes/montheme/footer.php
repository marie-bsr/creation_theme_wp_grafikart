

<footer>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        
        
        <div class="collapse navbar-collapse" id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'navbar-nav mr-auto',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
    </div>
</nav>

</footer>
<div> <?= get_option('agence_horaire') ?></div>
  <?php wp_footer() ?>  
</body>
</html>
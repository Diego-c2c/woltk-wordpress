<?php
function woltk_portal_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menus([
        'primary' => 'Menu principal',
    ]);
}
add_action('after_setup_theme', 'woltk_portal_setup');

function woltk_portal_assets() {
    wp_enqueue_style('woltk-portal-style', get_stylesheet_uri(), [], '1.0');
    wp_enqueue_script('woltk-portal-theme', get_template_directory_uri() . '/assets/js/theme.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'woltk_portal_assets');

function woltk_portal_create_pages() {
    if (get_option('woltk_portal_pages_created')) {
        return;
    }

    $pages = [
        'Accueil' => ['slug' => 'accueil', 'template' => 'templates/page-accueil.php'],
        'Comment jouer' => ['slug' => 'comment-jouer', 'template' => 'templates/page-comment-jouer.php'],
        'Téléchargement' => ['slug' => 'telechargement', 'template' => 'templates/page-telechargement.php'],
        'Créer un compte' => ['slug' => 'creer-compte', 'template' => 'templates/page-creer-compte.php'],
        'Connexion' => ['slug' => 'connexion', 'template' => 'templates/page-connexion.php'],
    ];

    $created = [];

    foreach ($pages as $title => $cfg) {
        $existing = get_page_by_path($cfg['slug']);
        if ($existing) {
            $created[$title] = $existing->ID;
            continue;
        }

        $page_id = wp_insert_post([
            'post_title' => $title,
            'post_name' => $cfg['slug'],
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', $cfg['template']);
            $created[$title] = $page_id;
        }
    }

    if (!empty($created['Accueil'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created['Accueil']);
    }

    $menu_name = 'Menu principal';
    $menu = wp_get_nav_menu_object($menu_name);
    if (!$menu) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = $menu->term_id;
    }

    if (!empty($menu_id)) {
        foreach ($created as $title => $page_id) {
            $already = false;
            $items = wp_get_nav_menu_items($menu_id);
            if ($items) {
                foreach ($items as $item) {
                    if ((int) $item->object_id === (int) $page_id) {
                        $already = true;
                        break;
                    }
                }
            }

            if (!$already) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title' => $title,
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => $page_id,
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish',
                ]);
            }
        }

        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    update_option('woltk_portal_pages_created', 1);
}
add_action('after_switch_theme', 'woltk_portal_create_pages');

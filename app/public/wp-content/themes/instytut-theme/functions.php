<?php

function pageBanner($args = NULL)
{

    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }

    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['photo'])) {
        if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>
    </div>
<?php
}

function instytut_files()
{
    wp_enqueue_script('instytut_main_js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('font-awsome', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('custom-google-fonts', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('instytut_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('instytut_extra_styles', get_theme_file_uri('/build/index.css'));
}
add_action('wp_enqueue_scripts', "instytut_files");

function instytut_features()
{
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1300, 550, true);
}
add_action('after_setup_theme', 'instytut_features');

function instytut_adjust_queries($query)
{
    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }

    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'instytut_adjust_queries');

function my_nav_menu_active_class($classes, $item)
{
    // Check if we are on a single 'event' page
    if (is_singular('event')) {
        $event_archive_link = get_post_type_archive_link('event');
        if ($item->url === $event_archive_link) {
            $classes[] = 'current-menu-item';
        }
    }

    // Check if we are on a single 'program' page
    if (is_singular('program')) {
        $program_archive_link = get_post_type_archive_link('program');
        if ($item->url == $program_archive_link) {
            $classes[] = 'current-menu-item';
        }
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'my_nav_menu_active_class', 10, 2);

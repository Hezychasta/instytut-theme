<?php get_header();
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'See what is going on'
)); ?>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content', 'event');
    }
    echo paginate_links();
    ?>
    <hr class="section-break">
    <p>Looking for a recap of past events? <a href="<?php echo get_permalink(get_page_by_path('past-events')); ?>">Check out our Past Events page</a>.</p>
</div>
<?php get_footer(); ?>
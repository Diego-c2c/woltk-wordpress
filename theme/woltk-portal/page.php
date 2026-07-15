<?php get_header(); ?>
<main class="page-content">
  <div class="wrap">
    <?php while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <div><?php the_content(); ?></div>
    <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>

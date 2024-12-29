<?php get_header(); ?>

<main>
  <section>
    <?php while (have_posts()) : the_post(); ?>
      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </section>
</main>

<?php get_footer(); ?>
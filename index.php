<?php get_header(); ?>

<div class="popular">

  <h2>Popular Posts</h2>

  <?php
    global $post;
    $args = array( 'numberposts' => 6, 'category_name' => 'popular' );
    $posts = get_posts( $args );
    foreach( $posts as $post ): setup_postdata($post); 
  ?>

  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

    <header>
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
    </header>

    <div class="entry-content">
      <?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
      <?php the_excerpt('Read more &raquo;'); ?>
    </div>

    <footer>
      Posted in <?php the_category(', ') ?>
      <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
    </footer>

  </article>

  <?php
    endforeach;
    wp_reset_query();
  ?>

</div>

<hr />

<div id="main" role="main">

  <h2>All Posts (except Popular)</h2>
  
  <?php
    $popID = get_term_by( 'slug', 'popular', 'category' );
    $popID = $popID->term_id;
    $query = new WP_Query(array( 'cat' => '-'.$popID, 'paged' => $paged ));
    if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
  ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <header>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
      </header>
      <?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
      <div class="entry-content">
        <?php the_excerpt('Read more &raquo;'); ?>
      </div>
      <footer>
        Posted in <?php the_category(', ') ?>
        <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
      </footer>
    </article>

  <?php endwhile; ?>

  <nav>
    <div><?php next_posts_link('&laquo; Older Entries') ?></div>
    <div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
  </nav>

  <?php else : ?>

  <h2>Not Found</h2>
  <p>Sorry, but you are looking for something that isn't here.</p>
  <?php get_search_form(); ?>

  <?php
    endif;
    wp_reset_query();
  ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
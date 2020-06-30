<?php
/**
 * Template name: Présentation - Accueil
 */
get_header(); 

$_fields = get_fields(); ?>

<div class="frame" id="basic">
  <div class="slidee">
    <?php foreach ($_fields['home_blocks'] as $index=>$block) : ?>
      <section class="section section-single-text <?= $index == 0 ? 'section-home' : '' ?>">
        <aside class="<?= $block['images']['has_second_img'] ? 'multiple-img' : 'single-img'; ?>">
          <?php
            if ($block['images']['has_second_img']) {
              echo wp_get_attachment_image( $block['images']['image_2'], array('700','900'), '', array('class' => 'img-secondary'));
            }
          ?>
          <?= wp_get_attachment_image( $block['images']['image'], array('700','900'), '', array('class' => 'img-main') ); ?>
        </aside>
        <div class="content">
          <h2 class="h1"><?= $block['content']['title']; ?></h2>
          <?= $block['content']['text']; ?>
          
          <?php if ($block['content']['link']) : ?>
            <a href="<?= $block['content']['link']['url']; ?>" title="<?= $block['content']['link']['title']; ?>"><?= $block['content']['link']['title']; ?></a>
          <?php endif; ?>
        </div>
      </section>
    <?php endforeach; ?>

    <?php 
      $my_total = round(count($_fields['featured_products']) / 3);
      for ($my_page = 0; $my_page <= $my_total - 1; $my_page++) :
    ?>
    
      <section class="section-shop">
        <?php if ($my_page == 0) : ?>
          <h2 class="h1">Boutique</h2>
        <?php else : ?>
          <div class="no-title"></div>
        <?php endif; ?>
        <ul class="products">
          <?php 
            $my_products = array_slice($_fields['featured_products'], 3 * $my_page , 3);
          ?>
          <?php foreach ($my_products as $product) : ?>
            <?php
              $post_object = get_post( $product );

              setup_postdata( $GLOBALS['post'] =& $post_object );

              wc_get_template_part( 'content', 'product' );
            ?>
          <?php 
            endforeach; 
          ?>
        </ul>
      </section>

    <?php 
      endfor; 
      wp_reset_postdata(); 
    ?>

    <section class="section-services">
      <ul>
        <?php foreach ($_fields['shop_services'] as $service) : ?>
          <li class="service">
            <img class="<?= $service['subtitle'] ? 'small-img' : ''; ?>" src="<?= $service['icon']; ?>" alt="<?= esc_attr($service['title']); ?>">
            <?= $service['title']; ?>
            <?= $service['subtitle']; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <?php foreach ($_fields['creations_blocks'] as $index=>$block) : ?>
      <section class="section section-single-text">
        <aside class="single-img">
          <?= wp_get_attachment_image( $block['images']['image'], array('700','900'), '', array('class' => 'img-main') ); ?>
        </aside>
        <div class="content">
          <h2 class="h1"><?= $block['content']['title']; ?></h2>
          <?= $block['content']['text']; ?>
        </div>
      </section>
    <?php endforeach; ?>

    <section class="section">
      <h2 class="h1">Conseils</h2>
      <div class="section-3-col">
        <?= wp_get_attachment_image( $_fields['conseils']['image'], array('700','900'), '', array('class' => 'img-main') ); ?>
        <?= $_fields['conseils']['content']; ?>
      </div>
    </section>

    <section class="section">
      <h2 class="h1">Mentions légales</h2>
      <div class="section-3-col">
        <?php echo get_field('legal_text'); ?>
      </div>
    </section>

  </div>
</div>

<div class="navigation">
  <nav>
    <ul>
      <?php foreach ($_fields['navigation'] as $index=>$nav) : ?>
        <li><button class="btn toStart<?= $index == 0 ? ' active' : ''; ?>" data-item="<?= $nav['page_start']; ?>"><?= $nav['title']; ?></button></li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <div class="scrollbar">
    <div class="handle">
      <div class="mousearea"></div>
    </div>
    <div class="progress"></div>
  </div>
</div>

<?php
get_footer();
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
              echo wp_get_attachment_image( $block['images']['image_2'], '(max-width: 525px) 100vw, 525px', '', array('class' => 'img-secondary'));
            }
          ?>
          <?= wp_get_attachment_image( $block['images']['image'], '(max-width: 525px) 100vw, 525px', '', array('class' => 'img-main') ); ?>
        </aside>
        <div class="content">
          <h2 class="h1"><?= $block['content']['title']; ?></h2>
          <?= $block['content']['text']; ?>
          
          <a href="<?= $block['content']['link']['url']; ?>" title="<?= $block['content']['link']['title']; ?>"><?= $block['content']['link']['title']; ?></a>
        </div>
      </section>
    <?php endforeach; ?>

    <section class="section section-shop">
      <h2 class="h1">Boutique</h2>
      <div class="products">
        <div class="placeholder"></div>
        <div class="placeholder"></div>
        <div class="placeholder"></div>
      </div>
    </section>

    <section class="section-shop">
      <div class="no-title"></div>
      <div class="products">
        <div class="placeholder"></div>
        <div class="placeholder"></div>
        <div class="placeholder"></div>
      </div>
    </section>

    <section class="section-services">
      <div class="service"></div>
      <div class="service"></div>
      <div class="service"></div>
      <div class="service"></div>
    </section>

    <section class="section-single-text">
      <aside>
        <div class="placeholder"></div>
      </aside>
      <div class="content">
        <h2 class="h1">Des tissus designés et fabriqués à Paris</h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
      </div>
    </section>

    <section class="section-single-text">
      <aside>
        <div class="placeholder"></div>
      </aside>
      <div class="content">
        <h2 class="h1">Ls Sangles</h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
      </div>
    </section>

    <section class="section-3-col">
      <div class="col">
        <h2 class="h1">Conseils</h2>
        <div class="placeholder"></div>
      </div>
      <div class="col">
        <p>Il existe plusieurs manières de nouer votre furoshiki pour en faire des sacs de tailles et de styles différents. Voici un tutoriel pour le nouage simple avec une sangle.</p>
        <p>Vous trouverez prochainement ici de nouveaux tutoriaux en video.</p>
      </div>
      <div class="col">
        <p>Pour entretenir votre furoshiki, lavez-le en machine à 30°. 
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
      </div>
    </section>

    <section class="section-3-col">
      <?php echo get_field('legal_text'); ?>
    </section>
  </div>
</div>

<div class="navigation">
  <div class="scrollbar">
    <div class="handle">
      <div class="mousearea"></div>
    </div>
  </div>
  <nav>
    <ul>
      <li><button class="btn toStart" data-item="0">Accueil</button></li>
      <li><button class="btn toStart" data-item="3">Boutique</button></li>
      <li><button class="btn toStart" data-item="6">Créations</button></li>
      <li><button class="btn toStart" data-item="8">Conseils</button></li>
      <li><button class="btn toStart" data-item="9">Mentions légales</button></li>
    </ul>
  </nav>
</div>

<?php
get_footer();
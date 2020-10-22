<div class="col-lg-3 col-xl-2 col-sm-4 col-12">
  <div class="card mb-4 shadow-sm">
    <div class="gallery-thumb">
      <?php

      foreach (get_field('image_gallery') as $key => $image_item) {
        if ($key < 1) { ?>
          <img alt="Thumbnail " src="<?= __(get_field('gallery_thumbnail')) ?>">
          <a href="<?= __($image_item['url']) ?>" rel="lightbox" data-rel="gallery-<?= __(get_the_id()) ?>"
              class="d-flex justify-content-center align-items-center text-light">
            <i class="fas fa-image fa-3x"></i>
          </a>
        <?php } else {
          ?>
          <a href="<?= __($image_item['url']) ?>" rel="lightbox" data-rel="gallery-<?= __(get_the_id()) ?>"></a>
          <?php
        }
      } ?>
    </div>
    <p class="m-0 p-2 text-truncate" data-toggle="tooltip" data-placement="auto"
        title="<?= get_the_title() ?>"> <?= is_post_type_archive() ? '<i class="fas fa-image"></i> ' : ' ' ?> <?= get_the_title() ?></p>
  </div>
</div>

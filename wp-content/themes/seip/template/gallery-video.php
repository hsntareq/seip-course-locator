<?php
foreach (get_field('video_gallery') as $key => $video_item) {

  $video_id = explode('?v=', $video_item['video_url']); ?>
  <div class="col-lg-3 col-xl-2 col-sm-4 col-12">
    <div class="card mb-4 shadow-sm">
      <div class="gallery-thumb">
        <img alt="Thumbnail" src="<?= __($video_item['video_thumb']) ?>">
        <a href="<?= $video_item['video_url'] ?>" data-fancybox="gallery-<?= __(get_the_id()) ?>"
            class="d-flex align-items-center justify-content-center text-light">
          <i class="fas fa-play-circle fa-3x"></i>
        </a>
      </div>
      <p class="m-0 p-2 text-truncate" data-toggle="tooltip" data-placement="auto"
          title="<?= $video_item['video_title'] ?>"> <?= is_post_type_archive()?'<i class="fas fa-play"></i> ':' '?> <?=$video_item['video_title'] ?></p>
    </div>
  </div>
  <?php
}
?>

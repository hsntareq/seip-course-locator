<footer class="w-100">

  <div class="footer-before text-white py-1">
    <div class="container-fluid">
      <div class="d-lg-flex text-center text-lg-left align-items-center py-1 justify-content-between">
        <div class="footer-link">
          <?php
          $footer_nav = array(
            'theme_location' => 'footer_menu', // Change based on theme
            'container' => '', // try: false
            'echo' => false,
            'items_wrap' => '%3$s',
            'depth' => 0
          );
          echo strip_tags(wp_nav_menu($footer_nav), '<a>');
          ?>
        </div>
        <div class="text-center">
          <p class="mb-0">Skills For Employment Investment Program &copy; 2019</p>
        </div>
        <div class="text-center">
          <p class="mb-0">Site visited: <?= __(do_shortcode('[wpstatistics stat=visitors time=total]')) ?></p>
        </div>
        <div class="d-lg-flex justify-content-end">

          <div class="socials">
            <span class="mr-2">Follow Us: </span>
            <?php
            if (get_field('follow_us', 'option')) {
              foreach (get_field('follow_us', 'option') as $social) {
                echo '<a target="_blank" title="' . $social['social_name'] . '" href="' . $social['social_url'] . '"><i class="' . $social['social_icon'] . '"></i></a>';
              }
            }
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>

</footer>
</div>
<?php wp_footer() ?>
</body>
</html>
<?php
/*
 * Template name: Scroll Nav Page
 * */
?>
<?php get_header() ?>
<div class="w-100 flex-fill overflow-h h-100">
    <div class="content-wrap py-2 h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <?php get_template_part('template/page', 'nav') ?>

                <div class="col-sm-12 col-xl-10 col-lg-9 h-100">
                    <div class="content-area d-flex flex-column h-100">

                        <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                        }
                        ?>

                        <h1 class="mb-0"><?= __(the_title()) ?></h1>

                        <?php
                        $scrolling_block_items = get_field('scrolling_block_items');
                        ?>
                        <div>
                            <ul class="nav mb-3">
                                <li class="nav-item">
                                    <a data-scroll class="nav-link badge active show"
                                       href="#all"
                                       data-toggle="pill"><?= __('All') ?></a>
                                </li>
                                <?php
                                foreach ($scrolling_block_items as $scrolling_block_item) {
                                    ?>
                                    <li class="nav-item">
                                        <a data-scroll
                                           class="nav-link badge <?php //echo $dept_no == 1 ? 'active' : '' ?>"
                                           href="#<?= __(str_replace(' ','_',$scrolling_block_item['association_short_name'])) ?>"
                                           data-toggle="pill"><?= __($scrolling_block_item['association_short_name']) ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="pScroll scrolling-wrap">
                            <?php
                            foreach ($scrolling_block_items as $scrolling_block_item) {
                                ?>
                                <div class="association_scrolling"
                                     id="<?= __(str_replace(' ','_',$scrolling_block_item['association_short_name'])) ?>">
                                    <div class="text-center font-weight-bold"><?= $scrolling_block_item['association_name'] ?> <?= $scrolling_block_item['association_short_name'] ? '(' . $scrolling_block_item['association_short_name'] . ')' : '' ?></div>
                                    <div class="text-center"><?= $scrolling_block_item['association_address'] ?></div>

                                    <?php
                                    if ($scrolling_block_item['association_additional'] == true) {
                                        foreach ($scrolling_block_item['association_additional'] as $association_additional) {
                                            ?>
                                            <div class="text-center"><?= $association_additional['additional_field'] ?></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="asso_content mt-3 mb-5">
                                        <?= $scrolling_block_item['association_content'] ? $scrolling_block_item['association_content'] : 'No content found...' ?>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function () {
    function scrollToSection(event) {
      var section = $(this).attr('href');
      var result = section.replace("#", "");
      if (result != 'all') {
        $('.scrolling-wrap').addClass('single-preview');
      } else {
        $('.scrolling-wrap').removeClass('single-preview');
      }
      event.preventDefault();

    }

    $('[data-scroll]').on('click', scrollToSection);
  });
</script>
<?php get_footer() ?>

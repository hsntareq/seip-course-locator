<?php get_header() ?>
<?php
$apiPopulateDashboardData = wp_remote_post(
    'https://tms.seip-fd.gov.bd/tmsApi/apiPopulateDashboardData',
    array(
        'method' => 'POST',
        'timeout' => 15,
        'body' => array(
            'api_key' => '123456seip7654321',
        )
    )
);


$dashboard_populated_data = json_decode($apiPopulateDashboardData['body']);
?>
<input type='hidden' value='<?= json_encode($dashboard_populated_data->data); ?>' class='api_data'>
<script>
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    setTimeout(function (e) {
        var api_data = JSON.parse($('input.api_data').val());
        $('p.ban_target').text(formatNumber(api_data.total_target));
        $('p.ban_enrolled').text(formatNumber(api_data.total_enrollment));
        $('p.ban_female').text(formatNumber(api_data.total_female_enrollment));
        $('p.ban_certified').text(formatNumber(api_data.total_certification));
        $('p.ban_employed').text(formatNumber(api_data.total_job_placement));

        $('p.ban_partners').text(formatNumber(api_data.entity_count));
        $('p.ban_institute').text(formatNumber(api_data.institute_count));
        $('p.ban_courses').text(formatNumber(api_data.unique_course_count));
        $('p.ban_trainers').text(formatNumber(api_data.trainers_count));
        $('p.ban_assessors').text(formatNumber(api_data.assessors_count));
    }, 2000)
</script>
<div class="w-100 flex-fill overflow-h">
    <div class="home-wrap h-100 d-flex flex-column">
        <div class="banner">
            <div class="slider">
                <?php
                //        if ($dashboard_populated_data) {
                if (get_field('banner_slides', 'option')) {
                    foreach (get_field('banner_slides', 'option') as $banner_slide) {
                        ?>
                        <div>
                            <img
                                    src="<?= $banner_slide['banner_image'] ? $banner_slide['banner_image'] : '/images/slider/01.jpg' ?>"
                                    alt="slide">
                            <div class="banner-content flex-fill align-items-center d-flex">
                                <div class="container-fluid">

                                    <div class="header-content text-white text-center float-lg-right text-slide-1">
                                        <div class="p-3 mb-0"><span
                                                    class="display-6"><?= __('Training Statistics') ?></span>
                                            <small>(As of <?= __(date("Y-m-d h:i:sa")) ?>)</small>
                                        </div>

                                        <div class="d-flex fs-16 fs-10 justify-content-between">
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-primary-tr py-2 col-lg">
                                                <p>Target</p>
                                                <p class="ban_target"><?= number_format(get_field('target', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-warning-tr py-2 col-lg">
                                                <p>Enrolled</p>
                                                <p class="ban_enrolled"><?= number_format(get_field('enrolled', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-secondary-tr py-2 col-lg">
                                                <p>Female</p>
                                                <p class="ban_female"><?= number_format(get_field('female', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-info-tr py-2 col-lg">
                                                <p>Certified</p>
                                                <p class="ban_certified"><?= number_format(get_field('certified', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-danger-tr py-2 col-lg">
                                                <p>Employed</p>
                                                <p class="ban_employed"><?= number_format(get_field('employed', 'option')) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="header-content text-white text-center float-lg-right text-slide-2">

                                        <div class="p-3 mb-0"><span
                                                    class="display-6"><?= __('Training Statistics') ?></span>
                                            <small>(As of <?= __(date("Y-m-d h:i:sa")) ?>)</small>
                                        </div>
                                        <div class="d-flex fs-16 fs-10 justify-content-between">
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-primary-tr py-2 col-lg">
                                                <p>Partners</p>
                                                <p class="ban_partners"><?= number_format(get_field('partners', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-warning-tr py-2 col-lg">
                                                <p>Institute</p>
                                                <p class="ban_institute"><?= number_format(get_field('institute', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-secondary-tr py-2 col-lg">
                                                <p>Course</p>
                                                <p class="ban_courses"><?= number_format(get_field('courses', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-info-tr py-2 col-lg">
                                                <p>Trainer</p>
                                                <p class="ban_trainers"><?= number_format(get_field('trainers', 'option')) ?></p>
                                            </div>
                                            <div class="flex-lg-fill px-0 px-lg-3 bg-danger-tr py-2 col-lg">
                                                <p>Assessor</p>
                                                <p class="ban_assessors"><?= number_format(get_field('assessors', 'option')) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
//          }
                } else {
                    echo 'Data retrieve issue from database...';
                }
                ?>
            </div>
        </div>

        <nav class="main-nav">
            <div class="container-fluid d-flex justify-content-between">
                <?= wp_nav_menu(array(
                    'theme_location' => 'main_menu'
                )) ?>
                <div class="search-wrap position-relative">
                    <?php get_search_form(); ?>
                </div>
        </nav>
        <?php
        $ticker_args = array(
            'post_type' => array('news_highlight', 'admission-circular', 'notices'),
            'post_status' => 'publish',
            'posts_per_page' => 16,
            'meta_key' => 'news_ticker',
            'meta_value' => true,
        );
        $ticker_posts = get_posts($ticker_args);
        ?>
        <div class="ticker-container">
            <div class="ticker-wrap">
                <div class="ticker">
                    <?php
                    foreach ($ticker_posts as $post) {
                        ?>
                        <div class="ticker__item">
                            <a href="<?= get_permalink($post->ID) ?>"><?= $post->post_title ?></a>
                        </div>
                        <?php

                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="h-100 overflow-h">
            <div class="content-wrap py-3 h-100 overflow-h">
                <div class="container-fluid h-100 overflow-h">
                    <div class="content-area h-100 overflow-h">

                        <div class="row h-100 overflow-h">
                            <div class="col-lg-4 mb-4 mb-lg-0 h-100 overflow-h">
                                <div class="card h-100 overflow-h">
                                    <div class="card-header">
                                        <a href="<?= get_permalink(get_option('page_for_posts')); ?>"
                                           class="card-header mb-0 h5 text-truncate font-weight-bold"><?= get_field('featured_title_one', 'option') ?></a>
                                    </div>
                                    <ul class="list-group list-group-flush list-sm">
                                        <?php

                                        $all_news = get_posts(array('post_type' => 'news_highlight', 'post_status' => 'publish', 'numberposts' => 16,));

                                        foreach ($all_news as $post) {
                                            $archive_post = get_field('archive_post', $post->ID);
                                            $archive_date = strtotime(get_field('archive_date', $post->ID));
                                            $current_time = current_time('timestamp');
                                            if ($archive_post != true || $archive_date > $current_time) {
                                                ?>
                                                <a href="<?= get_permalink($post->ID) ?>"
                                                   class="list-group-item text-truncate <?= has_term('expired', 'category', $post) == true ? 'expired' : '' ?> <?= get_field('post_scheduling', $post->ID) == true ? 'new-post' : '' ?>"><?= __($post->post_title) ?></a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4 mb-lg-0 h-100 overflow-h">
                                <div class="card h-100 overflow-h">
                                    <div class="card-header">
                                        <a href="<?= get_post_type_archive_link('admission-circular'); ?>"
                                           class="card-header mb-0 h5 text-truncate font-weight-bold"><?= get_field('featured_title_two', 'option') ?></a>
                                    </div>
                                    <ul class="list-group list-group-flush list-sm">
                                        <?php
                                        $admission_circular = get_posts(
                                            array(
                                                'numberposts' => 16,
                                                'post_type' => 'admission-circular',
                                            )
                                        );
                                        foreach ($admission_circular as $post) {
                                            $archive_post = get_field('archive_post', $post->ID);
                                            $archive_date = strtotime(get_field('archive_date', $post->ID));
                                            $current_time = current_time('timestamp');
                                            if ($archive_post != true || $archive_date > $current_time) {
                                                ?>
                                                <a href="<?= get_permalink($post->ID) ?>"
                                                   class="list-group-item text-truncate <?= has_term('expired', 'category', $post) == true ? 'expired' : '' ?> <?= get_field('post_scheduling', $post->ID) == true ? 'new-post' : '' ?>"><?= __($post->post_title) ?></a>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4 mb-lg-0 h-100 overflow-h">
                                <div class="card h-100 overflow-h">
                                    <div class="card-header">
                                        <a href="<?= home_url('notice/office-order'); ?>"
                                           class="card-header mb-0 h5 text-truncate font-weight-bold"><?= get_field('featured_title_three', 'option') ?></a>
                                    </div>
                                    <ul class="list-group list-group-flush list-sm">
                                        <?php
                                        $notices = get_posts(
                                            array(
                                                'numberposts' => 16,
                                                'post_type' => 'notices'
                                            )
                                        );
                                        foreach ($notices as $post) {
                                            $archive_post = get_field('archive_post', $post->ID);
                                            $archive_date = strtotime(get_field('archive_date', $post->ID));
                                            $current_time = current_time('timestamp');
                                            if ($archive_post != true || $archive_date > $current_time) {
                                                ?>
                                                <a href="<?= get_permalink($post->ID) ?>"
                                                   class="list-group-item text-truncate <?= has_term('expired', 'category', $post) == true ? 'expired' : '' ?> <?= get_field('post_scheduling', $post->ID) == true ? 'new-post' : '' ?>"><?= __($post->post_title) ?></a>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

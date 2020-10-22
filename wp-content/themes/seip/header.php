<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="<?= THEME ?>/images/favicon.png"/>
    <title><?php wp_title('') ?></title>
    <?php wp_head(); ?>
</head>
<body <?= body_class() ?>>
<?php
$all_news = get_posts(array('post_type' => 'highlight', 'post_status' => 'any', 'numberposts' => 16,));
?>
<div class="slideNav py-2">
    <div class="nav-wrap h-100">
        <button type="button" class="btn btn-danger btn-sm btn-close">
            <i class="fas fa-times"></i>
            <!--<span aria-hidden="true">&times;</span>-->
        </button>
        <div class="mobile-nav h-100 overflow-h pScroll">
            <?= wp_nav_menu(array(
                'theme_location' => 'main_menu'
            )) ?>
        </div>
    </div>
</div>
<div class="d-flex align-items-start flex-column h-100">
    <div class="head-wrap w-100 text-center text-lg-lefts">
        <header class="d-flex flex-column justify-content-between">
            <div class="header-top">
                <div class="container-fluid">
                    <button class="btn btn-light btn-sm px-2 rounded-0 slideNav-trigger"><i class="fas fa-bars"></i>
                    </button>
                    <div class="d-lg-flex align-items-lg-center justify-content-between">
                        <div class="d-lg-flex align-items-lg-center logo-wrap">
                            <div class="logo">
                                <a href="<?= home_url() ?>">
                                    <img
                                            src="<?= get_field('logo', 'option') ? get_field('logo', 'option') : THEME . '/images/logo.png' ?>"
                                            alt="logo">
                                </a>
                            </div>
                            <span class="h-auto ml-0 ml-lg-3 py-2 py-lg-0 d-block d-lg-inline display-6 text-white text-shadow">
            <?= get_field('logo_text', 'option') ? get_field('logo_text', 'option') : 'Skills For Employment Investment Program' ?>
          </span>
                        </div>
                        <div class="d-flex justify-content-lg-end justify-content-center align-items-center">
                            <div class="partners d-lg-flex">
                                <?php
                                if (get_field('logo_partners', 'option')) {
                                    foreach (get_field('logo_partners', 'option') as $partner) {
                                        echo '<img src="' . $partner['partner_image'] . '" alt="' . $partner['partner_title'] . '" class="' . $partner['image_class'] . '">';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

    </div>

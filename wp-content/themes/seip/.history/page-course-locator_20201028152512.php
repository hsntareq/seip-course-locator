<?php
/*
 * Template name: Course Locator
 * */
?>
<?php get_header() ?>
<?php
global $wpdb;
$course_sector = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM tms_course_info WHERE course_sector!='' GROUP BY course_sector")
);
$course_name = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM tms_course_info WHERE course_name!='' GROUP BY course_name")
);
$present_district = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM tms_training_institutes WHERE present_district!='' GROUP BY present_district")
);
$tms_entity = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM tms_entity WHERE name!='' GROUP BY name")
);
$training_institutes = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM tms_training_institutes WHERE short_name!='' GROUP BY short_name")
);
//pr($training_institutes);
?>
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

                        <h1 class="mb-4"><?= __(the_title()) ?></h1>
                        <div class="content pScroll pr-2">
                            <div class="overflow-h">
                                <div class="course-locator bg-light px-3 pb-3 pt-2 mb-4 shadow-sm border position-relative">
                                    <div class="form_loader">
                                        <div class="d-flex justify-content-center align-items-center h-100">
                                            <div class="loader"></div>
                                        </div>
                                    </div>
                                    <form method="post" id="course_locator" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-sm-4 mb-2">
                                                <label for="sector_name">Sector name</label>
                                                <select class="select2" id="sector_name" name="sector_name">
                                                    <option value="">- Select -</option>
                                                    <?php foreach ($course_sector as $data): ?>
                                                        <option value="<?= $data->course_sector ?>"><?= $data->course_sector ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="course_id">Course name</label>
                                                <select class="select2" id="course_name" name="course_name">
                                                    <option value="">- Select -</option>
                                                    <?php foreach ($course_name as $data): ?>
                                                        <option value="<?= $data->id ?>"><?= $data->course_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="location">Location</label>
                                                <select class="select2" id="location" name="location">
                                                    <option value="">- Select -</option>
                                                    <?php foreach ($present_district as $data): ?>
                                                        <option value="<?= $data->present_district ?>"><?= $data->present_district ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label for="training_partner">Training Partner</label>
                                                <select class="select2" id="training_partner" name="training_partner">
                                                    <option value="">- Select -</option>
                                                    <?php foreach ($tms_entity as $data): ?>
                                                        <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label for="training_institute">Training Institute</label>
                                                <select class="select2" id="training_institute"
                                                        name="training_institute">
                                                    <option value="">- Select -</option>
                                                    <?php foreach ($training_institutes as $data): ?>
                                                        <option value="<?= $data->id ?>"><?= $data->short_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <!--<div class="col-md-12">
                                                <label for="course_title">Search by course title</label>
                                                <div class="input-group mb-0">
                                                    <input type="text" name="course_title" id="course_title"
                                                           class="form-control form-control-sm"
                                                           placeholder="Type to search by course title">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit"
                                                                id="search_courses" name="search_courses">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>-->

                                        </div>
                                    </form>
                                </div>

                                <div class="card-columns h-100 batch_list">
                                    <div class="col">Filter to get desired course</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?= get_template_directory_uri() ?>/css/select2.min.css" rel="stylesheet"/>
<script src="<?= get_template_directory_uri() ?>/js/select2.min.js"></script>
<script>
    $(function (e) {
        $('.select2').select2({
            width: '100%'
        });
        $('#sector_name,#course_name,#location,#training_partner,#training_institute').on('change', function (e) {

            var batch_list = $('.batch_list');
            var form_loader = $('.form_loader');
            var effector = this.id;
            var effectorVal = $('#' + effector).val();

            form_loader.show();
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: seip_ajax_obj.ajax_course_result,
                data: {
                    'field_type': $(this).attr('id'),
                    'sector_name': $('#sector_name').val(),
                    'course_name': $('#course_name').val(),
                    'location': $('#location').val(),
                    'training_partner': $('#training_partner').val(),
                    'training_institute': $('#training_institute').val(),
                    'course_title': $('#course_title').val(),
                },
                success: function (data) {
                    $.each(data, function (key, dataset) {
                        var html = '<option value="">-Select-</option>';
                        $.each(dataset, function (index, value) {
                            var selected = (index == effectorVal) ? 'selected' : '';
                            console.log(selected)
                            html += '<option value="' + index + '" ' + selected + '>' + value + '</option>';
                        });
                        $('#' + key).html(html);
                    });


                    batch_list.html('');
                    $.each(data.batch_info, function (key, value) {
                        batch_list.append(`
                            <div class="card bg-light shadow-sm mb-3">
                                <div class="card-body p-2">
                                    <h6 class="card-title text-truncate fw-semibold" title="` + value.institute_name + `">
                                        ` + value.institute_name + `
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-info">
                                        <a href="tel:+88` + value.phone + `" class="mb-0">
                                            <i class="fas fa-mobile-alt text-success mr-1"></i>
                                            ` + value.phone + `
                                        </a>
                                    </h6>
                                    <p class="card-text mb-0">
                                    <i class="fa fa-map-marker-alt text-info mr-2"></i>` + value.present_address + `
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-2">
                                        <div class="line-height-12">
                                            <p class="mb-0"><i class="fa fa-book-open text-info mr-2"></i>` + value.course_name + `</p>
                                            ` + COURSE_DATA.Checkurl(value.web_url) + `
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        `)
                    });


                    form_loader.hide();
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });

        })

        $('form#course_locator').on('submit', function (e) {
            e.preventDefault();
            var batch_list = $('.batch_list');
            var form_loader = $('.form_loader');

            form_loader.show();
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: seip_ajax_obj.ajax_course_result,
                data: {
                    'field_type': $(this).attr('id'),
                    'sector_name': $('#sector_name').val(),
                    'course_name': $('#course_name').val(),
                    'location': $('#location').val(),
                    'training_partner': $('#training_partner').val(),
                    'training_institute': $('#training_institute').val(),
                    'course_title': $('#course_title').val(),
                    'search_courses': $('#search_courses').attr('type'),
                },
                success: function (data) {
                    console.log(data)

                    batch_list.html('');
                    $.each(data.batch_info, function (key, value) {
                        batch_list.append(`
                            <div class="card bg-light shadow-sm mb-3">
                                <div class="card-body p-2">
                                    <h6 class="card-title text-truncate fw-semibold" title="` + value.institute_name + `">
                                        <a href="#">` + value.institute_name + `</a>
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-info">
                                        <i class="far fa-calendar-alt"></i> ` + value.start_date + `
                                    </h6>
                                    <p class="card-text mb-0">
                                    ` + value.present_address + `
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-2">
                                        <div class="line-height-12">
                                            <p class="mb-0">` + value.course_name + `</p>
                                            ` + COURSE_DATA.Checkurl(value.web_url) + `
                                        </div>
                                        <a href="tel:` + value.phone + `" class="mb-0">
                                            <i class="fas fa-phone-square text-info mr-1"></i>
                                            ` + value.phone + `
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        `)
                    });


                    form_loader.hide();
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });

        });


        const COURSE_DATA = {
            loadDataReturnID: function (element, dataset, field, title) {
                element.html('').append("<option value=''> - Select " + title + " - </option>");
                var datavalue, dataid = element.attr('id');
                $.each(dataset, function (key, value) {
                    element.append('<option value="' + value.id + '">' + value[field] + '</option>');
                });
            },
            loadDataReturnName: function (element, dataset, field, title) {
                element.html('').append("<option value=''> - Select " + title + " - </option>");
                var datavalue, dataid = element.attr('id');
                $.each(dataset, function (key, value) {
                    element.append('<option value="' + value[field] + '">' + value[field] + '</option>');
                });
            },
            Checkurl: function (text) {
                var url1 = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g,
                    url2 = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g;

                var html = $.trim(text);
                if (html) {
                    html = html
                        .replace(url1, '$1<a class="text-info" target="_blank"  href="http://$2"> <i class="fa fa-globe text-info mr-2"></i> $2</a>$3')
                        .replace(url2, '$1<a class="text-info" target="_blank"  href="$2"> <i class="fa fa-link text-info mr-2"></i> $2</a>$5');
                }
                return html;
            }
        }
    })
</script>

<?php get_footer() ?>

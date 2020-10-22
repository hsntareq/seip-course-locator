<?php
/*
 * Template name: Statistics
 * */
?>
<?php get_header() ?>
<div class="w-100 flex-fill overflow-h h-100 d-flex flex-column">
  <div class="content-wrap py-2 flex-fill overflow-h">
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
            <?php
            $result = wp_remote_post(
              'https://tms.seip-fd.gov.bd/courseReport/cumulativeDashboardStatistics',
              array(
                'method' => 'POST',
                'body' => array(
                  'api_key' => '123456seip7654321',
                  'timeout' => 2,
                  'tranche' => 1
                )
              )
            );

            if ( is_wp_error( $result ) ) {
              $error_message = $response->get_error_message();
              echo "Something went wrong: $error_message";
            } else {
              $data_json_object = json_decode($result['body']);
            }


            $update_date = $data_json_object->update_date;
            $update_time = $data_json_object->update_time;
            ?>
            <style>
              .table thead th{background:#495057;color:#fff;}
              .table thead td, .table thead th{vertical-align:middle;}
            </style>
            <div class="btn-wrap flex-fill overflow-h d-flex flex-column">
              <div>
                <div class="d-xl-flex justify-content-between py-2">
                  <h1 class="widget-title heading-title">Training Statistics
                    <small style="font-size:70%">(As of <?= __($update_date) ?>, <?= __($update_time); ?>)</small>
                  </h1>
                  <div class="select_tranche" id="select_tranche">
                    <button data-placement="top"  title="Tranche 1" data-toggle="tooltip" class="btn btn-light btn-sm mb-1 font-weight-bold" value="1">Tranche 1</button>
                    <button data-placement="top"  title="Tranche 1 additional" data-toggle="tooltip" class="btn btn-light btn-sm mb-1 font-weight-bold" value="3">Tranche 1 add.</button>
                    <button data-placement="top"  title="Tranche 2" data-toggle="tooltip" class="btn btn-light btn-sm mb-1 font-weight-bold" value="2">Tranche 2</button>
                    <button data-placement="top"  title="Tranche 2 additional" data-toggle="tooltip" class="btn btn-light btn-sm mb-1 font-weight-bold" value="4">Tranche 2 add.</button>
                    <button data-placement="top"  title="All Tranche" data-toggle="tooltip" class="btn btn-light btn-sm mb-1 font-weight-bold" value="0">All Tranche</button>
                  </div>
                </div>
              </div>

              <div class="flex-basis overflow-h">
                <div class="table-responsive h-100">
                  <div class="statistic-data">
                    <div class="loading position-absolute bg-white w-100 h-100"><img src="<?= get_template_directory_uri();?>/images/loading1.svg" alt="loading..."></div>
                    <div class="tbl-header">
                      <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="row-1 odd">
                          <th class="text-nowrap text-center">SL</th>
                          <th class="text-nowrap w-280">Industry Association/ Organization</th>
                          <th class="text-nowrap text-center">Total Target</th>
                          <th class="text-nowrap text-center">Enrollment</th>
                          <th class="text-nowrap text-center">O/W Female</th>
                          <th class="text-nowrap text-center">Certification</th>
                          <th class="text-nowrap text-center">Job Placement</th>
                          <th class="text-nowrap text-center">Dropout</th>
                        </tr>
                        </thead>
                      </table>
                    </div>

                    <div class="tbl-content flex-fill h-100">
                      <table class="table table-bordered table-striped table-sm" id="seip_statistics">
                        <thead>
                        <tr class="row-1 odd">
                          <th class="text-nowrap text-center" style="width:50px;">SL.</th>
                          <th class="text-nowrap w-280">Name of The Org.</th>
                          <th class="text-nowrap text-center">Total Target</th>
                          <th class="text-nowrap text-center">Enrollment</th>
                          <th class="text-nowrap text-center">Female</th>
                          <th class="text-nowrap text-center">Certification</th>
                          <th class="text-nowrap text-center">Job Placement</th>
                          <th class="text-nowrap text-center">Dropout</th>
                        </tr>
                        </thead>
                        <tbody class="row-hover center"></tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(window).load(function (e) {
      $('.loading').show();
      $.ajax({
        method: 'POST',
        dataType: 'html',
        url: seip_ajax_obj.ajax_tms_api, // or seip_ajax_obj.ajaxurl if using on frontend
        data: {
          'tranche': 1
        },
        success: function (data) {
          // This outputs the result of the ajax request
          $('.row-hover').html(data);
          $('#select_tranche button').first().addClass('active');
          $('span.tranche_name').text($('#select_tranche button').first().text());
          $('.loading').hide();
        },
        error: function (errorThrown) {
          console.log(errorThrown);
        }
      });
    })
  </script>
  <?php get_footer() ?>

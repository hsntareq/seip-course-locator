<?php
$result_uttoron = wp_remote_post(
  'http://tms.seip-fd.gov.bd/tmsApi/getAssociationSummary',
  array(
    'method' => 'POST',
    'body' => array(
      'api_key' => '123456seip7654321',
      'tranche' => 1
    )
  )
);
$data_uttoron_object = json_decode($result_uttoron['body']);
if (!empty($data_uttoron_object)):
  foreach ($data_uttoron_object->response_data as $value):
    $array = json_decode($value->response_data);
    if ($array->entity_id == 29) {

      ?>

      <ul class="<?php echo ($count % 2 == 0) ? "odd" : "even" ?>">
        <li class="column-1"><?php echo number_format($count + 1); ?></li>

        <li class="column-2"><a target="__blank"
              href="http://tts.seip-fd.gov.bd/tms/CourseSummary/<?php echo base64_encode($array->entity_id) ?><?= $tranche != 0 ? '/' . $tranche : '' ?>"><?php echo $value->name; ?></a>
        </li>

        <?php
        if ($array->total_target == "" || $array->total_target == 0)
          $array->total_target = "--";
        ?>

        <li class="column-3"> <?php echo number_format($array->total_target); ?> </li>

        <?php
        if ($array->total_enrollment == "" || $array->total_enrollment == 0)
          $array->total_enrollment = "--";
        ?>

        <li class="column-4"><?php echo number_format($array->total_enrollment); ?></li>

        <?php
        if ($array->total_female_enrollment == "" || $array->total_female_enrollment == 0)
          $array->total_female_enrollment = "--";
        ?>

        <li class="column-5"><?php echo number_format($array->total_female_enrollment); ?></li>

        <?php
        if ($array->total_certification == "" || $array->total_certification == 0)
          $array->total_certification = "--";
        ?>

        <li class="column-6"><?php echo number_format($array->total_certification); ?></li>

        <?php
        if ($array->total_job_placement == "" || $array->total_job_placement == 0)
          $array->total_job_placement = "--";
        ?>

        <li class="column-7"><?php echo number_format($array->total_job_placement); ?></li>

        <?php
        if ($array->total_dropout == "" || $array->total_dropout == 0)
          $array->total_dropout = "--";
        ?>

        <li class="column-8"><?php echo number_format($array->total_dropout); ?></li>

      </ul>


      <?php
    }
  endforeach;
endif;
?>
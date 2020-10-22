<?php
include('../../../wp-load.php');
$tranche = $_POST['tranche'] ? $_POST['tranche'] : '';
if ($tranche == null) {
    $tranche = 0;
}
die('not working');

try {
    $result = wp_remote_post(
        'https://tms.seip-fd.gov.bd/courseReport/cumulativeDashboardStatistics',
        array(
            'method' => 'POST',
            'body' => array(
                'api_key' => '123456seip7654321',
                'timeout' => 2,
                'tranche' => $tranche
            )
        )
    );
    $getAssociationData = json_decode($result['body']);
} catch (Exception $e) {
    return "Connection Error";
}

//pr($getAssociationData);die;
foreach ($getAssociationData->response_data as $key => $associationData) {

    ?>
    <tr>
        <?php
        if ($key == 'total') {
            ?>
            <td colspan="2"
                class="text-center font-weight-bold"><?= $associationData->name != '' ? $associationData->name : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->target != 0 ? number_format($associationData->target) : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->enrollment != 0 ? number_format($associationData->enrollment) : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->f_enrollment != 0 ? number_format($associationData->f_enrollment) : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->certification != 0 ? number_format($associationData->certification) : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->employment != 0 ? number_format($associationData->employment) : '-' ?></td>
            <td class="text-center font-weight-bold"><?= $associationData->dropout != 0 ? number_format($associationData->dropout) : '-' ?></td>

            <?php

        } else {
            ?>
            <td class="text-center"><?= $associationData->sl != 0 ? $associationData->sl : '-' ?></td>

            <td><a target="__blank"
                   href="http://tms.seip-fd.gov.bd/CourseSummary/<?php echo base64_encode($key) ?><?= $getAssociationData->tranche != 0 ? '/' . $getAssociationData->tranche : '' ?>"><?= $associationData->name != '' ? $associationData->name : '-' ?></a>
            </td>
            <td class="text-center"><?= $associationData->target != 0 ? number_format($associationData->target) : '-' ?></td>
            <td class="text-center"><?= $associationData->enrollment != 0 ? number_format($associationData->enrollment) : '-' ?></td>
            <td class="text-center"><?= $associationData->f_enrollment != 0 ? number_format($associationData->f_enrollment) : '-' ?></td>
            <td class="text-center"><?= $associationData->certification != 0 ? number_format($associationData->certification) : '-' ?></td>
            <td class="text-center"><?= $associationData->employment != 0 ? number_format($associationData->employment) : '-' ?></td>
            <td class="text-center"><?= $associationData->dropout != 0 ? number_format($associationData->dropout) : '-' ?></td>

        <?php } ?>
    </tr>

    <?php
}



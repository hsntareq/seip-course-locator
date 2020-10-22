<?php
include('../../../wp-load.php');
global $wpdb;
$dataset = [];

$request = $_POST['field_type'];
$sectorName = $_POST['sector_name'];
$courseId = $_POST['course_name'];
$location = $_POST['location'];
$trainingPartner = $_POST['training_partner'];
// $sectorName = $_POST['sector_name'];
// $sectorName = $_POST['sector_name'];

if ($request == 'sector_name') {
    $dataset['course_name'] = prepareCourseData($sectorName);
    $dataset['location'] = prepareLocationData($sectorName, $courseId);
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
}
if ($request == 'course_name') {
    $dataset['location'] = prepareLocationData($sectorName, $courseId);
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
}
if ($request == 'location') {
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
}
if ($request == 'training_partner') {
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
}


echo json_encode($dataset);

function prepareCourseData($sectorName)
{
    $sql = "SELECT DISTINCT(course_name), id FROM tms_course_info ";
    if (!empty($sectorName)) {
        $sql .= "WHERE `course_sector` = '$sectorName' ";
    }

    global $wpdb;
    $data = $wpdb->get_results(
        $wpdb->prepare($sql)
    );

    $output = [];
    if (!empty($data)) {
        foreach ($data as $item) {
            $output[$item->id] = $item->course_name;
        }
    }
    return $output;
}

function prepareLocationData($sectorName, $courseId)
{
    $sql = "SELECT DISTINCT(i.present_district)
        FROM tms_course_info c, tms_batch_info b, tms_training_institutes i
        WHERE c.id = b.course_info_id
        AND i.id = b.training_institute_id";

    if (!empty($courseId)) {
        $sql .= " AND c.id = $courseId";
    } elseif (!empty($sectorName)) {
        $sql .= " AND c.course_sector = '$sectorName'";
    }

    global $wpdb;
    $data = $wpdb->get_results(
        $wpdb->prepare($sql)
    );

    $output = [];
    if (!empty($data)) {
        foreach ($data as $item) {
            $output[$item->present_district] = $item->present_district;
        }
    }
    return $output;
}

function prepareTrainingPartnerData($sectorName, $courseId, $location)
{
    if (empty($sectorName) && empty($courseId) && empty($location)) {
        $sql = "SELECT * FROM tms_entity WHERE name!='' GROUP BY name";
    } else {
        $sql = "SELECT DISTINCT(e.name), e.id
        FROM tms_entity e, tms_batch_info b, tms_course_info c, tms_training_institutes i
        WHERE e.id = b.entity_id
        AND c.id = b.course_info_id";

        if (!empty($courseId)) {
            $sql .= " AND c.id = $courseId ";
        }

        if (!empty($location)) {
            $sql .= " AND i.present_district = '$location'";
        }

        if (!empty($sectorName)) {
            $sql .= " AND c.course_sector = '$sectorName'";
        }
        // AND course_sector = '$sector_name'"
    }
//    echo $sql; exit;

    global $wpdb;
    $data = $wpdb->get_results(
        $wpdb->prepare($sql)
    );
    $output = [];
    if (!empty($data)) {
        foreach ($data as $item) {
            $output[$item->id] = $item->name;
        }
    }
    return $output;
}

function prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner)
{
    $sql = "
    SELECT DISTINCT(i.institute_name), i.id
    FROM tms_course_info c, tms_batch_info b, tms_training_institutes i
    WHERE c.id = b.course_info_id
    AND i.id = b.training_institute_id";


    if (!empty($courseId)) {
        $sql .= " AND c.id = $courseId";
    }
    if (!empty($sectorName)) {
        $sql .= " AND c.course_sector = '$sectorName'";
    }
    if (!empty($location)) {
        $sql .= " AND i.present_district = '$location'";
    }
    if (!empty($trainingPartner)) {
        $sql .= " AND c.entity_id = $trainingPartner";
    }

    global $wpdb;
    $data = $wpdb->get_results(
        $wpdb->prepare($sql)
    );

    $output = [];
    if (!empty($data)) {
        foreach ($data as $item) {
            $output[$item->id] = $item->institute_name;
        }
    }
    return $output;
}

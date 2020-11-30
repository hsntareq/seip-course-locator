<?php
include('../../../wp-load.php');
global $wpdb;
$dataset = [];

$request = $_POST['field_type'];
$sectorName = $_POST['sector_name'];
$courseId = $_POST['course_name'];
$location = $_POST['location'];
$trainingPartner = $_POST['training_partner'];
$trainingInstitute = $_POST['training_institute'];
$searchSubmit = $_POST['search_courses'];

if ($request == 'sector_name') {
    $dataset['course_name'] = prepareCourseData($sectorName);
    $dataset['location'] = prepareLocationData($sectorName, $courseId);
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
    $dataset['batch_info'] = prepareBatchData($sectorName);
}
if ($request == 'course_name') {
    $dataset['location'] = prepareLocationData($sectorName, $courseId);
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
    $dataset['batch_info'] = prepareBatchData($sectorName, $courseId);
}
if ($request == 'location') {
    $dataset['training_partner'] = prepareTrainingPartnerData($sectorName, $courseId, $location);
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
    $dataset['batch_info'] = prepareBatchData($sectorName, $courseId, $location);
}
if ($request == 'training_partner') {
    $dataset['training_institute'] = prepareTrainingInstituteData($sectorName, $courseId, $location, $trainingPartner);
    $dataset['batch_info'] = prepareBatchData($sectorName, $courseId, $location, $trainingPartner);
}

if ($request == 'training_institute') {
    $dataset['batch_info'] = prepareBatchData($sectorName, $courseId, $location, $trainingPartner, $trainingInstitute);
}


echo json_encode($dataset);

function prepareBatchData($sectorName = null, $courseId = null, $location = null, $trainingPartner = null, $trainingInstitute = null)
{
    $sql = "SELECT i.id, i.institute_name, c.course_name, b.start_date, i.present_address,  i.web_url, i.phone, i.email
FROM tms_batch_info b, tms_course_info c, tms_training_institutes i, tms_entity e
WHERE b.course_info_id=c.id AND b.training_institute_id=i.id 
AND b.active_status=1 ";
    if (!empty($sectorName)) {
        $sql .= " AND c.course_sector = '$sectorName' ";
    }
    if (!empty($courseId)) {
        $sql .= " AND c.id= $courseId ";
    }
    if (!empty($location)) {
        $sql .= " AND i.present_district = '$location' ";
    }
    if (!empty($trainingInstitute)) {
        $sql .= " AND i.id = $trainingInstitute ";
    }
    if (!empty($trainingPartner)) {
        $sql .= " AND e.id = $trainingPartner ";
    }
    $sql .= " GROUP BY institute_name";
//    die($sql);
    global $wpdb;
    $data = $wpdb->get_results(
        $wpdb->prepare($sql)
    );

    return $data;
}


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

// $sql = "SELECT DISTINCT(c.course_name), b.start_date, b.training_location, i.institute_name, i.email, i.phone, i.web_url
// FROM tms_batch_info b, tms_course_info c, tms_entity e, tms_training_institutes i
// WHERE c.course_sector= 'Agro Food'
// AND c.id=251
// AND i.present_district='RAJSHAHI'
// AND e.id=30 
// GROUP BY course_name";
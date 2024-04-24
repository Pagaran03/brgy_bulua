<?php
// Include your database configuration file
include_once ('../../../config.php');
session_start();
// Function to sanitize input data
function sanitize_input($input)
{
    return filter_var($input, FILTER_SANITIZE_STRING);
}

// Get data from the POST request for prenatal_subjective
$patient_id = sanitize_input($_POST['patient_id']);
$height = sanitize_input($_POST['height']);
$weight = sanitize_input($_POST['weight']);
$temperature = sanitize_input($_POST['temperature']);
$pr = sanitize_input($_POST['pr']);
$rr = sanitize_input($_POST['rr']);
$bp = sanitize_input($_POST['bp']);
$menarche = sanitize_input($_POST['menarche']);
$lmp = sanitize_input($_POST['lmp']);
$gravida = sanitize_input($_POST['gravida']);
$para = sanitize_input($_POST['para']);
$fullterm = sanitize_input($_POST['fullterm']);
$preterm = sanitize_input($_POST['preterm']);
$abortion = sanitize_input($_POST['abortion']);
$stillbirth = sanitize_input($_POST['stillbirth']);
$alive = sanitize_input($_POST['alive']);
$hgb = sanitize_input($_POST['hgb']);
$ua = sanitize_input($_POST['ua']);
$vdrl = sanitize_input($_POST['vdrl']);
$nurse_id = sanitize_input($_POST['nurse_id']);
$date = date('Y-m-d');
$forceps_delivery = sanitize_input($_POST['forceps_delivery']);
$smoking = sanitize_input($_POST['smoking']);
$allergy_alcohol_intake = sanitize_input($_POST['allergy_alcohol_intake']);
$previous_cs = sanitize_input($_POST['previous_cs']);
$consecutive_miscarriage = sanitize_input($_POST['consecutive_miscarriage']);
$ectopic_pregnancy_h_mole = sanitize_input($_POST['ectopic_pregnancy_h_mole']);
$pp_bleeding = sanitize_input($_POST['pp_bleeding']);
$baby_weight_gt_4kgs = sanitize_input($_POST['baby_weight_gt_4kgs']);
$asthma = sanitize_input($_POST['asthma']);
$premature_contraction = sanitize_input($_POST['premature_contraction']);
$dm = sanitize_input($_POST['dm']);
$heart_disease = sanitize_input($_POST['heart_disease']);
$obesity = sanitize_input($_POST['obesity']);
$goiter = sanitize_input($_POST['goiter']);

// Remove script tags and ensure content is not empty
$patient_id = preg_replace("/<script.*?\/script>/", "", $patient_id);
$height = preg_replace("/<script.*?\/script>/", "", $height);
$weight = preg_replace("/<script.*?\/script>/", "", $weight);
$temperature = preg_replace("/<script.*?\/script>/", "", $temperature);
$pr = preg_replace("/<script.*?\/script>/", "", $pr);
$rr = preg_replace("/<script.*?\/script>/", "", $rr);
$bp = preg_replace("/<script.*?\/script>/", "", $bp);
$menarche = preg_replace("/<script.*?\/script>/", "", $menarche);
$lmp = preg_replace("/<script.*?\/script>/", "", $lmp);
$gravida = preg_replace("/<script.*?\/script>/", "", $gravida);
$para = preg_replace("/<script.*?\/script>/", "", $para);
$fullterm = preg_replace("/<script.*?\/script>/", "", $fullterm);
$preterm = preg_replace("/<script.*?\/script>/", "", $preterm);
$abortion = preg_replace("/<script.*?\/script>/", "", $abortion);
$stillbirth = preg_replace("/<script.*?\/script>/", "", $stillbirth);
$alive = preg_replace("/<script.*?\/script>/", "", $alive);
$hgb = preg_replace("/<script.*?\/script>/", "", $hgb);
$ua = preg_replace("/<script.*?\/script>/", "", $ua);
$vdrl = preg_replace("/<script.*?\/script>/", "", $vdrl);
$nurse_id = preg_replace("/<script.*?\/script>/", "", $nurse_id);
$forceps_delivery = preg_replace("/<script.*?\/script>/", "", $forceps_delivery);
$smoking = preg_replace("/<script.*?\/script>/", "", $smoking);
$allergy_alcohol_intake = preg_replace("/<script.*?\/script>/", "", $allergy_alcohol_intake);
$previous_cs = preg_replace("/<script.*?\/script>/", "", $previous_cs);
$consecutive_miscarriage = preg_replace("/<script.*?\/script>/", "", $consecutive_miscarriage);
$ectopic_pregnancy_h_mole = preg_replace("/<script.*?\/script>/", "", $ectopic_pregnancy_h_mole);
$pp_bleeding = preg_replace("/<script.*?\/script>/", "", $pp_bleeding);
$baby_weight_gt_4kgs = preg_replace("/<script.*?\/script>/", "", $baby_weight_gt_4kgs);
$asthma = preg_replace("/<script.*?\/script>/", "", $asthma);
$premature_contraction = preg_replace("/<script.*?\/script>/", "", $premature_contraction);
$dm = preg_replace("/<script.*?\/script>/", "", $dm);
$heart_disease = preg_replace("/<script.*?\/script>/", "", $heart_disease);
$obesity = preg_replace("/<script.*?\/script>/", "", $obesity);
$goiter = preg_replace("/<script.*?\/script>/", "", $goiter);

$sql_patient_id = "SELECT id FROM patients WHERE serial_no = ?";
$stmt_patient_id = $conn->prepare($sql_patient_id);
$stmt_patient_id->bind_param("s", $patient_id);
if ($stmt_patient_id->execute()) {
    $stmt_patient_id->bind_result($patient_id);
    if ($stmt_patient_id->fetch()) {
        // Now you have the patient_id
        $stmt_patient_id->close();

    } else {
        // Patient with the provided serial_no not found
        echo 'Error: Patient not found';
    }
} else {
    // Error executing the query
    echo 'Error: ' . $conn->error;
}

// Prepare and execute the SQL statement to insert into prenatal_subjective
$sql1 = "INSERT INTO prenatal_subjective (patient_id, height, weight, temperature, pr, rr, bp, menarche, lmp, gravida, para, fullterm, preterm, abortion, stillbirth, alive, hgb, ua, vdrl, forceps_delivery, smoking, allergy_alcohol_intake, previous_cs, consecutive_miscarriage, ectopic_pregnancy_h_mole, pp_bleeding, baby_weight_gt_4kgs, asthma, goiter, premature_contraction, obesity, heart_disease, checkup_date, doctor_id,nurse_id,dm) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param(
    "ssssssssssssssssssssssssssssssssssss",
    $patient_id,
    $height,
    $weight,
    $temperature,
    $pr,
    $rr,
    $bp,
    $menarche,
    $lmp,
    $gravida,
    $para,
    $fullterm,
    $preterm,
    $abortion,
    $stillbirth,
    $alive,
    $hgb,
    $ua,
    $vdrl,
    $forceps_delivery,
    $smoking,
    $allergy_alcohol_intake,
    $previous_cs,
    $consecutive_miscarriage,
    $ectopic_pregnancy_h_mole,
    $pp_bleeding,
    $baby_weight_gt_4kgs,
    $asthma,
    $goiter,
    $premature_contraction,
    $obesity,
    $heart_disease,
    $date,
    $doctor_id,
    $nurse_id,
    $dm
);


if ($stmt1->execute()) {
    // Get the last inserted ID
    $lastInsertedId = $conn->insert_id;

    // Get data from the POST request for prenatal_diagnosis
    $edc = strip_tags($_POST['edc']);
    $aog = strip_tags($_POST['aog']);
    $date_of_last_delivery = strip_tags($_POST['date_of_last_delivery']);
    $place_of_last_delivery = strip_tags($_POST['place_of_last_delivery']);
    $tt1 = strip_tags($_POST['tt1']);
    $tt2 = strip_tags($_POST['tt2']);
    $tt3 = strip_tags($_POST['tt3']);
    $tt4 = strip_tags($_POST['tt4']);
    $tt5 = strip_tags($_POST['tt5']);

    // Checkboxes for prenatal_diagnosis
    $multiple_sex_partners = isset ($_POST['multiple_sex_partners']) ? 1 : 0;
    $unusual_discharges = isset ($_POST['unusual_discharges']) ? 1 : 0;
    $itching_sores_around_vagina = isset ($_POST['itching_sores_around_vagina']) ? 1 : 0;
    $tx_for_stis_in_the_past = isset ($_POST['tx_for_stis_in_the_past']) ? 1 : 0;
    $pain_burning_sensation = isset ($_POST['pain_burning_sensation']) ? 1 : 0;
    $ovarian_cyst = isset ($_POST['ovarian_cyst']) ? 1 : 0;
    $myoma_uteri = isset ($_POST['myoma_uteri']) ? 1 : 0;
    $placenta_previa = isset ($_POST['placenta_previa']) ? 1 : 0;
    $still_birth = isset ($_POST['still_birth']) ? 1 : 0;
    $pre_eclampsia = isset ($_POST['pre_eclampsia']) ? 1 : 0;
    $eclampsia = isset ($_POST['eclampsia']) ? 1 : 0;
    $hpn = isset ($_POST['hpn']) ? 1 : 0;
    $uterine_myomectomy = isset ($_POST['uterine_myomectomy']) ? 1 : 0;
    $thyroid_disorder = isset ($_POST['thyroid_disorder']) ? 1 : 0;
    $epilepsy = isset ($_POST['epilepsy']) ? 1 : 0;
    $height_less_than_145cm = isset ($_POST['height_less_than_145cm']) ? 1 : 0;
    $family_history_gt_36cm = isset ($_POST['family_history_gt_36cm']) ? 1 : 0;

    // Prepare and execute the SQL statement to insert into prenatal_diagnosis
    $sql2 = "INSERT INTO prenatal_diagnosis (prenatal_subjective_id, patient_id, edc, aog, date_of_last_delivery, place_of_last_delivery, tt1, tt2, tt3, tt4, tt5, multiple_sex_partners, unusual_discharges, itching_sores_around_vagina, tx_for_stis_in_the_past, pain_burning_sensation, ovarian_cyst, myoma_uteri, placenta_previa, still_birth, pre_eclampsia, eclampsia, premature_contraction, hpn, uterine_myomectomy, thyroid_disorder, epilepsy, height_less_than_145cm, family_history_gt_36cm) 
    VALUES (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?,   ?, ?, ?, ?, ?,    ?, ?, ?, ?, ?,   ?, ?, ?, ?, ?,  ?, ?, ?, ?)";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param(
        "dssssssssssssssssssssssssssss",
        $lastInsertedId,
        $patient_id,
        $edc,
        $aog,
        $date_of_last_delivery,
        $place_of_last_delivery,
        $tt1,
        $tt2,
        $tt3,
        $tt4,
        $tt5,
        $multiple_sex_partners,
        $unusual_discharges,
        $itching_sores_around_vagina,
        $tx_for_stis_in_the_past,
        $pain_burning_sensation,
        $ovarian_cyst,
        $myoma_uteri,
        $placenta_previa,
        $still_birth,
        $pre_eclampsia,
        $eclampsia,
        $premature_contraction,
        $hpn,
        $uterine_myomectomy,
        $thyroid_disorder,
        $epilepsy,
        $height_less_than_145cm,
        $family_history_gt_36cm
    );


    if ($stmt2->execute()) {
        // Successful insertion for prenatal_diagnosis
        echo 'Success';
    } else {
        // Error handling for prenatal_diagnosis
        echo 'Error: ' . $conn->error;
    }

    // Close the database connection for prenatal_diagnosis
    $stmt2->close();
} else {
    // Error handling for prenatal_subjective
    echo 'Error: ' . $conn->error;
}

// Close the database connection for prenatal_subjective
$stmt1->close();
$conn->close();
?>
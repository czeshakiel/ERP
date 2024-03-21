<?php
include '../../meshes/alink.php';
ini_set('display_errors', 'on');
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);
$queryStatusSuccess = false;

if ($data === null) {
    echo 'Error decoding JSON data.';
} else {
    $slctdYear = $data['slctdYearData']['year'];
    $allEmpty = true;

    // Check if data already exists for the same year
    $queryCheckIfExists = $pdo->prepare("SELECT * FROM nbs_report_details WHERE year = ?");
    $queryCheckIfExists->execute([$slctdYear]);
    $existingData = $queryCheckIfExists->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $key => $value) {
        if (in_array($key, ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'])) {
            $month = $key;
            $monthData = $value;

            if (isset($monthData) && $monthData !== '') {
                $allEmpty = false;
                $totalDelv = $monthData['ttl_delv'];
                $totalNeod = $monthData['ttl_neod'];
                $totalLivb = $monthData['ttl_lvb'];
                $totalStbr = $monthData['ttl_stbr'];
                $totalInbns = $monthData['ttl_inbs'];
                $totalOnbns = $monthData['ttl_onbs'];
                $totalRefu = $monthData['ttl_refu'];
                $totalTran = $monthData['ttl_tran'];
                $reasonRefu = $monthData['reason_refu'];

                // Check if data already exists for the year and month
                $existingMonthData = array_filter($existingData, function ($row) use ($month) {
                    return $row['month'] === $month;
                });

                if ($existingMonthData) {
                    // Update existing data only for fields that have data
                    $updateFields = [];
                    $updateValues = [];

                    if ($totalDelv !== '') {
                        $updateFields[] = 'ttl_of_deliveries = ?';
                        $updateValues[] = $totalDelv;
                    }

                    if ($totalNeod !== '') {
                        $updateFields[] = 'ttl_of_neodths = ?';
                        $updateValues[] = $totalNeod;
                    }

                    if ($totalLivb !== '') {
                        $updateFields[] = 'ttl_of_livebirths = ?';
                        $updateValues[] = $totalLivb;
                    }

                    if ($totalStbr !== '') {
                        $updateFields[] = 'ttl_of_stillbirths = ?';
                        $updateValues[] = $totalStbr;
                    }

                    if ($totalInbns !== '') {
                        $updateFields[] = 'ttl_of_inbornscn = ?';
                        $updateValues[] = $totalInbns;
                    }

                    if ($totalOnbns !== '') {
                        $updateFields[] = 'ttl_of_outbornscn = ?';
                        $updateValues[] = $totalOnbns;
                    }

                    if ($totalRefu !== '') {
                        $updateFields[] = 'ttl_of_refusal = ?';
                        $updateValues[] = $totalRefu;
                    }

                    if ($totalTran !== '') {
                        $updateFields[] = 'ttl_of_transferred = ?';
                        $updateValues[] = $totalTran;
                    }

                    if ($reasonRefu !== '') {
                        $updateFields[] = 'reason_for_refu = ?';
                        $updateValues[] = $reasonRefu;
                    }

                    if ($updateFields) {
                        // Prepare and execute the update query
                        $updateFieldsStr = implode(', ', $updateFields);
                        $queryUpdateNbs = $pdo->prepare("UPDATE nbs_report_details SET $updateFieldsStr WHERE year = ? AND month = ?");
                        $updateValues[] = $slctdYear;
                        $updateValues[] = $month;

                        $queryStatusSuccess = $queryUpdateNbs->execute($updateValues);
                    }
                } else {
                    // Insert new data
                    $queryInsertNbs = $pdo->prepare("INSERT INTO nbs_report_details (year, month, ttl_of_deliveries, ttl_of_neodths, ttl_of_livebirths, ttl_of_stillbirths, ttl_of_inbornscn, ttl_of_outbornscn, ttl_of_refusal, reason_for_refu, ttl_of_transferred) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $queryStatusSuccess = $queryInsertNbs->execute([$slctdYear, $month, $totalDelv, $totalNeod, $totalLivb, $totalStbr, $totalInbns, $totalOnbns, $totalRefu, $reasonRefu, $totalTran]);
                }
            }
        }
    }

    if (!$queryStatusSuccess || $allEmpty) {
        echo 'failed';
    } else {
        echo 'success';
    }
}
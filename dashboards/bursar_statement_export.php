<?php
/**
 * Export student statement or all accounts to Excel (CSV / XLSX)
 */
require_once __DIR__ . '/../includes/staff_dashboard_access.php';
require_once __DIR__ . '/../includes/bursar_finance.php';

bootstrapStaffDashboard(['bursar', 'finance', 'accountant', 'school bursar']);

$studentId = trim($_GET['student_id'] ?? '');
$format = strtolower($_GET['format'] ?? 'excel');
$exportAll = isset($_GET['all']);

if ($exportAll) {
    $accounts = bursarGetStatementAccounts();
    $filename = 'isnm_fee_accounts_' . date('Y-m-d') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $out = fopen('php://output', 'w');
    fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
    fputcsv($out, ['Admission No', 'Student Name', 'Phone', 'Program', 'Academic Year', 'Total Fees', 'Paid', 'Balance', 'Status', 'Last Payment']);
    foreach ($accounts as $a) {
        $name = trim(($a['first_name'] ?? '') . ' ' . ($a['surname'] ?? ''));
        fputcsv($out, [
            $a['student_id'] ?? '',
            $name,
            $a['phone'] ?? '',
            $a['program'] ?? '',
            $a['academic_year'] ?? '',
            $a['total_fees'] ?? 0,
            $a['amount_paid'] ?? 0,
            $a['balance'] ?? 0,
            $a['status'] ?? '',
            $a['last_payment_date'] ?? '',
        ]);
    }
    fclose($out);
    exit;
}

if ($studentId === '') {
    http_response_code(400);
    die('student_id required');
}

$statement = bursarGetStudentStatement($studentId);
if (!$statement) {
    http_response_code(404);
    die('Student not found');
}

$autoload = __DIR__ . '/../vendor/autoload.php';
if ($format === 'xlsx' && file_exists($autoload)) {
    require_once $autoload;
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Fee Statement');
    $sheet->setCellValue('A1', 'Iganga School of Nursing and Midwifery — Fee Statement');
    $sheet->mergeCells('A1:F1');
    $row = 3;
    $fields = [
        'Student' => $statement['student_name'],
        'Admission No' => $statement['student_id'],
        'Program' => $statement['program'],
        'Total Fees' => $statement['total_fees'],
        'Paid' => $statement['amount_paid'],
        'Balance' => $statement['balance'],
    ];
    foreach ($fields as $label => $val) {
        $sheet->setCellValue('A' . $row, $label);
        $sheet->setCellValue('B' . $row, $val);
        $row++;
    }
    $row += 2;
    $headers = ['Date', 'Receipt', 'Method', 'Reference', 'Amount', 'Status'];
    foreach ($headers as $i => $h) {
        $sheet->setCellValue(chr(65 + $i) . $row, $h);
    }
    $row++;
    foreach ($statement['payments'] as $p) {
        $sheet->setCellValue('A' . $row, $p['payment_date'] ?? '');
        $sheet->setCellValue('B' . $row, $p['receipt_number'] ?? '');
        $sheet->setCellValue('C' . $row, $p['payment_method'] ?? '');
        $sheet->setCellValue('D' . $row, $p['payment_reference'] ?? '');
        $sheet->setCellValue('E' . $row, $p['amount_paid'] ?? $p['amount'] ?? 0);
        $sheet->setCellValue('F' . $row, $p['status'] ?? '');
        $row++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="statement_' . preg_replace('/[^a-z0-9]/i', '_', $studentId) . '.xlsx"');
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

$filename = 'statement_' . preg_replace('/[^a-z0-9]/i', '_', $studentId) . '_' . date('Y-m-d') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$out = fopen('php://output', 'w');
fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
fputcsv($out, ['Iganga School of Nursing and Midwifery — Student Fee Statement']);
fputcsv($out, ['Reference', $statement['statement_ref']]);
fputcsv($out, ['Generated', $statement['generated_at']]);
fputcsv($out, []);
fputcsv($out, ['Student Name', $statement['student_name']]);
fputcsv($out, ['Admission No', $statement['student_id']]);
fputcsv($out, ['Program', $statement['program']]);
fputcsv($out, ['Total Fees (UGX)', $statement['total_fees']]);
fputcsv($out, ['Amount Paid (UGX)', $statement['amount_paid']]);
fputcsv($out, ['Balance (UGX)', $statement['balance']]);
fputcsv($out, []);
fputcsv($out, ['Date', 'Receipt No', 'Method', 'Reference', 'Amount (UGX)', 'Status']);
foreach ($statement['payments'] as $p) {
    fputcsv($out, [
        $p['payment_date'] ?? '',
        $p['receipt_number'] ?? '',
        $p['payment_method'] ?? '',
        $p['payment_reference'] ?? '',
        $p['amount_paid'] ?? $p['amount'] ?? 0,
        $p['status'] ?? '',
    ]);
}
fclose($out);

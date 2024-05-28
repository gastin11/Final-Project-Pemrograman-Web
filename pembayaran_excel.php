<?php
include('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'NAMA');
$sheet->setCellValue('D1', 'TANGGAL');
$sheet->setCellValue('E1', 'STATUS PEMBAYARAN');

if (isset($_POST['ttanggal'])) {
    $ttanggal = $_POST['ttanggal'];
    $month = date('m', strtotime($ttanggal));
    $year = date('Y', strtotime($ttanggal));
    
    $data = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'");
}

$i = 2;
$no = 1;
while($d = mysqli_fetch_array($data))
{
    $sheet->setCellValue('A'.$i, $no++);
    $sheet->setCellValue('B'.$i, $d['id_pembayaran']);
    $sheet->setCellValue('C'.$i, $d['nama']);
    $sheet->setCellValue('D'.$i, $d['tanggal']);
    $sheet->setCellValue('E'.$i, $d['status_pembayaran']);   
    $i++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'Data_pembayaran_bulan_' . $month . '_' . $year . '.xlsx';
$writer->save($filename);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>

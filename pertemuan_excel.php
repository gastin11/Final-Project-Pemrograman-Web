<?php
include('koneksi.php');
require 'vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
 
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'LOKASI');
$sheet->setCellValue('D1', 'TANGGAL');
$sheet->setCellValue('E1', 'JAM');
 
$data = mysqli_query($koneksi,"select * from tb_pertemuan");
$i = 2;
$no = 1;
while($d = mysqli_fetch_array($data))
{
    $sheet->setCellValue('A'.$i, $no++);
    $sheet->setCellValue('B'.$i, $d['id_pertemuan']);
    $sheet->setCellValue('C'.$i, $d['lokasi']);
    $sheet->setCellValue('D'.$i, $d['tanggal']);
    $sheet->setCellValue('E'.$i, $d['jam']);   
    $i++;
}
 
$writer = new Xlsx($spreadsheet);
$writer->save('Data pertemuan.xlsx');
echo "<script>window.location = 'Data pertemuan.xlsx'</script>";
 
?>
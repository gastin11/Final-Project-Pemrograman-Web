<?php
include('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if (isset($_POST['ttahun'])) {
    $ttahun = $_POST['ttahun'];

    // Menambahkan header dengan tahun yang diinputkan
    $sheet->setCellValue('A1', 'Laporan Pertemuan Tahun ' . $ttahun);
    $sheet->mergeCells('A1:E1'); 
    $sheet->getStyle('A1')->getFont()->setBold(true); 
    $sheet->getStyle('A1')->getFont()->setSize(18); 

    $sheet->setCellValue('A2', 'No');
    $sheet->setCellValue('B2', 'ID');
    $sheet->setCellValue('C2', 'LOKASI');
    $sheet->setCellValue('D2', 'TANGGAL');
    $sheet->setCellValue('E2', 'JAM');

    $i = 3; 
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM tb_pertemuan WHERE YEAR(tanggal) = '$ttahun'");
    while ($d = mysqli_fetch_array($data)) {
        $sheet->setCellValue('A' . $i, $no++);
        $sheet->setCellValue('B' . $i, $d['id_pertemuan']);
        $sheet->setCellValue('C' . $i, $d['lokasi']);
        $sheet->setCellValue('D' . $i, $d['tanggal']);
        $sheet->setCellValue('E' . $i, $d['jam']);
        $i++;
    }

    // Simpan file Excel dengan nama yang sesuai tahun yang diinputkan
    $filename = 'Laporan Pertemuan ' . $ttahun . '.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
    
    // Redirect ke file yang telah disimpan
    echo "<script>window.location = '$filename'</script>";
} else {
    echo "Tahun tidak valid";
}
?>

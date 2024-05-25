<?php
require('./fpdf/fpdf.php');
include 'koneksi.php';

// Instance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(190, 10, 'DATA PERTEMUAN', 0, 1, 'C');

$pdf->Cell(10, 15, '', 0, 1);

$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(30, 7, 'ID', 1, 0, 'C');
$pdf->Cell(75, 7, 'LOKASI', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(40, 7, 'JAM', 1, 1, 'C');

$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM tb_pertemuan");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(30, 6, $d['id_pertemuan'], 1, 0, "C");
    $pdf->Cell(75, 6, $d['lokasi'], 1, 0);
    $pdf->Cell(35, 6, $d['tanggal'], 1, 0, "C");
    $pdf->Cell(40, 6, $d['jam'], 1, 1, "C");
}

$pdf->Output('I', 'Laporan_pertemuan.pdf');
?>

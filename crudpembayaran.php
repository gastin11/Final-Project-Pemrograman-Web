<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_pertemuan'])) {
        $id_pertemuan = $_POST['id_pertemuan'];

        // Fetch tanggal pertemuan
        $query_tanggal = "SELECT tanggal FROM tb_pertemuan WHERE id_pertemuan = '$id_pertemuan'";
        $result_tanggal = mysqli_query($koneksi, $query_tanggal);
        $row_tanggal = mysqli_fetch_assoc($result_tanggal);
        $tanggal = $row_tanggal['tanggal'];

        // Mulai transaksi
        mysqli_begin_transaction($koneksi);

        try {
            // Dapatkan semua anggota dari tb_anggota
            $query_anggota = "SELECT id_anggota, nama FROM tb_anggota";
            $result_anggota = mysqli_query($koneksi, $query_anggota);

            // Loop melalui setiap anggota dan simpan ke tb_pembayaran
            while ($row = mysqli_fetch_assoc($result_anggota)) {
                $id_anggota = $row['id_anggota'];
                $nama = $row['nama'];

                // Ambil id_pembayaran terakhir dan buat id_pembayaran baru
                $query_id = "SELECT MAX(id_pembayaran) AS maxKode FROM tb_pembayaran";
                $hasil_id = mysqli_query($koneksi, $query_id);
                $data_id = mysqli_fetch_array($hasil_id);

                $maxkode = $data_id['maxKode'];
                $nourut = 0;
                if ($maxkode) {
                    $nourut = (int) substr($maxkode, 3);
                }

                $nourut++;
                $char = 'BYR';
                $kodejadi = $char . sprintf("%03s", $nourut);

                // Simpan data ke database
                $query = "INSERT INTO tb_pembayaran (id_pembayaran, id_anggota, nama, id_pertemuan, tanggal, status_pembayaran, bukti) 
                          VALUES ('$kodejadi', '$id_anggota', '$nama', '$id_pertemuan', '$tanggal', 'Belum Lunas', '')";
                mysqli_query($koneksi, $query);
            }

            mysqli_commit($koneksi);

            echo "<script>
                    alert('Pembayaran berhasil disimpan');
                    document.location.href = 'detailpembayaran.php';
                  </script>";

        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            mysqli_rollback($koneksi);

            echo "<script>
                    alert('Terjadi kesalahan saat menyimpan data pembayaran');
                    document.location.href = 'pembayaran.php';
                  </script>";
        }
    } 
}

// Logika untuk edit dan hapus data
if(isset($_POST["btnedit"])){
    $id_pembayaran = $_POST['id_pembayaran'];
    $tanggal = $_POST['ttanggal'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $bukti_lama = $_POST['bukti_lama']; 
    $target_file = $bukti_lama; // Default target file adalah bukti lama

    if (!empty($_FILES["bukti"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["bukti"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["bukti"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Bukan file gambar";
            $uploadOk = 0;
        }

        if ($_FILES["bukti"]["size"] > 500000) {
            echo "Ukuran file terlalu besar";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Format file harus JPG, JPEG, PNG & GIF";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
                if ($bukti_lama && file_exists($bukti_lama)) {
                    unlink($bukti_lama);
                }
            } else {
                echo "Terjadi kesalahan saat upload";
            }
        } else {
            $target_file = $bukti_lama; // Tetap gunakan bukti lama jika upload gagal
        }
    }

    $edit = mysqli_query($koneksi, "UPDATE tb_pembayaran SET tanggal = '$tanggal', status_pembayaran = '$status_pembayaran', bukti = '$target_file' WHERE id_pembayaran = '$id_pembayaran'");

    if($edit){
        echo "<script>
                alert('Data berhasil di edit');
                document.location='detailpembayaran.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal di edit');
                document.location='detailpembayaran.php';
            </script>";
    }
}

if (isset($_POST["btnhapus"])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_pembayaran WHERE id_pembayaran = '$_POST[id_pembayaran]' ");

    if ($hapus) {
        echo "<script>
                alert('Data berhasil di hapus');
                document.location='detailpembayaran.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal di hapus');
                document.location='detailpembayaran.php';
              </script>";
    }
}
?>

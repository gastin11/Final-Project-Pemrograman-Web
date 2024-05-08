<?php

        include_once("koneksi.php");
        $lokasi = $_POST['tlokasi'];
        $tanggal = $_POST['ttanggal'];
        $jam = $_POST['tjam'];

        if(isset($_POST["btnsimpan"])){
            $simpan = mysqli_query($koneksi, "INSERT INTO tb_pertemuan (lokasi,tanggal,jam) VALUE ('$lokasi','$tanggal','$jam')");

            if($simpan){
                echo "<script>
                        alert('Data berhasil di simpan')
                        document.location='pertemuan.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di simpan')
                        document.location='pertemuan.php';
                    </script>";
            }
        }



        if(isset($_POST["btnedit"])){
            $edit = mysqli_query($koneksi, "UPDATE tb_pertemuan SET lokasi = '$_POST[tlokasi]', tanggal = '$_POST[ttanggal]', jam = '$_POST[tjam]' WHERE id_pertemuan = '$_POST[id_pertemuan]'");

            if($edit){
                echo "<script>
                        alert('Data berhasil di edit')
                        document.location='pertemuan.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di edit')
                        document.location='pertemuan.php';
                    </script>";
            }
        }

        
        if(isset($_POST["btnhapus"])){
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_pertemuan WHERE id_pertemuan = '$_POST[id_pertemuan]' ");

            if($hapus){
                echo "<script>
                        alert('Data berhasil di hapus')
                        document.location='pertemuan.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di hapus')
                        document.location='pertemuan.php';
                    </script>";
            }
        }

        if(isset($_POST["btnhapussemua"])){
            $hapussemua = mysqli_query($koneksi, "DELETE FROM tb_pertemuan");
        
            if($hapussemua){
                echo "<script>
                        alert('Semua data berhasil dihapus')
                        document.location='pertemuan.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Gagal menghapus semua data')
                        document.location='pertemuan.php';
                    </script>";
            }
        }
        


?>
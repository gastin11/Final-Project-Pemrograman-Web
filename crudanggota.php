<?php

        include_once("koneksi.php");
        $nama = $_POST['tnama'];
        $notelp = $_POST['tnotelp'];
        $email = $_POST['temail'];

        if(isset($_POST["btnsimpan"])){
            $simpan = mysqli_query($koneksi, "INSERT INTO tb_anggota (nama,noTelpon,email) VALUE ('$nama','$notelp','$email')");

            if($simpan){
                echo "<script>
                        alert('Data berhasil di simpan')
                        document.location='kelolaanggota.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di simpan')
                        document.location='kelolaanggota.php';
                    </script>";
            }
        }



        if(isset($_POST["btnedit"])){
            $edit = mysqli_query($koneksi, "UPDATE tb_anggota SET nama = '$_POST[tnama]', noTelpon = '$_POST[tnotelp]', email = '$_POST[temail]' WHERE id_anggota = '$_POST[id_anggota]'");

            if($edit){
                echo "<script>
                        alert('Data berhasil di edit')
                        document.location='kelolaanggota.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di edit')
                        document.location='kelolaanggota.php';
                    </script>";
            }
        }

        
        if(isset($_POST["btnhapus"])){
            $hapus = mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE id_anggota = '$_POST[id_anggota]' ");

            if($hapus){
                echo "<script>
                        alert('Data berhasil di hapus')
                        document.location='kelolaanggota.php';
                    </script>";
            }else{
                echo "<script>
                        alert('Data berhasil di hapus')
                        document.location='kelolaanggota.php';
                    </script>";
            }
        }


?>
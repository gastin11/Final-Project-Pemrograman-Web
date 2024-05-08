<?php

        include_once("koneksi.php");
        $nama = $_POST['tnama'];
        $notelp = $_POST['tnotelp'];
        $email = $_POST['temail'];

        if(isset($_POST["btnsimpan"])){
            $query_id = "SELECT max(id_anggota) as maxKode FROM tb_anggota";
            $hasil_id = mysqli_query($koneksi, $query_id);
            $data_id = mysqli_fetch_array($hasil_id);

            $maxkode = $data_id['maxKode'];
            $nourut = (int) substr($maxkode, 3);

            $nourut++;
            $char = 'AGT';
            $kodejadi = $char . sprintf("%03s", $nourut);

            $simpan = mysqli_query($koneksi, "INSERT INTO tb_anggota (id_anggota,nama,noTelpon,email) VALUE ('$kodejadi','$nama','$notelp','$email')");

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
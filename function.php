<?php 

$conn = mysqli_connect("localhost","root","","ujicoba");
// $conn = mysqli_connect("sql108.epizy.com","epiz_31493034","o1D4khGn0JoiCjn","epiz_31493034_ujicoba");


function getData($query){
    global $conn;
    $hasil= mysqli_query($conn, $query); //dapat datanya tapi masih berbentuk objek

    //maka dari itu perlu di fetch
    //mysqli_fetch_assoc($hasil); //tapi ini hanya dapat 1 data pertama

    //maka perlu di looping
    $penampung = [];
    while($row = mysqli_fetch_assoc($hasil)){
        $penampung[] = $row;  //ini kayak penampung.append(row)
    }
    return $penampung;


}


function upload(){

    // nb: $_FILES sama kayak $_GET atau $_POST tetapi menyimpan key yang beruhubngan dengan file
    // berasal dari form yang sudah ada att enctype="multipart/form-data ada di tambah_barang.php
    // name, size, error, tmp_name == tempat sementara sisanya searching sendiri gan:v
    $namaFile = $_FILES['foto_brg']['name']; //fotoKue.jpg
    $ukuranFile = $_FILES['foto_brg']['size'];
    $errorFile = $_FILES['foto_brg']['error'];
    $tmp_name_File = $_FILES['foto_brg']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    //nb: untuk angka error cari di gugel gan
    if($errorFile === 4){
        echo "<script>
                alert('pilih gambar terlebih dahulu')
            </script>";

        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);   //[ fotoKue,jpg]
    $ekstensiGambar = end($ekstensiGambar);     //[jpg]
    $ekstensiGambar = strtolower($ekstensiGambar);
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('yang Anda upload bukan gambar')
            </script>";
        
        return false;
    }

    //cek jika ukurannya terlalu besar (lebih dari 1500000b == 1.5mb)
    if($ukuranFile > 1500000){
        echo "<script>
                alert('gambar yang Anda upload lebih dari 1.5 mb')
            </script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload ke directory
    //generate namafilebaru memakai
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmp_name_File,"../img/".$namaFileBaru);


    return $namaFileBaru;

}


function addDataBarang($data){
    global $conn;
    
    //ambil dari setiap element yang sudah di submit di form
    // $nama_brg = $data["nama_brg"];
    // $jenis_brg = $data["jenis_brg"];
    // $berat_brg = $data["berat_brg"];
    // $harga_brg = $data["harga_brg"];
    // $foto_brg = $data["foto_brg"];
    
    //gunakan htmlspecialchars agar mengantisipasi hacker
    $nama_brg = htmlspecialchars($data["nama_brg"]);
    $jenis_brg = htmlspecialchars($data["jenis_brg"]);
    $berat_brg = htmlspecialchars($data["berat_brg"]);
    $harga_brg = htmlspecialchars($data["harga_brg"]);
    $status_brg = htmlspecialchars($data["status_brg"]);
    // $foto_brg = htmlspecialchars($data["foto_brg"]); //foto_brg diganti versi upload di line berikutnya
    
    //upload gambar
    $foto_brg = upload();
    if(!$foto_brg){
        return false;// kalo false gajadi nambah ke db
    }
    
    //untuk jenis barang harus di convert dari string ke id supaya cocok di db
    $idBarang = getData("SELECT jenis_barang_id FROM jenis_barang WHERE nama_jenis_barang = '$jenis_brg'");
    $jenis_brg = $idBarang[0]["jenis_barang_id"]; //array multidimensi ambil indeks ke-0 meskipun cuma 1 data

    //untuk status barang harus di convert dari string ke id supaya cocok di db
    $idBarang = getData("SELECT status_barang_id FROM status_barang WHERE nama_status = '$status_brg'");
    $status_brg = $idBarang[0]["status_barang_id"]; //array multidimensi ambil indeks ke-0 meskipun cuma 1 data
    
    
    //menyiapkan query, value pertama kosong karena id auto increment
    $query = "INSERT INTO barang VALUES('','$nama_brg','$harga_brg','$jenis_brg','$foto_brg','$berat_brg','$status_brg')";
    mysqli_query($conn, $query); 


    return mysqli_affected_rows($conn);
    
    
    
}

function deleteDataBarang($id, $namaFileGambar){
    global $conn;

    //menghapus file gambar dari dir
    unlink('../img/'.$namaFileGambar);

    //menghapus data barang dari db berdasarkan id
    mysqli_query($conn, "DELETE FROM barang WHERE barang_id = $id");


    return mysqli_affected_rows($conn);



}


function updateDataBarang($data){
    global $conn;
    //gunakan htmlspecialchars agar mengantisipasi hacker
    $id_brg = $data["id_brg"];
    $nama_brg = htmlspecialchars($data["nama_brg"]);
    $jenis_brg = htmlspecialchars($data["jenis_brg"]);
    $berat_brg = htmlspecialchars($data["berat_brg"]);
    $harga_brg = htmlspecialchars($data["harga_brg"]);
    $foto_brg_lama = htmlspecialchars($data["foto_brg_lama"]);


    //cek apakah saat mengubah data, user mengganti fotonya juga atau tetap memakai foto lama
    if($_FILES['foto_brg']['error'] === 4){ //kalo kosong pake yang lama
        $foto_brg = $foto_brg_lama;
    }

    else{                                   //kalo ga, pake yang baru
        $foto_brg = upload();
    }
    
    

    //untuk jenis barang harus di convert dari string ke id supaya cocok di database
    $idBarang = getData("SELECT jenis_barang_id FROM jenis_barang WHERE nama_jenis_barang = '$jenis_brg'");
    $jenis_brg = $idBarang[0]["jenis_barang_id"]; //array multidimensi ambil indeks ke-0 meskipun cuma 1 data


    //menyiapkan query
    $query = "UPDATE barang SET 
                nama_barang = '$nama_brg', 
                harga_barang = $harga_brg, 
                jenis_barang_id = '$jenis_brg', 
                berat_barang = '$berat_brg', 
                foto_barang = '$foto_brg' WHERE barang_id = $id_brg";

    mysqli_query($conn, $query); 

    return mysqli_affected_rows($conn);


}


function registration($data){
    global $conn;


    $username = $data["uname"];
    $username = stripslashes($username);  //biar gada backslash
    $username = strtolower($username);    
    $password = mysqli_real_escape_string($conn, $data["pass"]); //memungkinkan pw berisi kutip
    $password2 = mysqli_real_escape_string($conn, $data["pass2"]);

    //cek uname sudah ada atau belum
    $hasil = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($hasil)){
        echo "
        <script> 
        alert('username sudah ada');
        </script>";

        return false;
    }


    //cek jika pw1 tidak sama dengan pw2
    if ($password != $password2){
        echo "
        <script> 
        alert('password tidak sesuai');
        </script>";

        return false;
    }


    //enkripsi password
    $password = password_hash($password,PASSWORD_DEFAULT);

    //tambahkan akun admin ke db
    mysqli_query($conn,"INSERT INTO admin VALUES('','$username','$password')");

    //cek berhasil 
    if(mysqli_affected_rows($conn) > 0){
        echo "
        <script> 
        alert('akun berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
    else{
        echo "
        <script> 
        alert('akun tidak berhasil ditambahkan');
        </script>";
    }


}


?>
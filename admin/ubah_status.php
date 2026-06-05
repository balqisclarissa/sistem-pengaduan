if(isset($_POST['submit'])){

$status = $_POST['status'];

if(empty($status)){

    echo "<script>
        alert('Pilih status');
    </script>";

} else {

    $update = mysqli_query($conn,
    "UPDATE pengaduan
    SET status='$status'
    WHERE id_pengaduan='$id'");

    if($update){

        echo "<script>
            alert('Status berhasil diubah');
            window.location.href='index.php';
        </script>";

    } else {

        echo "<script>
            alert('Status gagal diubah');
        </script>";

    }
}
}
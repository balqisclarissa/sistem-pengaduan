<?php
session_start();
include '../config/koneksi.php';

$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan");
?>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nama Pelapor</th>
        <th>Isi Pengaduan</th>
        <th>Status</th>
        <th>Tanggapan</th>
        <th>Aksi</th>
    </tr>

    <?php while($data = mysqli_fetch_assoc($pengaduan)) { 

        $id_user = $data['id_user'];

        $user = mysqli_query($conn,
            "SELECT * FROM user WHERE id_user='$id_user'"
        );

        $data_user = mysqli_fetch_assoc($user);
    ?>

    <tr>

        <td><?= $data['id_pengaduan']; ?></td>
        <td><?= $data_user['nama_lengkap']; ?></td>
        <td><?= $data['isi_pengaduan']; ?></td>
        <td>
            <form action="ubah_status.php" method="POST">
                <input type="hidden"
                       name="id_pengaduan"
                       value="<?= $data['id_pengaduan']; ?>">

                <select name="status" onchange="this.form.submit()">

                    <option value="Menunggu"
                        <?= ($data['status'] == 'Menunggu') ? 'selected' : ''; ?>>
                        Menunggu
                    </option>

                    <option value="Diproses"
                        <?= ($data['status'] == 'Diproses') ? 'selected' : ''; ?>>
                        Diproses
                    </option>

                    <option value="Selesai"
                        <?= ($data['status'] == 'Selesai') ? 'selected' : ''; ?>>
                        Selesai
                    </option>

                </select>

            </form>
        </td>
        
        <td><?= $data['tanggapan']; ?></td>
        
        <td>
            <a href="tanggapan.php?id=<?= $data['id_pengaduan']; ?>">
                Tambah Tanggapan
            </a>

            |

            <a href="hapus_pengaduan.php?id=<?= $data['id_pengaduan']; ?>"
               onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">
                Hapus
            </a>
        </td>
    </tr>

    <?php } ?>

</table>
<?php
require '../function.php';

$barang = getData("SELECT * FROM barang");
$angka = 1;
?>
<html>

<head>
    <title>Stock Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <div class="container">
        <h2>Stock Bahan</h2>
        <h4>(Inventory)</h4>
        <div class="data-tables datatable-dark">

            <table class="table table-striped table-bordered" id="mauexport">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Edit</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Berat(gr)</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($barang as $b): ?>
                    <tr>
                        <!-- logic -->
                        <!-- nb: khusus jenis barang harus dicari berdasarkan id baru dapet nama_jenis_barang -->
                        <?php $jenis_barang = $b['jenis_barang_id']; $jenis_barang = getData("SELECT nama_jenis_barang FROM jenis_barang WHERE jenis_barang_id = $jenis_barang ")[0]['nama_jenis_barang']?>
                        <!-- main -->
                        <td><?= $angka++ ?></td>
                        <td>
                            <a href="ubah_barang.php?id=<?= $b['barang_id']  ?>"><button type="button"
                                    class="btn btn-warning">modif</button></a>
                            <a href="hapus_barang.php?id=<?= $b['barang_id']  ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><button
                                    type="button" class="btn btn-danger mt-1">hapus</button></a>
                        </td>
                        <td><img src="../img/<?= $b['foto_barang']  ?>" width="150px" /></td>
                        <td><?= $b['nama_barang']  ?></td>
                        <td><?= $jenis_barang  ?></td>
                        <td><?= $b['berat_barang']  ?></td>
                        <td><?= $b['harga_barang']  ?></td>
                        <!-- akhir main -->
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>
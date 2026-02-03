<?php if (session()->getFlashdata('success')): ?>
    <div id="notif-success" class="notif">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>

    <script>
        setTimeout(() => {
            const notif = document.getElementById('notif-success');
            if (notif) {
                notif.classList.add('show');
            }
        }, 100);

        setTimeout(() => {
            const notif = document.getElementById('notif-success');
            if (notif) {
                notif.classList.remove('show');
            }
        }, 3000);
    </script>
<?php endif; ?>
<?php $pager = $produk['pager'];  ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc("Data Produk") ?></title>
    <link rel="stylesheet" href="<?= ('https://localhost/programmer-test/public/css/form.css') ?>">
    <style>
        body { font-family: Arial, sans-serif; }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background: #f4f4f4;
        }
    </style>
</head>
<body>

<h2>Data Produk</h2>

<a href="<?= route_to('produk.create') ?>">+ Tambah Produk</a>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>

<?php foreach ($produk['produk'] as $i => $row): ?>
<tr>
    <td><?= $i+1 ?></td>
    <td><?= esc($row['nama_produk']) ?></td>
    <td><?= esc($row['nama_kategori']) ?></td>
    <td><?= esc($row['harga']) ?></td>
    <td>
        <a href="<?= route_to('produk.edit', $row['id_produk']) ?>">Edit</a> |
        <form action="<?= route_to('produk.delete', $row['id_produk']) ?>"
            method="post"
            style="display:inline"
            onsubmit="return confirm('Yakin ingin menghapus produk ini?');">

            <?= csrf_field() ?>

            <button type="submit">Hapus</button>
        </form>
    </td>
</tr>
<?php endforeach ?>
</table>

<div class ="pagination" style="margin-top:20px;">
    <?= $pager->links() ?>
</div>

<h3>API Debug</h3>

<div style="margin-top:20px; padding:15px; border:1px solid #ccc;">
    <strong>Status Code:</strong>
    <?= esc($apiDebug['status']) ?>
</div>
<div style="margin-top:20px;">
    <h4>Response Body</h4>
    <pre style="background:#f9fafb; padding:15px; max-height:300px; overflow:auto;">
<?= esc(json_encode($apiDebug['body'], JSON_PRETTY_PRINT)) ?>
    </pre>
</div>
<div style="margin-top:20px;">
    <h4>Response Headers</h4>
    <pre style="background:#f3f4f6; padding:15px;">
<?= esc(print_r($apiDebug['headers'], true)) ?>
    </pre>
</div>
<div style="margin-top:20px;">
    <h4>Cookies</h4>
    <pre style="background:#fefce8; padding:15px;">
<?= esc($apiDebug['cookies'] ?: 'Tidak ada cookie') ?>
    </pre>
</div>
</body>
</html>
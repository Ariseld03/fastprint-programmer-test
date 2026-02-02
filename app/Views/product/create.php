<link rel="stylesheet" href="<?= ('https://localhost/programmer-test/public/css/form.css') ?>">

<div class="form-container">
    <h2>Tambah Produk</h2>

    <form action="<?= route_to('produk.store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= old('nama_produk') ?>">

            <?php if (isset($validation) && $validation->hasError('nama_produk')): ?>
                <div class="error-text">
                    <?= $validation->getError('nama_produk') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= old('harga') ?>">

            <?php if (isset($validation) && $validation->hasError('harga')): ?>
                <div class="error-text">
                    <?= $validation->getError('harga') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>"
                        <?= old('kategori_id') == $k['id_kategori'] ? 'selected' : '' ?>>
                        <?= esc($k['nama_kategori']) ?>
                    </option>
                <?php endforeach ?>
            </select>

            <?php if (isset($validation) && $validation->hasError('kategori_id')): ?>
                <div class="error-text">
                    <?= $validation->getError('kategori_id') ?>
                </div>
            <?php endif ?>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="<?= route_to('produk.index') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

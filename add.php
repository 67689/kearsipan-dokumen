<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Header halaman -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Arsip</h1> <!-- Judul halaman -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> <!-- Breadcrumb navigasi -->
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= route_to('arsip.index'); ?>">Arsip</a></li>
                        <li class="breadcrumb-item active">Tambah Arsip</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Card Form Tambah Arsip -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Arsip</h3>
                        </div>

                        <!-- Form mulai -->
                        <?= form_open_multipart('arsip/create') ?> <!-- Form multipart untuk upload file -->
                        <?= csrf_field(); ?> <!-- Proteksi CSRF -->

                        <div class="card-body">

                            <!-- Flashdata pesan sukses / error -->
                            <?php if (session()->getFlashdata('success')) : ?>
                                <?= view_cell('AlertMessageCell', ['type' => 'success', 'message' => session()->getFlashdata('success')]) ?>
                            <?php elseif (session()->getFlashdata('error')) : ?>
                                <?= view_cell('AlertMessageCell', ['type' => 'error', 'message' => session()->getFlashdata('error')]) ?>
                            <?php endif; ?>

                            <!-- Tampilkan list error validasi jika ada -->
                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>

                            <!-- Judul Arsip: Input Text untuk Semua Role -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="judulArsip">Judul Arsip</label>
                                        <input type="text" name="judulArsip" class="form-control" id="judulArsip"
                                            value="<?= old('judulArsip') ?>" placeholder="Masukkan Judul Arsip" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Input tanggal arsip -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal"
                                            value="<?= old('tanggal') ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Pilih tahun (dari tabel fonds_tahun) -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <select name="tahun" class="form-control" id="tahun" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            <?php foreach ($fondstahun as $ft): ?>
                                                <option value="<?= esc($ft['id']) ?>" <?= old('tahun') == $ft['id'] ? 'selected' : '' ?>>
                                                    <?= esc($ft['tahun']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php if (session()->get('role') == 1): ?> <!-- Hanya Admin bisa isi informasi -->
                                <div class="form-group">
                                    <label for="informasi">Informasi</label>
                                    <select name="informasi" id="informasi" class="form-control" required>
                                        <option value="">-- Pilih Informasi Arsip --</option>
                                        <option value="Publik" <?= old('informasi') == 'Publik' ? 'selected' : '' ?>>Publik</option>
                                        <option value="Private" <?= old('informasi') == 'Private' ? 'selected' : '' ?>>Private</option>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <!-- Jenis arsip: suara, gambar, video, dokumen -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenisArsip">Pilih Arsip</label>
                                        <select name="jenisArsip" id="jenisArsip" class="form-control" required>
                                            <option value="" disabled selected>-- Pilih jenis arsip --</option>
                                            <option value="Suara" <?= old('jenisArsip') === 'Suara' ? 'selected' : '' ?>>Suara</option>
                                            <option value="Gambar" <?= old('jenisArsip') === 'Gambar' ? 'selected' : '' ?>>Gambar</option>
                                            <option value="Video" <?= old('jenisArsip') === 'Video' ? 'selected' : '' ?>>Video</option>
                                            <option value="Dokumen" <?= old('jenisArsip') === 'Dokumen' ? 'selected' : '' ?>>Dokumen</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Input upload file utama -->
                            <div class="form-group">
                                <label for="uploadFileArsip">Upload File Arsip</label>
                                <input type="file" name="uploadFileArsip" class="form-control" id="uploadFileArsip" required>
                                <small class="form-text text-muted">*Format: .doc/.pdf/.mp3/.mp4/.jpg</small>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="card-footer">
                                <a href="<?= url_to('arsip.index') ?>" class="btn btn-default">Kembali</a> <!-- Tombol kembali -->
                                <button type="submit" class="btn btn-primary" style="float:right">Tambah Data</button> <!-- Tombol submit -->
                            </div>

                        </div> <!-- /.card-body -->
                        <?= form_close() ?> <!-- Penutup form -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
</div>

<!-- Script untuk mengaktifkan dropdown jenisDokumen hanya jika subfonds dokumen dipilih -->
<script>
    document.getElementById('subFonds').addEventListener('change', function() {
        const jenisDokumen = document.getElementById('jenisDokumen');
        const selected = this.value.toLowerCase();

        if (selected.includes('dokumen')) {
            jenisDokumen.removeAttribute('disabled');
        } else {
            jenisDokumen.setAttribute('disabled', 'disabled');
            jenisDokumen.selectedIndex = 0;
        }
    });
</script>

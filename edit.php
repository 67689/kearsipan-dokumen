<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Arsip</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= route_to('arsip.index'); ?>">Arsip</a></li>
                        <li class="breadcrumb-item active">Edit Arsip</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Arsip</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <?= form_open_multipart(route_to('arsip.update', $arsip['id'])) ?>
                        <?= csrf_field(); ?>
                        <div class="card-body">

                            <?php if (session()->getFlashdata('success')) : ?>
                                <?= view_cell('AlertMessageCell', ['type' => 'success', 'message' => session()->getFlashdata('success')]) ?>
                            <?php elseif (session()->getFlashdata('error')) : ?>
                                <?= view_cell('AlertMessageCell', ['type' => 'error', 'message' => session()->getFlashdata('error')]) ?>
                            <?php endif; ?>

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
                                            value="<?= old('judulArsip', $arsip['judul_arsip']) ?>" placeholder="Masukkan Judul Arsip" required>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal"
                                            value="<?= old('tanggal', $arsip['tanggal']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown Tahun -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <select name="tahun" class="form-control" id="tahun" required>
                                            <option value="" disabled <?= old('tahun', $arsip['tahun'] ?? '') === '' ? 'selected' : '' ?>>Pilih Tahun</option>
                                            <?php foreach ($fondstahun as $ft): ?>
                                                <option value="<?= $ft['tahun'] ?>"
                                                    <?= old('tahun', $arsip['tahun'] ?? '') == $ft['tahun'] ? 'selected' : '' ?>>
                                                    <?= $ft['tahun'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown Jenis Arsip -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenisArsip">Pilih Arsip</label>
                                        <select name="jenisArsip" class="form-control" id="jenisArsip" required>
                                            <option value="" disabled <?= old('jenisArsip', $arsip['jenis_arsip'] ?? '') === '' ? 'selected' : '' ?>>Pilih Jenis Arsip</option>
                                            <?php
                                            $options = ['Suara', 'Gambar', 'Video', 'Dokumen'];
                                            foreach ($options as $opt):
                                            ?>
                                                <option value="<?= $opt ?>" <?= old('jenisArsip', $arsip['jenis_arsip'] ?? '') === $opt ? 'selected' : '' ?>>
                                                    <?= $opt ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php if (session()->get('role') == 1): ?>
                                <div class="form-group">
                                    <label for="informasi">Informasi</label>
                                    <select name="informasi" id="informasi" class="form-control" required>
                                        <option value="">-- Pilih Informasi Arsip --</option>
                                        <option value="Publik" <?= (old('informasi', $arsip['informasi'] ?? '') == 'Publik') ? 'selected' : '' ?>>Publik</option>
                                        <option value="Private" <?= (old('informasi', $arsip['informasi'] ?? '') == 'Private') ? 'selected' : '' ?>>Private</option>
                                    </select>
                                </div>
                            <?php endif; ?>



                            <div class="form-group">
                                <label for="uploadFileArsip">Upload File Arsip</label>
                                <input type="file" name="uploadFileArsip" class="form-control" id="uploadFileArsip">
                                <small class="form-text text-muted">*Format: .doc/.pdf/.mp3/.mp4/.jpg</small>
                            </div>

                            <?php
                            $folderMapping = [
                                'Suara'   => 'audio/',
                                'Gambar'  => 'gambar/',
                                'Video'   => 'video/',
                                'Dokumen' => 'dokumen/',
                            ];
                            $jenis = $arsip['jenis_arsip'];
                            $folder = $folderMapping[$jenis] ?? '';
                            ?>

                            <?php if (!empty($arsip['file_upload'])): ?>
                                <p>File Saat Ini:
                                    <a href="<?= base_url('/' . $folder . $arsip['file_upload']) ?>" target="_blank">
                                        <?= esc($arsip['file_upload']) ?>
                                    </a>
                                </p>
                            <?php endif; ?>





                            <!-- <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="subfondSuara">Upload Sub Fonds Suara</label>
                                    <input type="file" name="subfondSuara" class="form-control" id="subfondSuara">
                                    <small class="form-text text-muted">*Masukan item dengan format .mp3</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subfondGambar">Upload Sub Fonds Gambar</label>
                                    <input type="file" name="subfondGambar" class="form-control" id="subfondGambar">
                                    <small class="form-text text-muted">*Masukan item dengan format .jpg</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="subfondVideo">Upload Sub Fonds Video</label>
                                    <input type="file" name="subfondVideo" class="form-control" id="subfondVideo">
                                    <small class="form-text text-muted">*Masukan item dengan format .mp4</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="suratKeluar">Upload Dokumen Surat Keluar</label>
                                    <input type="file" name="suratKeluar" class="form-control" id="suratKeluar">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="suratMasuk">Upload Dokumen Surat Masuk</label>
                                    <input type="file" name="suratMasuk" class="form-control" id="suratMasuk">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="suratKeputusan">Upload Dokumen Surat Keputusan</label>
                                    <input type="file" name="suratKeputusan" class="form-control" id="suratKeputusan">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="keuangan">Upload Dokumen Keuangan</label>
                                    <input type="file" name="keuangan" class="form-control" id="keuangan">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pembayaranListrik">Upload Dokumen Pembayaran Listrik</label>
                                    <input type="file" name="pembayaranListrik" class="form-control" id="pembayaranListrik">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="pembayaranPAM">Upload Dokumen Pembayaran PAM</label>
                                    <input type="file" name="pembayaranPAM" class="form-control" id="pembayaranPAM">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="internet">Upload Dokumen Internet</label>
                                    <input type="file" name="internet" class="form-control" id="internet">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tagihanSiswa">Upload Dokumen Tagihan Siswa</label>
                                    <input type="file" name="tagihanSiswa" class="form-control" id="tagihanSiswa">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="berita">Upload Dokumen Berita</label>
                                    <input type="file" name="berita" class="form-control" id="berita">
                                    <small class="form-text text-muted">*Masukan item dengan format .doc/.pdf</small>
                                </div>
                            </div> -->

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="<?= url_to('arsip.index') ?>" class="btn btn-default">Kembali</a>
                                <button type="submit" class="btn btn-primary" style="float:right">Edit Data</button>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    document.getElementById('subFonds').addEventListener('change', function() {
        const jenisDokumen = document.getElementById('jenisDokumen');
        const selected = this.value.toLowerCase();

        if (selected.includes('dokumen')) {
            jenisDokumen.removeAttribute('disabled');
        } else {
            jenisDokumen.setAttribute('disabled', 'disabled');
            jenisDokumen.selectedIndex = 0; // reset ke pilihan awal
        }
    });
</script>
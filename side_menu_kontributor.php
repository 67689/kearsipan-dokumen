<?php
// Load database connection if belum diload
$db = \Config\Database::connect();

// Ambil daftar tahun dari tabel fonds_tahun
$list_tahun = $db->table('fonds_tahun')
    ->select('tahun,id',)
    ->orderBy('tahun', 'DESC')
    ->get()
    ->getResultArray();
?>
<!-- <li class="nav-item">
    <a href="<?= route_to('dashboard.index') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= route_to('profile.index') ?>" class="nav-link">
        <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
        <p>
            Profil
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= route_to('users.index') ?>" class="nav-link">
        <i class="nav-icon fas fa-user" aria-hidden="true"></i>
        <p>
            Pengguna
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= route_to('arsip.index') ?>" class="nav-link">
        <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
        <p>
            Arsip
        </p>
    </a>
</li> -->


<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
        <p>
            Dashboard Menu
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= route_to('profile.index') ?>" class="nav-link">
        <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
        <p>
            Profil
        </p>
    </a>
</li>

<?php foreach ($list_tahun as $row): ?>
    <li class="nav-item">
        <a href="<?= route_to('arsip.index') . '?id=' . $row['id'] ?>" class="nav-link">
            <i class="far fa-calendar-alt nav-icon"></i>
            <p>
                <?= esc($row['tahun']) ?>
            </p>
        </a>
    </li>
<?php endforeach; ?>

<!-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
        <p>
            Dashboard Menu
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= route_to('profile.index') ?>" class="nav-link" style="padding-left: 20px;">
                <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
                <p>
                    Profil
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('users.index') ?>" class="nav-link" style="padding-left: 20px;">
                <i class="nav-icon fas fa-user" aria-hidden="true"></i>
                <p>
                    Anggota
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('arsip.index') ?>" class="nav-link" style="padding-left: 20px;">
                <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
                <p>
                    Arsip
                </p>
            </a>
        </li>
    </ul>
</li> -->

<!-- <?php if (false): ?>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
            <p>
                Fonds Tahun
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php foreach ($list_tahun as $row): ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" style="padding-left: 20px;">
                        <i class="far fa-calendar-alt nav-icon"></i>
                        <p>
                            <?= esc($row['tahun']) ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?= view('partial/sub_fonds_tahun', ['id' => $row['id']]) ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
<?php endif; ?> -->

<!-- <li class="nav-item">
    <a href="<?= route_to('sub_fonds.sub_fonds_2') ?>" class="nav-link" style="padding-left: 60px;">
        <i class="far fa-circle nav-icon"></i>
        <p>Sub Fonds 2</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= route_to('sub_fonds.sub_fonds_3') ?>" class="nav-link" style="padding-left: 60px;">
        <i class="far fa-circle nav-icon"></i>
        <p>Sub Fonds 3</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= route_to('sub_fonds.sub_fonds_4') ?>" class="nav-link" style="padding-left: 60px;">
        <i class="far fa-circle nav-icon"></i>
        <p>Sub Fonds 4</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= route_to('sub_fonds.sub_fonds_5') ?>" class="nav-link" style="padding-left: 60px;">
        <i class="far fa-circle nav-icon"></i>
        <p>Sub Fonds 5</p>
    </a>
</li> -->

<!-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
        <p>
            Sifat
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= route_to('sifat.statis') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Statis</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('sifat.dinamis') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Dinamis</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
        <p>
            Eksistensi
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= route_to('eksistensi.aktif') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Aktif</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('eksistensi.nonaktif') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Non Aktif</p>
            </a>
        </li>
    </ul>
</li> -->

<!-- <li class="nav-item">
    <a href="<?= route_to('bentuk_arsip.index') ?>" class="nav-link">
        <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
        <p>
            Bentuk Arsip
        </p>
    </a>
</li> -->
<!-- 
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-folder-open" aria-hidden="true"></i>
        <p>
            Tahun
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= route_to('tahun.2022') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>2022</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('tahun.2023') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>2023</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('tahun.2024') ?>" class="nav-link" style="padding-left: 30px;">
                <i class="far fa-circle nav-icon"></i>
                <p>2024</p>
            </a>
        </li>
    </ul>
</li> -->
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
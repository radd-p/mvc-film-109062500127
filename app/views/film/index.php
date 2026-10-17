<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Film</h2>

        <?php if ($flash): ?>
            <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <a class="btn" href="index.php?page=film&action=create">+ Tambah Film</a>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Sutradara</th>
                    <th>Genre</th>
                    <th>Tahun</th>
                    <th>Durasi</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
                <?php if (empty($films)): ?>
                    <tr><td colspan="8" class="empty">Belum ada data film.</td></tr>
                <?php endif; ?>
                <?php foreach ($films as $i => $f): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($f['judul']) ?></td>
                    <td><?= htmlspecialchars($f['sutradara']) ?></td>
                    <td><?= htmlspecialchars($f['genre']) ?></td>
                    <td><?= (int) $f['tahun_rilis'] ?></td>
                    <td><?= (int) $f['durasi'] ?> menit</td>
                    <td><?= htmlspecialchars($f['rating']) ?></td>
                    <td class="aksi">
                        <a class="btn btn-sm" href="index.php?page=film&action=edit&id=<?= (int) $f['id'] ?>">Edit</a>
                        <form method="post" action="index.php?page=film&action=delete" style="display:inline" onsubmit="return confirm('Hapus film ini?')">
                            <input type="hidden" name="id" value="<?= (int) $f['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
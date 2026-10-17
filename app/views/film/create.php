<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Film</h2>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?page=film\&action=store">
            <label>Judul</label>
            <input type="text" name="judul" maxlength="150" value="<?= htmlspecialchars($old['judul'] ?? '') ?>" required>

            <label>Sutradara</label>
            <input type="text" name="sutradara" maxlength="100"
                value="<?= htmlspecialchars($old['sutradara'] ?? '') ?>" required>

            <label>Genre</label>
            <select name="genre" required>
                <option value="">-- Pilih genre --</option>
                <?php foreach ($genreList as $g): ?>
                    <option value="<?= htmlspecialchars($g) ?>"
                        <?= ($old['genre'] ?? '') === $g ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Tahun Rilis</label>
            <input type="number" name="tahun_rilis" min="1888"
                value="<?= htmlspecialchars($old['tahun_rilis'] ?? '') ?>" required>

            <label>Durasi (menit)</label>
            <input type="number" name="durasi" min="1"
                value="<?= htmlspecialchars($old['durasi'] ?? '') ?>" required>

            <label>Rating (0 - 10)</label>
            <input type="number" name="rating" min="0" max="10" step="0.1"
                value="<?= htmlspecialchars($old['rating'] ?? '') ?>" required>

            <div class="form-actions">
                <button type="submit" class="btn">Simpan</button>
                <a href="index.php?page=film">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
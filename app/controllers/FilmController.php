<?php
class FilmController
{
    private const GENRE = [
        'Aksi', 'Drama', 'Komedi', 'Horor', 'Romantis', 'Fiksi Ilmiah', 'Animasi', 'Dokumenter', 'Thriller'
    ];

    public function __construct(private Film $model) {}

    public function index(): void 
    {
        $films = $this->model->getAll();
        $flash = $this->pull('flash');
        require __DIR__ . '/../views/film/index.php';
    }

    public function create(): void 
    {
        $genreList = self::GENRE;
        $errors    = $this->pull('errors') ?? [];
        $old       = $this->pull('old') ?? [];
        require __DIR__ . '/../views/film/index.php';
    }

    public function store(): void 
    {
        $this->requirePost();
        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $old;
            $thist->redirect('index.php?page=film&action=create');
        }

        try {
            $this->model->insert($data);
            $this->flas('success', 'Film berhasil ditambahkan.');
        } catch(PDOException $e) {
            $this->flash('error', 'Gagal menyimpan data film.');
        }
        $this->redirect('index.php?page=film');
    }

    public function edit(): void 
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $film = $this->model->findById($id);

        if (!$film) {
            http_response_code(404);
            exit('Data tidak ditemukan.');
        }

        $genrelist = self::GENRE;
        $errors    = $this->pull('errors') ?? [];
        $old       = $this->pull('old') ?? $film;
        require __DIR__ . '/../views/film/edit.php';
    } 

    public function update(): void 
    {
        $this->requirePost();
        $id = (int) ($_POST['id'] ?? 0);

        if (!$this->model->findById($id)) {
            $this->flash('error', 'Data tidak ditemukan.');
            $this->redirect('index.php?page=film');
        }

        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            $this-->redirect('index.php?page=film&action=edit&id=' . $id);
        }

        try {
            $this->model->update($id, $data);
            $this->flash('success', 'Film berhasil diperbarui.');
        } catch (PDOException $e) {
            $this->flash('error', 'Gagal memperbarui data film');
        }
        $this->redirect('index.php?page=film');
    }

    /* ------------- helper ----------------- */

    private function validateInput(array $input): array
    {
        $data = [
            'judul'       => trim($input['judul'] ?? ''),
            'sutradara'   => trim($input['sutradara'] ?? ''),
            'genre'       => trim($input['genre'] ?? ''),
            'tahun_rilis' => trim($input['tahun_rilis'] ?? ''),
            'durasi'      => trim($input['durasi'] ?? ''),
            'rating'      => trim($input['rating'] ?? '')
        ];
        $errors = [];

        if ($data['judul'] === '') {
            $errors[] = 'Judul wajib diisi.';
        } elseif (mb_strlen($data['judul']) > 150) {
            $errors[] = 'Judul maksimal 150 karakter.';
        }

        if ($data['sutradara'] === '') {
            $errors[] = 'Sutradara wajib diisi.';
        } elseif (mb_strlen($data['sutradara']) > 100) {
            $errors[] = 'Sutradara maksimal 100 karakter.';
        }

        if (!in_array($data['genre'], self::GENRE, true)) {
            $errors[] = 'Genre wajib dipilih dari daftar.';
        }

        $maxYear = (int) date('Y') + 5;
        if (filter_var($data['tahun_rilis'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1888, 'max_range' => $maxYear]
        ]) === false) {
            $errors[] = "Tahun rilis harus berupa angka antara 1888 dan $maxYear.";
        }

        if (filter_var($data['durasi'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 1000]
        ]) === false) {
            $errors[] = 'Durasi harus berupa angka (menit) antara 1 dan 1000.';
        }

        $rating = filter_var($data['rating'], FILTER_VALIDATE_FLOAT);
        if ($rating === false || $rating < 0 || $rating > 10) {
            $errors[] = 'Rating harus berupa angka antara 0 dan 10.';
        }

        return [$data, $errors];
    }

    private function requirePost(): void 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode request tidak diizinkan.');
        }
    }

    private function flash(string $type, string $message): void 
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    private function pull(string $key): mixed
    {
        $value =$_SESSION[$key] ?? null;
        unset($_SESSION[$key]);
        return $value;
    }

    private function redirect(string $url): never
    {
        header('Location: ' . $url);
        exit;
    }
}
?>
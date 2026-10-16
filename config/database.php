<?php
class database
{
    private string $host = 'localhost';
    private string $db   = 'movies';
    private string $user = 'root';
    private string $pass = '';

    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db}; charset=utf8mb4";

        return new PDO ($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_NODE => PDO::FETCH_ASSOC
        ]);
    }
}
?>
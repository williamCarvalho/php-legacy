<?php

class Database
{
    private string $host = 'localhost';
    private string $db_name = 'os_management';
    private string $username = 'root';
    private string $password = '';
    private ?PDO $conn = null;

    public function getConnection(): ?PDO
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";

            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $exception) {
            http_response_code(500);

            echo json_encode([
                "message" => "Database connection error: " . $exception->getMessage()
            ]);

            exit;
        }

        return $this->conn;
    }
}

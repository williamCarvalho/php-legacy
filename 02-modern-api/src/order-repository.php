<?php

class OrderRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM service_orders ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO service_orders (name, description, value, status) VALUES (:name, :description, :value, 'P')"
        );

        $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'],
            ':value'       => $data['value']
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE service_orders SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
}

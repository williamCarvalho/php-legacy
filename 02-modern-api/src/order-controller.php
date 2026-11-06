<?php

class OrderController
{
    private OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): void
    {
        $orders = $this->repository->findAll();
        http_response_code(200);
        echo json_encode(["data" => $orders]);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['name']) || empty($data['description']) || !isset($data['value'])) {
            http_response_code(400);
            echo json_encode(["message" => "Incomplete data for creating the service order."]);
            return;
        }

        $id = $this->repository->create($data);
        http_response_code(201);
        echo json_encode(["message" => "Service order successfully created!", "id" => $id]);
    }

    public function updateStatus(int $id): void
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['status'])) {
            http_response_code(400);
            echo json_encode(["message" => "Status not provided."]);
            return;
        }

        $success = $this->repository->updateStatus($id, $data['status']);

        if (!$success) {
            http_response_code(500);
            echo json_encode(["message" => "Error updating status."]);
            return;
        }

        http_response_code(200);
        echo json_encode(["message" => "Status updated successfully."]);
    }
}

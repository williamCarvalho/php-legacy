<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../src/database.php';
require_once __DIR__ . '/../src/order-repository.php';
require_once __DIR__ . '/../src/order-controller.php';

$db = new Database();
$connection = $db->getConnection();
$repository = new OrderRepository($connection);
$controller = new OrderController($repository);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = $requestUri;
if (strpos($requestUri, '/public/') !== false) {
    $uri = substr($requestUri, strpos($requestUri, '/public') + strlen('/public'));
}

$uri = '/' . trim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/api/orders' && $method === 'GET') {
    $controller->index();
    return;
}

if ($uri === '/api/orders' && $method === 'POST') {
    $controller->store();
    return;
}

if (preg_match('/^\/api\/orders\/(\d+)\/status$/', $uri, $matches) && $method === 'PUT') {
    $controller->updateStatus((int)$matches[1]);
    return;
}

http_response_code(404);
echo json_encode(["message" => "Endpoint not found"]);

<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../config/database.php'; require_once __DIR__ . '/../../../src/SaleService.php';
session_start(); header('Content-Type: application/json');
if (empty($_SESSION['user'])) { http_response_code(401); echo json_encode(['error'=>'Authentication required']); exit; }
$input = json_decode(file_get_contents('php://input'), true) ?: [];
try { $id=(new SaleService(db()))->register((int)$_SESSION['user']['id'],$input['items']??[],(float)($input['payment']??0)); http_response_code(201); echo json_encode(['sale_id'=>$id]); }
catch (InvalidArgumentException|RuntimeException $error) { http_response_code(422); echo json_encode(['error'=>$error->getMessage()]); }

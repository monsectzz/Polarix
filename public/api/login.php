<?php
declare(strict_types=1);
require_once __DIR__ . '/../../config/database.php'; require_once __DIR__ . '/../../src/AuthService.php';
session_start(); header('Content-Type: application/json'); $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$user = (new AuthService(db()))->login(trim((string)($input['email'] ?? '')), (string)($input['password'] ?? ''));
if (!$user) { http_response_code(401); echo json_encode(['error'=>'Invalid credentials']); exit; }
session_regenerate_id(true); $_SESSION['user'] = $user; echo json_encode(['user'=>$user]);

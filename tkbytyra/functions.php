<?php
// functions.php

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function isAdmin() {
    return hasRole('admin');
}

function isManager() {
    return hasRole('manager') || isAdmin();
}

function logAction($pdo, $action, $details = '') {
    if (!isset($_SESSION['user_id'])) return;
    
    $stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $action, $details]);
}

function getLowStockCount($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM products WHERE quantity <= min_stock_level");
    return $stmt->fetchColumn();
}

function formatPrice($price) {
    return 'RM ' . number_format($price, 2);
}
?>

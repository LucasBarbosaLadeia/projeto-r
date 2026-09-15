<?php
function calculate_discount(float $price, float $percent): float {
    if ($percent <= 0) return $price;
    return round($price * (1 - $percent / 100), 2);
}

function fetch_products($conn): array {
    $arr = [];
    $res = $conn->query("SELECT * FROM products");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $arr[] = $row;
        }
        $res->free();
    }
    return $arr;
}

function search_products(array $products, float $minPrice): array {
    $out = [];
    foreach ($products as $p) {
        if ((float)$p['price'] > $minPrice) {
            $out[] = $p;
        }
    }
    return $out;
}

function organize_into_array(array $items): array {
    // exemplo simples: garantir índices numéricos e retornar array
    return array_values($items);
}

function validate_products_array(array $products): bool {
    if (empty($products)) return false;
    foreach ($products as $p) {
        if (!isset($p['id'], $p['name'], $p['price'])) return false;
        if ((float)$p['price'] < 0) return false;
    }
    return true;
}

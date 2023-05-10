<?php

// Compter le nombre total de produits dans le panier
$totalQuantity = 0;
if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        $totalQuantity += $product['qtt'];
    }
}

// Stocker le total dans une variable de session
$_SESSION['totalQuantity'] = $totalQuantity;
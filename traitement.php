<?php
session_start();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (isset($_GET['action']) && $_GET['action'] == 'add') {
                if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
                    // Récupérer l'ID et la quantité du produit depuis le formulaire
                    $product_id = $_POST['product_id'];
                    $quantity = $_POST['quantity'];

                    // Vérifier si le produit est déjà dans le panier
                    if (isset($_SESSION['cart'][$product_id])) {
                        // Si oui, ajouter la quantité sélectionnée à la quantité existante
                        $_SESSION['cart'][$product_id] += $quantity;
                    } else {
                        // Sinon, ajouter le produit au panier
                        $_SESSION['cart'][$product_id] = $quantity;
                    }
                }
            }
            break;
        case "empty":
            // Réinitialiser le tableau de produits
            unset($_SESSION["products"]);
            header("Location:recap.php");
            break;
        case "up-qtt":
            // Augmenter la quantité d'un produit
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if (isset($_SESSION['products'][$id])) {
                    $_SESSION['products'][$id]['qtt']++;
                    $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
                }
            }
            header("Location:recap.php");
            break;
        case "down-qtt":
            // Diminuer la quantité d'un produit
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if (isset($_SESSION['products'][$id])) {
                    $_SESSION['products'][$id]['qtt']--;
                    if ($_SESSION['products'][$id]['qtt'] == 0) {
                        unset($_SESSION['products'][$id]);
                        $_SESSION['message'] = "Le produit a été supprimé avec succès !";
                    } else {
                        $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
                        $_SESSION['message'] = "La quantité a été mise à jour avec succès !";
                    }
                }
            }
            header("Location:recap.php");
            break;
    }
}

if (isset($_POST['submit'])) {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    if ($name && $price && $qtt) {

        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt
        ];

        $_SESSION["products"][] = $product;
        $_SESSION["message"] = "Le produit a été ajouté avec succès !";
    } else {
        $_SESSION["message"] = "Veuillez remplir tous les champs correctement.";
    }
}

// header("Location:index.php");

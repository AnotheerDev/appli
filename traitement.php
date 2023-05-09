<?php
session_start();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
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
                header("Location:recap.php");
                exit();
            }
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
                header("Location:recap.php");
                exit();
            }
            break;
        case "delete-product":
            if(isset($_GET["action"]) && $_GET["action"] === "delete-product" && isset($_GET["id"])) {
                // Récupère l'ID du produit à supprimer depuis le formulaire
                $productId = $_GET["id"];
                // Supprime le produit de la variable de session "products"
                unset($_SESSION["products"][$productId]);
                header("Location: recap.php");
                exit();
            }
            break;
    }
}




header("Location:index.php");

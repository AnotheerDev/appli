<?php
    session_start();

    if(isset($_GET['action'])){
        switch($_GET['action']){
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
            case "delete":
                // Réinitialiser le tableau de produits
                unset($_SESSION["products"]);
                break;
        }
    }

    if(isset($_POST['submit'])){

        $name = filter_input(INPUT_POST, "name" , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        if($name && $price && $qtt){

            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION["products"][] = $product;
            $_SESSION["message"] = "Le produit a été ajouté avec succès !";
        }
        else {
            $_SESSION["message"] = "Veuillez remplir tous les champs correctement.";
        }
    }

    header("Location:index.php");
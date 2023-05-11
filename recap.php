<?php
    session_start();
    ob_start();
?>


<?php
    // Vérifie si la variable de session "products" est définie et non vide
    if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
        echo "<p>Aucun produit en session...</p>";
    }
    else{
        // Affiche le tableau des produits avec les informations de chaque produit
        echo "<table class='table table-striped mt-5'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
        // Initialise la variable qui contiendra le total général des produits
        $totalGeneral = 0;
        // Initialise la variable qui contiendra le total de produit dans le panier
        $totalProduct =0; 
        foreach($_SESSION["products"] as $index => $product){
            // Affiche les informations de chaque produit
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td><a href='#' data-bs-toggle='modal' data-bs-target='#productModal".$index."'>".$product["name"]."</a></td>",
                    "<td>".number_format($product["price"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>
                    <a href='traitement.php?action=down-qtt&id=$index' class='btn btn-primary btn-sm'>-</a>"
                    .$product["qtt"].
                    "<a href='traitement.php?action=up-qtt&id=$index' class='btn btn-primary btn-sm'>+</a></td>",
                    "<td>".number_format($product["total"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=delete-product&id=$index' class='btn btn-danger btn-sm'>Supprimer</a></td>",
                "</tr>";
                // Ajoute le prix total de chaque produit au total général et le total de produit dans le panier
            $totalGeneral += $product["total"];
            $totalProduct++;
        }
        // Affiche le total général de tous les produits
        echo "<tr><td colspan='4'>Nombre de produits: $totalProduct</td><td>Total: ".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</td><td></td></tr>",
            "</tbody>",
            "</table>";
    }


    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        // effacer le message après l'avoir affiché
        unset($_SESSION['message']);
    }
?>

<a href="traitement.php?action=empty" class="btn btn-danger" role="button" title="Lien 1">Vider le panier</a>


<!-- Modal -->
<div class="modal fade" id='productModal<?php echo $index; ?>' tabindex="-1" aria-labelledby='productModal<?php echo $index; ?>Label' aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id='productModal<?php echo $index; ?>Label'><?php echo $product["name"]; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="https://media.istockphoto.com/id/1068867234/fr/vectoriel/banan.jpg?s=612x612&w=is&k=20&c=hjgwCtFqknkQUp5LxJ8hnIO2Rb-diEbB5ucUjpIf8pY=">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>






<?php

$content = ob_get_clean();
$title = "Récapitulatif";
$totalQuantity = isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : 0;
require "template.php";
require "functions.php";
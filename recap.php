<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content ="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Récapitulatif des produits</title>
    </head>
    <body>
        <nav class="navbar" style="background-color: #e3f2fd"; fixed-top>
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Récapitulatif des vos courses : </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="recap.php">Récapitulatif</a>
                </div>
            </div>
            </div>
        </nav>
        <?php
            if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
                echo "<p>Aucun produit en session...</p>";
            }
            else{
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
                $totalGeneral = 0;
                foreach($_SESSION["products"] as $index => $product){
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product["name"]."</td>",
                            "<td>".number_format($product["price"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td>".$product["qtt"]."</td>",
                            "<td>".number_format($product["total"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "</tr>";
                    $totalGeneral += $product["total"];
                }
                echo    "<tr>",
                            "<td colspan=4>Total général :</td>",
                            "<td><strong>".number_format($totalGeneral, 2, "&nbsp;")."&nbsp;€</strong></td>",
                        "</tr>",
                    "</tbody>",
                    "</table>";
            }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
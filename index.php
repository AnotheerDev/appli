<!-- Glossaire SUPERGLOBALE :



session_start() : est une fonction PHP qui démarre une session PHP en cours d'utilisation sur le serveur. Les sessions sont utilisées pour stocker des informations de manière persistante entre les différentes pages d'un site web pour un utilisateur spécifique. Une session est créée en générant un identifiant unique appelé session ID, qui est stocké sur le serveur et envoyé au navigateur de l'utilisateur sous forme de cookie.

$_SESSION : est une variable PHP superglobale qui stocke les données de session. Cette variable peut être utilisée pour stocker et récupérer des informations utilisateur spécifiques telles que le nom d'utilisateur, l'adresse e-mail ou tout autre type d'informations que vous souhaitez stocker pour une session particulière.

$_POST : est une autre variable PHP superglobale qui stocke les données qui ont été soumises à un script PHP via une méthode POST. Cette variable est souvent utilisée pour récupérer les données des formulaires HTML, où les utilisateurs saisissent des informations qui doivent être envoyées au serveur pour traitement.

$_GET : est également une variable PHP superglobale, mais elle stocke les données qui ont été envoyées via la méthode GET. Les données sont récupérées à partir de l'URL de la page et sont généralement utilisées pour passer des paramètres entre différentes pages ou pour effectuer des requêtes de recherche.

En résumé, session_start() est utilisé pour démarrer une session PHP et $_SESSION est utilisé pour stocker et récupérer des données de session. $_POST est utilisé pour récupérer les données envoyées via la méthode POST et $_GET est utilisé pour récupérer les données envoyées via la méthode GET.



-->
<!-- -->
<?php
session_start();
ob_start();

?>




<div class="container">
    <h1>Ajouter un produit</h1>
    <form action="traitement.php?action=add" method="post">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantitée désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
</div>

<?php

$content = ob_get_clean();
$title = "Ajout produit";
require "template.php";

<?php
// ENVOI DE FICHIER PHP

// OPTIONS  
// $_FILES['image']['name'] // NOM // fait référence au fichier envoyé
// $_FILES['image']['type'] // TYPE image/png
// $_FILES['image']['size'] // TAILLE image/png
// $_FILES['image']['tmp_name'] // temporaire // EMPLACEMENT
// $_FILES['image']['error'] // ERREUR

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    // 1mo (méga octets) = 1 000 000 d'octets
    // 3mo = 3 000 000 d'octets
    // php interdit l'envoie de fichier de plus de 8mo

    if ($_FILES['image']['size'] <= 3000000) {
        // pathinfo => tableau (informations du file dont l'extension)
        $informationsImage = pathinfo($_FILES['image']['name']);
        $extensionImage = $informationsImage['extension'];
        $extensionArray = array('png', 'gif', 'jpg', 'jpeg'); // extensions autorisées

        if (in_array($extensionImage, $extensionArray)) {  // si paramètre1 se retrouve dans paramètre2
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . time() . rand() . rand() . '.' . $extensionImage);
            //.basename($_FILES['image']['name']));
            echo 'Envoi bien réussi !';
        }
    }
}

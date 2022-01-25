<?php
// VERIFIEZ SI IMAGE BIEN RECU

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    //VARIABLE (var réécrite plus bas si c'est un succès)
    $error = 1;

    // TAILLE
    if ($_FILES['image']['size'] <= 3000000) {

        // EXTENSION
        $informationsImage = pathinfo($_FILES['image']['name']);
        $extensionImage = $informationsImage['extension'];
        $extensionArray = array('png', 'gif', 'jpg', 'jpeg'); // extensions autorisées
        // comparaison
        if (in_array($extensionImage, $extensionArray)) {  // si paramètre1 se retrouve dans paramètre2

            $address = 'uploads/' . time() . rand() . rand() . '.' . $extensionImage;

            move_uploaded_file($_FILES['image']['tmp_name'], $address);
            // move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . time() . rand() . rand() . '.' . $extensionImage);  // envoie du fichier // time = id unique
            $error = 0;
            // echo 'Envoi bien réussi !';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hébergeur d'images</title>

    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<!--  
<style type="text/css">
    html,
    body {
        margin: 0;
        font-family: georgia
    }

    header {
        text-align: center;
        color: white;
        background: red;
    }

    article {
        margin-top: 50px;
        background: #f7f7f7;
        padding: 50px;
    }
    button { margin: auto; margin-top: 10px; }
    h1 {margin-top: 0; text-align: center;}
    .contener {
        width: 500px;
        margin: auto;
    }
    
</style>   -->

<style type="text/css">
    #presentation-picture {
        text-align: center;
    }

    #image {
        max-width: 100px;
    }
</style>

<body>

    <!-- HEADER -->
    <?php require_once("src/header.php"); ?>

    <!-- FORMULAIRE -->
    <div class="contener">
        <article>
            <h1>Hébergez une image</h1>

            <?php
            // il ya eu une tentative d'upload et $error == 0 succès
            if (isset($error) && $error == 0) {
                echo '<div 
                    id="presentation-picture"><img src="' . $address . '" id="image"/><br/>
                                      
                    <input type="text" value="http://localhost/udemyPhpTest/projet2/' . $address . '" />
                    </div>';
            } else if (isset($error) && $error == 1) {

                echo 'Votre image ne peut pas être envoyée. Vérifiez son extension et sa taille (maximum à 3mo).';
            }
            ?>

            <!-- Traitement de l'image -->
            <!-- <?php require_once("src/traitement_image.php"); ?> -->

            <!-- Formulaire html -->
            <form method="post" action="index.php" enctype="multipart/form-data">
                <p>
                <h2>Formulaire</h2>
                <input type="file" required name="image" /></br>
                <div style="text-align: center;">
                    <button type="submit">Héberger</button>
                </div>

                </p>
            </form>
        </article>
    </div>

</body>

</html>
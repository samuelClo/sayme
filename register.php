<?php
require('partials/_toolsConnexion.php');

//initialisation du conteneur des potentiels messages
$messages = [];
//si le formulaire a été soumis
if (isset($_POST['register'])) {

    //si firstname est vide, j'ajoute un message à mon tableau
    //idem pour les autres champs vides
    if (empty($_POST['firstname'])) {
        $messages['firstname'] = 'Le prénom est obligatoire';
    }
    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom de famille est obligatoire';
    }
    if (empty($_POST['email'])) {
        $messages['email'] = 'L\'email est obligatoire';
    }
    if (empty($_POST['password'])) {
        $messages['password'] = 'Le mot de passe est obligatoire';
    }
    if (empty($_POST['pseudo'])) {
        $messages['pseudo'] = 'Le pseudo est obligatoire';
    }

    //ici on check si ladresse email existe déjà en base de données
    $query = $db->prepare('SELECT email FROM chat_user WHERE email = ?');
    $query->execute(
        [
            $_POST['email']
        ]
    );
    $emailExist = $query->fetch();

    //si l'email est déjà dans la base de données, on prévient l'utilisateur qu'il ne peut pas l'utiliser
    if ($emailExist != false) {
        $messages['emailExist'] = "l'adresse email est déjà utilisée";
    }

    //si et seulement si aucun message n'a été mis dans le tableau, alors faire l'insertion en DB
    if (empty($messages)) {
        $query = $db->prepare('INSERT INTO chat_user (firstname, name, email, password, pseudo, color) VALUES (?, ? , ? , ? , ?, ?)');
        $result = $query->execute(
            [
                $_POST['firstname'],
                $_POST['name'],
                $_POST['email'],
                md5($_POST['password']),
                $_POST['pseudo'],
                $_POST['color']
            ]
        );

        //si l'ensertion s'est bien passée, prévenir l'utilisateur
        if ($result == true) {
            header('Location: index.php');
        } else {
            echo 'Erreur lors de l\'inscription';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('partials/header.php'); ?>
    <style>
        #registerForm {
            width: 500px;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.3);
            text-align: center;
            border-radius: 30px;
        }
        #registerForm > h1 {
            margin-bottom: 20px;
            color: white;
        }
        button {
            outline: unset;
            border-radius: 30px;
            /* margin: 20px 0; */
            padding: 10px 20px;
            font-size: unset;
            background-color: rgba(139, 59, 157, 0.6);
            color: white;
            border: unset;
            font-weight: 500;
            transition-duration: 500ms;
        }
        button:hover{
            transition-duration: 500ms;
            background-color: rgba(139, 59, 157, 1);
        }
        @media all and (max-width: 700px) {
            #registerForm {
                width: 100%;
                border-radius: unset;
            }
        }
    </style>
</head>
<body>
<section>
    <form id="registerForm" method="post">
        <h1>Inscrivez-vous</h1>
        <input placeholder="Prénom..." id="firstname" name="firstname" type="text">
        <?php if (isset($_POST['firstname']) && empty($_POST['firstname'])): ?>
            <span style="color: white;"><?php echo $messages['firstname']; ?></span>
        <?php endif; ?>
        <input placeholder="Nom..." id="name" name="name" type="text">
        <?php if (isset($_POST['name']) && empty($_POST['name'])): ?>
            <span style="color: white;"><?php echo $messages['name']; ?></span>
        <?php endif; ?>
        <input placeholder="Pseudo..." id="pseudo" name="pseudo" type="text">
        <?php if (isset($_POST['pseudo']) && empty($_POST['pseudo'])): ?>
            <span style="color: white;"><?php echo $messages['pseudo']; ?></span>
        <?php endif; ?>
        <input placeholder="Email..." id="email" name="email" type="email">
        <?php if (isset($_POST['email']) && empty($_POST['email'])): ?>
            <span style="color: white;"><?php echo $messages['email']; ?></span>
        <?php endif; ?>
        <input placeholder="Mot de passe..." id="password" name="password" type="password">
        <?php if (isset($_POST['password']) && empty($_POST['password'])): ?>
            <span style="color: white;"><?php echo $messages['password']; ?></span>
        <?php endif; ?>
        <br>
        <input type="color" id="color" name="color" placeholder="Couleur..." style="max-width: 100px; border-radius: 30px; padding-right:10px">
        <p style="color: white;">Vous avez déjà un compte ? <a href="index.php" style="color: purple;"> Connectez-vous !</a></p>
        <button name="register" id="register" type="submit">Inscription</button>
    </form>
</section>
</body>
</html>
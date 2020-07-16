<?php

require('partials/_toolsConnexion.php');

//if (isset($_GET['disconnect'])){
unset($_SESSION['user']);
//}
$message = null;
$msg = null;
if (isset($_POST['connexion'])) {
    if (isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password'])) {
        $queryUser = $db->prepare('SELECT * FROM chat_user WHERE email = ? AND password = ?');
        $queryUser->execute(array($_POST['email'], md5($_POST['password'])));
        $resultUser = $queryUser->fetch();

        $userExist = $resultUser;

        if ($userExist == true) {

            $_SESSION['user'] = $resultUser;
            $email = $_POST['email'];
            $password = $_POST['password'];

            header('Location: chat.php');
        } else {
            $email = $_POST['email'];
            $msg = 'Mauvais identifiants !';
        }
    } else{
        $email = null;
        $message = 'Tous les champs sont obligatoires';
    }
} else {
    $email = NULL;
    $password = NULL;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('partials/header.php'); ?>
    <style>
        p {
            color: white;
        }
    </style>
</head>
<body>
<section id="sectionForm">
    <form id="connexionForm" method="post">
        <h1>Connectez-vous</h1>
        <input placeholder="Email" id="email" name="email" type="email" value="<?php echo $email; ?>">
        <?php if (isset($_POST['email']) && empty($_POST['email'])): ?>
            <p>l'email est obligatoire</p>
        <?php endif; ?>
        <input placeholder="Mot de passe" id="password" name="password" type="password" value="">
        <?php if (isset($_POST['password']) && empty($_POST['password'])): ?>
            <p>le mot de passe est obligatoire</p>
        <?php endif; ?>
        <span id="alert"></span>
        <p style="color: white;">Vous n'avez pas de compte ? <a href="register.php" style="color: purple;">
                Inscrivez-vous !</a></p>
        <div>
            <button name="connexion" type="submit" id="connexion">Connexion</button>
        </div>
        <br>
        <span style="color: white;"><?php echo $message; ?></span>
        <span style="color: white;"><?php echo $msg; ?></span>
    </form>
</section>
</body>
</html>

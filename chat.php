<?php
require('partials/_toolsConnexion.php');

if (isset($_SESSION) && $_SESSION['user']['id'] == false){
    $res->userConnect = "userConnect";
    header('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sayme</title>
    <link rel="stylesheet" href="assets/style/Normalize.css">
    <link rel="stylesheet" href="assets/style/main.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>


<main id="container">
    <section class="left menu" id="menu">
        <div id="addPaddingToLeftMEnu">
            <div id="headerLeftMenu">
                <div id="profilName">

                </div>
                <div id="profilEditate">
                    <h3><a id="modify" href="#test-form">Editer votre profil <i class="fas fa-pencil-alt"></i></a></h3>
                </div>
            </div>
            <div id="bodyLeftMenu">

            </div>
            <div id="footerLeftMenu">
                <span id="channelList">Retour aux channel </span>
                <button>
                    <a href="index.php?disconnect" style="color: white;">
                        Déconnexion
                    </a>
                </button>
            </div>



            <p id="closeMenu">X</p>
        </div>



    </section>
    <section class="right">
        <header>
            <div id="crossContainer" style="animation: crossContainExtend 350ms ease 0s 1 normal forwards running">
                <div id="cross" class="init">
                    <div id="barreOne" class="cross crossOne"></div>
                    <div id="barreTwo" class="cross crossTwo"></div>
                    <div id="barreThree" class="cross crossThree"></div>
                </div>
            </div>
            <h2>Sayme</h2>
        </header>
        <div class="containerChat" data-channel_id="1000">

        </div>
        <footer>

            <textarea id="textEntries" placeholder="Entrez votre texte..." rows="5" cols="200" data-meteor-emoji="true" ></textarea>

            <div>
                <i class="fas fa-chevron-circle-right"></i>
            </div>
        </footer>
    </section>
</main>
<div id="shadow">
    <form id="test-form">
        <div id="closeModal"><i class="fas fa-times"></i></div>
        <h1>Edition du profil</h1>
        <fieldset style="border:0;">
            <label for="name">Firstname</label>
            <input id="name" name="name" value="" type="text" placeholder="Name">

            <label for="firstname">Firstname</label>
            <input id="firstname" name="firstname" type="text" placeholder="firstname">

            <label for="nickname">Pseudo</label>
            <input id="nickname" name="nickname" value="" type="text" placeholder="nickname">

            <label for="mail">Email</label>
            <input id="mail" name="email"  value="" type="email" placeholder="example@domain.com">

            <label for="color">Couleur</label>
            <input style="padding: 8px;" id="color" name="color"  value="" type="color" >

            <span id="alert"></span>

            <button id="editValid" type="submit">Valider</button>
        </fieldset>
    </form>
</div>
<div id="shadow_channel">
    <form id="form_channel">
        <div id="closeModalChannel"><i class="fas fa-times"></i></div>
        <h1>Création de Channel</h1>
        <fieldset style="border:0;">

            <input id="title" name="title" value="" type="text" placeholder="title">

            <input id="description" name="description" type="text" placeholder="description">

            <label for="users">Utilisateurs</label>
            <select multiple name="users[]" id="users">
            </select>

            <span id="alert2"></span>

            <button id="validChannel" type="submit">Valider</button>
        </fieldset>
    </form>
</div>

<script src="assets/js/registration_inscription.js"></script>
<script src="assets/js/meteorEmoji.min.js"></script>
<script>
    (() => {
        new MeteorEmoji()
    })()
</script>
</body>
</html>
<?php
require('partials/_toolsConnexion.php');

$res = new stdClass();

$res->userName = $_SESSION['user']['pseudo'];
echo json_encode($res);

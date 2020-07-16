<?php
require ('partials/_toolsConnexion.php');

$data = file_get_contents('php://input');
$idChannel = json_decode($data);

$res = new stdClass();


$query_users = $db->prepare('
        SELECT cu.pseudo, cu.is_connected 
         FROM chat_user cu  JOIN channel_user cus
         ON  cu.id = cus.id_user
      WHERE  cus.id_channel = ?
         ');

$query_users->execute(
    array(
        $idChannel,
    ));
$users = $query_users->fetchAll();

$array = [];
for ($i = 0; $i < sizeof($users); $i++) {

    $array[$i] = [
        "pseudo" => $users[$i]['pseudo'],
    ];
    if ($users[$i]['is_connected'] == "1"){
        $array[$i]['is_connected'] ="green";
    }
    else{
        $array[$i]['is_connected'] ="red";
    }

}

$res = new stdClass();
$res->arrayAllChatUsers = $array;

$query_last_user_list_id  = $db->prepare('
        SELECT cu.id
         FROM chat_user cu  JOIN channel_user cus
         ON  cu.id = cus.id_user
       WHERE  cus.id_channel = ?
      ORDER  BY cus.id DESC 
         ');
$query_last_user_list_id ->execute(

    array(
        $idChannel
    ));

$last_user_list_id = $query_last_user_list_id ->fetchColumn();



$_SESSION['user']['last_user_list_id'] = $last_user_list_id;

//var_dump($_SESSION['user']['last_user_list_id'] );


echo json_encode($res);



die();

<?php

require ('partials/_toolsConnexion.php');


$data = file_get_contents('php://input');
$idChannel = json_decode($data);

$res = new stdClass();

if (isset($_SESSION['user']['last_channel_id'])) {



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

    if ($_SESSION['user']['last_user_list_id'] !=  $last_user_list_id) {





        $query_id_from_user_last_id_user = $db->prepare('
         SELECT id FROM channel_user WHERE id_user = ?
        ');
        $query_id_from_user_last_id_user->execute(
            array(
                $_SESSION['user']['last_user_list_id'],
            ));
        $id_from_user_last_id_user = $query_id_from_user_last_id_user->fetchColumn();


        $query_number_of_user_to_display = $db->prepare('

            SELECT COUNT(*)
            FROM channel_user cu 
             WHERE cu.id > ? AND cu.id_channel = ?
            ');

        $query_number_of_user_to_display->execute(
            array(
                $id_from_user_last_id_user,
                $idChannel
            ));
        $number_of_user_to_display = $query_number_of_user_to_display->fetchColumn();


        $query_new_users = $db->prepare('
         SELECT cu.pseudo, cu.is_connected 
         FROM chat_user cu  JOIN channel_user cus
         ON  cu.id = cus.id_user
      WHERE  cus.id_channel = ?
      ORDER BY cus.id DESC 
      LIMIT ?
      
         ');

        $query_new_users->bindValue(1,  $idChannel, PDO::PARAM_INT);
        $query_new_users->bindValue(2, $number_of_user_to_display, PDO::PARAM_INT);

        $query_new_users -> execute();

        $new_users = $query_new_users->fetchAll();


        $array = [];
        for ($i = 0; $i < $number_of_user_to_display; $i++) {

            $array[$i] = [
                "pseudo" => $new_users[$i]['pseudo'],
            ];
            if ($new_users[$i]['is_connected'] == "1"){
                $array[$i]['is_connected'] ="green";
            }
            else{
                $array[$i]['is_connected'] ="red";
            }

        }

        $res = new stdClass();
        $res->arrayAllChatNewUsers = $array;

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



        echo json_encode($res);

    }




}
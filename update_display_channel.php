<?php
require('partials/_toolsConnexion.php');

if (isset($_SESSION['user']['last_channel_id'])) {

    $query_last_channel_id = $db->prepare('
        SELECT ch.id as channel_id
         FROM chat_user cu  JOIN channel_user cus
         ON  cu.id = cus.id_user
        JOIN  channel ch 
        ON  ch.id = cus.id_channel
      WHERE cu.id = ?
      ORDER  BY ch.id DESC 
    
         ');
    $query_last_channel_id->execute(
        array(
            $_SESSION['user']['id']
        ));

    $last_channel_id = $query_last_channel_id->fetchColumn();


    $res = new stdClass();

    if ($_SESSION['user']['last_channel_id'] != $last_channel_id) {
        $query_number_of_channel_to_display = $db->prepare('

            SELECT COUNT(*)
            FROM channel ch
            JOIN channel_user cus
                     ON  ch.id = cus.id_channel
                    JOIN  chat_user cu
                    ON  cu.id = cus.id_user
                    WHERE ch.id > ?  AND cu.id = ?
            ');
        $query_number_of_channel_to_display->execute(
            array(
                $_SESSION['user']['last_channel_id'],
                $_SESSION['user']['id']
            ));
        $number_of_channel_to_display = $query_number_of_channel_to_display->fetchColumn();


        $array = [];
        $query_new_channels = $db->prepare('
         SELECT ch.title as channel_title, ch.description as channel_description, ch.id as channel_id
         FROM chat_user cu  JOIN channel_user cus
         ON  cu.id = cus.id_user
        JOIN  channel ch 
        ON  ch.id = cus.id_channel
      WHERE cu.id = ?
      ORDER BY ch.id DESC 
      LIMIT ? 
         ');

        $query_new_channels->bindValue(1,  $_SESSION['user']['id'], PDO::PARAM_INT);
        $query_new_channels->bindValue(2, $number_of_channel_to_display, PDO::PARAM_INT);

        $query_new_channels -> execute();

        $new_channels = $query_new_channels->fetchAll();

        $array = [];

        for ($i = 0; $i < $number_of_channel_to_display; $i++) {

            $array[$i] = [
                "channel_title" => $new_channels[$i]['channel_title'],
                "channel_description" => $new_channels[$i]['channel_description'],
                "channel_id" => $new_channels[$i]['channel_id'],
            ];

        }

        $res->arrayAllUserChannel = $array;
        $query_last_channel_id = $db->prepare('
            SELECT ch.id as channel_id
             FROM chat_user cu  JOIN channel_user cus
             ON  cu.id = cus.id_user
            JOIN  channel ch
            ON  ch.id = cus.id_channel
          WHERE cu.id = ?
          ORDER  BY ch.id DESC

             ');
        $query_last_channel_id->execute(
            array(
                $_SESSION['user']['id']
            ));

        $last_channel_id = $query_last_channel_id ->fetchColumn();
        $_SESSION['user']['last_channel_id'] = $last_channel_id;

    } else {
        $res->msg = "pas de nouveaux channels";
    }

    echo json_encode($res);

}
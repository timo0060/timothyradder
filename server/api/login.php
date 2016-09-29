<?php

/**
 * Created by PhpStorm.
 * User: Tim
 * Date: 9/28/2016
 * Time: 9:17 PM
 */

$app->post('/api/login', function ($request, $response){
    require_once 'db.php';

    $q = "SELECT * FROM blog_admin WHERE username = ? AND password = ?";

    $stmt = $mysqli->prepare($q);
    $user = $request->getParsedBody()['username'];
    $pass = md5($request->getParsedBody()['password']);
    $stmt->bind_param('ss', $user, $pass);

    if($stmt->execute()){
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $token = $user . '|'.md5(uniqid($user, true));
            date_default_timezone_set("America/Toronto");
            $logged_in = date('Y/m/d');

            $q = "UPDATE blog_admin SET _token=?, last_logged_in=?";
            $stmt = $mysqli->prepare($q);
            $stmt->bind_param('ss', $token, $logged_in);

            if($stmt->execute()){
                $data = array(
                    "auth" => true;
                );
            }else{
                $data = array(
                    "flash" => 'danger',
                    "message" => '<strong>ERROR:</strong> Could not login! Please try again later!'
                );
                $status = 403;
            }
        }else{
            $data = array(
                "flash" => 'danger',
                "message" => '<strong>ERROR:</strong> The Username/Password you have entered is incorrect. Please try again.'
            );
        }
        
        $status = 200;
    }else{
        $data = array(
            "flash" => 'danger',
            "message" => '<strong>ERROR:</strong> Could Not Run the SQL'
        );

        $status = 500;
    }

    return $response->withJson($data, $status);
});
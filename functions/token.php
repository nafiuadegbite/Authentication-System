<?php

function generate_token() {
    $token = "";

    $alphabets = ['a','b','c','d','e','f','g','h','A','B','C','D','E','F','H'];

    for($i = 0; $i < 26; $i++) {
        $index = mt_rand(0,count($alphabets)-1);
        $token .= $alphabets[$index];
    }
    return $token;
}

function find_token($email = "") {
    $dirTokens = "db/tokens/";
    $allUsersTokens = scandir($dirTokens);
    $countAllUsersTokens = count($allUsersTokens);

    for($counter = 0; $counter < $countAllUsersTokens; $counter++) {
        $currentTokenFile = $allUsersTokens[$counter];
        if($currentTokenFile == $email . ".json") {
            $tokenContent = file_get_contents($dirTokens.$currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            // $tokenFromDB = $tokenObject->token;
            return $tokenObject;
            
        }
    }
    return false;
}
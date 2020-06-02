<?php

function sentMail($data)
{
    $name = $data["visitor"];
    $email = $data["email"];
    $message = $data["message"];

    $EmailTo = "emailaddress@test.com";
    $Subject = "New Message Received";

    $Body  = "Name: ";
    $Body .= $name;
    $Body .= "n";

    $Body .= "Email: ";
    $Body .= $email;
    $Body .= "n";

    $Body .= "Message: ";
    $Body .= $message;
    $Body .= "n";

    //  return = mail($EmailTo, $Subject, $Body, "From:" . $email);

    return true;
}

function valid_inn($login,$jurface = NULL)
{
    $inn = (int) $login;

$jurface = $jurface==NULL?1:$jurface;

    if ($jurface == 1) {
        //для юр лица код 10 знаков
        if (preg_match('#([\d]{10})#', $inn, $m)) {
            $inn = $m[0];
            $code10 = (($inn[0] * 2 + $inn[1] * 4 + $inn[2] * 10 + $inn[3] * 3 +
                $inn[4] * 5 + $inn[5] * 9 + $inn[6] * 4 + $inn[7] * 6 +
                $inn[8] * 8) % 11) % 10;

            return ($code10 == $inn[9]);
        }
    } else {
        //для физ.лиц и ИП - 12 знаков
        if (preg_match('#([\d]{12})#', $inn, $m)) {
            $inn = $m[0];
            $code11 = (($inn[0] * 7 + $inn[1] * 2 + $inn[2] * 4 + $inn[3] * 10 +
                $inn[4] * 3 + $inn[5] * 5 + $inn[6] * 9 + $inn[7] * 4 +
                $inn[8] * 6 + $inn[9] * 8) % 11) % 10;
            $code12 = (($inn[0] * 3 + $inn[1] * 7 + $inn[2] * 2 + $inn[3] * 4 +
                $inn[4] * 10 + $inn[5] * 3 + $inn[6] * 5 + $inn[7] * 9 +
                $inn[8] * 4 + $inn[9] * 6 + $inn[10] * 8) % 11) % 10;

            return ($code11 == $inn[10] && $code12 == $inn[11]);
        }
    }
    return false;
}

function valid_phone($phone)
{
    $regexp = '/^\s?(\+\s?7|8)([- ()]*\d){10}$/';

    if (preg_match($regexp, $phone)) {
        return true;
    }

    return false;
}

function valid_password($password)
{
    $regexp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/';

    if (preg_match($regexp, $password)) {
        return true;
    }

    return false;
   
}

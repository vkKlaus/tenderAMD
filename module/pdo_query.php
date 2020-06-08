<?php

function getTable($pdo, $table, $where = NULL,  $sort = NULL, $limit = NULL)
{
    $sql = "SELECT * FROM `$table` 
    WHERE " . ($table == 'tenders' ? '`delete`=0 AND ' : '') . ($where == NULL ? '1' : "$where")
        . ($sort == NULL ? "" : " ORDER BY $sort")
        . ($limit == NULL ? "" : " LIMIT $limit");

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


function getCountElements($pdo,  $table,  $where = NULL)
{
    $where = $where == NULL ? 1 : $where;

    $sql = "SELECT COUNT(*) as count FROM `$table` WHERE $where";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $arrCount = $stmt->fetchAll();

    if (count($arrCount) == 0) {
        return 0;
    }

    return $arrCount[0]['count'];
}



function getUser($pdo,  $login, $field)
{
    $login =  htmlspecialchars($login, ENT_QUOTES);

    $sql = "SELECT * FROM `users` WHERE `$field`=:login LIMIT 1";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'login' => $login
    ]);

    $users = $stmt->fetchAll();

    if (count($users) == 0) {
        return [];
    }

    return $users[0];
}
function getUserRecovery($pdo,  $data)
{

    $data['name'] = htmlspecialchars($data['name'], ENT_QUOTES);

    $data['login'] = htmlspecialchars($data['login'], ENT_QUOTES);

    $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES);


    $sql = "SELECT * FROM `users` WHERE `inn`=:login AND `name`=:name AND `email`=:email LIMIT 1";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'login' => $data['login'],
        'name' => $data['name'],
        'email' => $data['email'],

    ]);

    $users = $stmt->fetchAll();

    if (count($users) == 0) {
        return [];
    }

    $sql = 'UPDATE 
                `users` 
            SET 
                `password`=:password,
                `action`=:action
            WHERE
                `inn`=:login AND
                `name`=:name AND 
                `email`=:email';

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'login' => $data['login'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => password_hash($data['password_1'], PASSWORD_BCRYPT),
        'action' => '0'
    ]);

    return $users[0];
}


function addUser($pdo, $data)
{

    $data['name'] = htmlspecialchars($data['name'], ENT_QUOTES);

    $data['login'] = htmlspecialchars($data['login'], ENT_QUOTES);

    $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES);

    $data['phone'] = htmlspecialchars($data['phone'], ENT_QUOTES);

    $sql = 'INSERT INTO `users` 
    (
        `inn`,
        `email`,
        `phone`,
        `password`,
        `name`
      
    ) 
    values 
    (
        :inn, 
        :email,
        :phone, 
        :password,
        :name      
        )';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(
        [
            'inn' => $data['login'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => password_hash($data['password_1'], PASSWORD_BCRYPT),
            'name' => $data['name']
        ]
    );

    if ($result) {
        return getUser($pdo, $data['login'], 'inn');
    } else {
        return [];
    }
};

function createDB($pdo)
{
    $sql = 'INSERT INTO `tenders`
        (
            `id`, 
            `delete`, 
            `close`, 
            `type`, 
            `project`, 
            `description`, 
            `date_open`, 
            `date_close`, 
            `documents`
        ) 
        VALUES 
        (
            :id, 
            :delete, 
            :close, 
            :type, 
            :projec, 
            :description, 
            :date_open, 
            :date_close, 
            :documents
            )';

    $stmt = $pdo->prepare($sql);

    for ($i = 1; $i <= 1000; $i++) {

        $prj = rand(1, 4);
        $tp = rand(1, 8);
        $close = rand(0, 1);
        $y = rand(2015, 2020);
        $m = rand(1, 12);
        $d = rand(1, 28);
        $cls = rand(14, 30);
        $do = new DateTime("$y-" . ($m < 10 ? "0" : "") . "$m-" . ($d < 10 ? "0" : "") . "$d 00:00:00");
        $doF = ($do->format('Y-m-d'));
        $lenTnd = '+' . rand(15, 20) . ' day';
        $dc = $do->modify($lenTnd);
        $dcF = ($dc->format('Y-m-d'));

        $tnd = "тендер №$i: проект $prj; тип $tp; дата начала: " . $doF . "; окончание приема заявок: " . $dcF . ". тендер закрыт: " . ($close == 0 ? "нет" : "да");




        $result = $stmt->execute(
            [
                'id' => $i,
                'delete' => 0,
                'close' => $close,
                'type' => $tp,
                'projec' => $prj,
                'description' => $tnd,
                'date_open' => $do->format('Y-m-d'),
                'date_close' => $dc->format('Y-m-d'),
                'documents' => "tenderDoc$i.zip"
            ]
        );
    }
}

function   actionUser($pdo, $act)
{


    $sql = 'UPDATE 
                `users` 
            SET 
                `action`=:action
            WHERE
                `id`=:id';

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => (int) $act['id'],
        'action' => (int) $act['checkbox']
    ]);
}

function   delUser($pdo, $act)
{
    $sql = 'DELETE
            FROM 
                `users` 
            WHERE
                 `id`=:id';

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => (int) $act['id'],
    ]);
}

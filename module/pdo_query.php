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
                `action`=0,
                `to_check`=0
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
     0
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
        `name`,
        `title`
      
    ) 
    values 
    (
        :inn, 
        :email,
        :phone, 
        :password,
        :name,
        :title      
        )';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(
        [
            'inn' => $data['login'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => password_hash($data['password_1'], PASSWORD_BCRYPT),
            'name' => $data['name'],
            'title' => '???',

        ]
    );

    if ($result) {
        return getUser($pdo, $data['login'], 'inn');
    } else {
        return [];
    }
};


function   actionUser($pdo, $act)
{


    $sql = 'UPDATE 
                `users` 
            SET 
                `action`=:action,
                `to_check`=`1`
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

function downLoadTender($pdo,$tender,$user){
    $tender = htmlspecialchars($tender, ENT_QUOTES);

    $user = htmlspecialchars((string)($user), ENT_QUOTES);

    $sql = 'INSERT INTO `download` 
    (
        `user`,
        `tender`
    ) 
    values 
    (
        :user, 
        :tender     
        )';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(
        [
            'user' => $user,
            'tender' => $tender,
        ]
    );

}
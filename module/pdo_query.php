<?php


function getTable($pdo, $table, $where = NULL,  $sort = NULL, $limit = NULL)
{


    $sql = "SELECT * FROM `$table` 
    WHERE " . ($where == NULL ? 1 : "$where")
        . ($sort == NULL ? "" : " ORDER BY $sort")
        . ($limit == NULL ? "" : " LIMIT $limit");

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}


function getCountElements( $pdo,  $table,  $where = NULL)
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



function getUser( $pdo,  $login)
{
    $login = (int) htmlspecialchars($login, ENT_QUOTES);
    $sql = "SELECT * FROM `users` WHERE `inn`=$login LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    if (count($users) == 0) {
        return [];
    }

    return $users[0];
}


function addUser($pdo, $data)
{
    $data['login'] = htmlspecialchars($data['login'], ENT_QUOTES);
    $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES);
    $data['phone'] = htmlspecialchars($data['phone'], ENT_QUOTES);

    $sql = 'INSERT INTO users 
    (
        inn,
        email,
        phone,
        password
      
    ) 
    values 
    (
        :inn, 
        :email,
        :phone, 
        :password       
        )';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(
        [
            'inn' => $data['login'],
            'email' => $data['login'],
            'phone' => $data['phone'],
            'password' => password_hash($data['password_1'], PASSWORD_BCRYPT)
        ]
    );

    if ($result) {
        return getUser($pdo,$data['login']);
    } else {
        return [];
    }
};

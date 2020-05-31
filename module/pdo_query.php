<?php

/**
 * функция получения полных таблиц
 * @param object $pdo - объект соединения с БД
 * @param sting $table - таблица
 * @param string $where - условие
 * @param string $sort - сортировка
 * @param string $limit - выборка
 * @return array - результат записи сообщения
 */

function getTable(object $pdo, string $table, string $where = "1", $sort = "", $limit = ""): array
{


    $sql = "SELECT * FROM `$table` 
    WHERE " . ($where == "" ? 1 : "$where")
        . ($sort == "" ? "" : " ORDER BY $sort")
        . ($limit == "" ? "" : " LIMIT $limit");

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll();
}

/** 
 * функция получения количества элементов в таблице
 * @param object $pdo - объект соединения с БД
 * @param sting $table - таблица
 * @param string $where - условие
 * @return int - количество элеиментов в таблице
 */
function getCountElements(object $pdo, string $table, string $where = "1"): int
{
    $sql = "SELECT COUNT(*) as count FROM `$table` WHERE $where";


    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $arrCount = $stmt->fetchAll();
    if (count($arrCount) == 0) {
        return 0;
    }

    return $arrCount[0]['count'];
}

/**
 * получение пользователя
 * @param object $pdo - объект соединения с БД
 * @param string $login - логин пользователя 
 * @param string $password -пароль
 *
 */

function getUser(object $pdo, string $login): array
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

/**
 * ввод пользователя
 * @param object $pdo - объект соединения с БД
 * @param array $data - массив с данными 
 * @return array $password -пользователь
 *
 */
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

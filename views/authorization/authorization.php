<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/headerConf.php';

unset($_SESSION['user']);

if (isset($_POST['enter'])) {

    $user = getUser($pdo, $_POST['login'], 'name');

    if ($user) {

        if (!password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user']['error'] = 'ошибка авторизации';
        } elseif (!$user['action']) {
            $_SESSION['user']['error'] = 'пользователь не работает с документами';
        } else {
            $_SESSION['user'] = $user;
            unset($_SESSION['user']['error']);
            if ($host) {
                if ($user['admin'] == 1) {
                    $_SESSION['admin'] = 1;
                    header('Location: ' . $host . '/views/layouts/admin.php');
                }
            }
        }
    } else {
        $_SESSION['user']['error'] = 'пользователь нет найден';
    }


    if ($host) {
        header('Location: ' . $host);
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';

?>
<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form  col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">Имя / логин <sup>*</sup></label>

            <input type="text" name="login" value="" id="login-id" class="enter-field form-control" required />
              
              <small id="login-help" class="form-text text-muted">введите имя, указанное при регистрации</small>
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id">Пароль <sup>*</sup></label>

            <input id="password_id" name="password" type="password" value="" id="password-id" class="enter-field form-control" required />
        <small id="login-help" class="form-text text-muted">введите пароль</small>
        </div>


        <input type="submit" value="Войти" name="enter" class="enter-button btn btn-primary" />

    </form>
</div>
<p class="text-center text-danger mt-3"><?= $error ?></p>
<div class="paginator d-flex justify-content-center mt-5">
    <a href="/views/authorization/registration.php" class="btn btn-outline-dark pl-5 pr-5 mr-2"><span>регистрация</span></a>

    <a href="/views/authorization/recovery.php" class="btn btn-outline-dark pl-5 pr-5 ml-2"><span>забыли пароль</span></a>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
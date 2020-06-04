<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';

if (isset($_POST['enter'])) {

    $user = getUser($pdo, $_POST['login']);

    if ($user) {
        if (!password_verify($_POST['password'], $user['password'])) {
            $error .= 'ошибка авторизации <br>';
        } elseif (!$user['action']) {
            $error .= 'пользователь не работает с документами <br>';
        } else {
            $_SESSION['user'] = $user;
            header('Location: ' . $host);
        }
     
    } else {
        $error .= 'пользователь нет найден <br>';
    }
}
?>
<p class="mt-3">поля, помеченные *, обязательны для заполнения</p>

<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form  col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">ИНН <sup>*</sup></label>

            <input type="number" name="login" value="" id="login-id" class="enter-field form-control" required/>
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id">Пароль <sup>*</sup></label>

            <input id="password_id" name="password" type="password" value="" id="password-id" class="enter-field form-control" required/>
        </div>


        <input type="submit" value="Войти" name="enter" class="enter-button btn btn-primary" />

    </form>
</div>
<p class="text-center text-danger mt-3"><?= $error?></p>
<div class="paginator d-flex justify-content-center mt-5">
    <a href="/views/authorization/registration.php" class="btn btn-outline-dark pl-5 pr-5 mr-2"><span>регистрация</span></a>

    <a href="/views/authorization/recovery.php" class="btn btn-outline-dark pl-5 pr-5 ml-2"><span>забыли пароль</span></a>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
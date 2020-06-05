<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/headerConf.php';

if (isset($_POST['recovery'])) {

    if (!valid_password($_POST['password_1'])) {
        $error .= 'нарушены требования пароля  <br>';
    }

    if (($_POST['password_1'] <> $_POST['password_2'])) {
        $error .= 'разные пароли <br>';
        $login = $_POST['login'];
        $email = $_POST['email'];
        $name = $_POST['name'];
    }

    if (!$error) {
        $user = getUserRecovery($pdo, $_POST);
        if (!$user) {
            $error = 'пользователь по введенным данным не найден  <br>';
            $login = $_POST['login'];
            $email = $_POST['email'];
            $name = $_POST['name'];
        } else {
            unset($_SESSION['user']);  
            $_SESSION['user']['error'] = 'данные отправлены для проверки. Доступен только просмотр.';
            if ($host) {
                header('Location: ' . $host);
            }
        }
    }
}
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>

<p class="mt-3 text-center">Поля, помеченные *, обязательны для заполнения.</p>
<p class="text-center">После изменеия пароля будет выполнен повторый запрос на разрешение работы.</p>
<p class="text-center">Пароль должен состоять из букв латинского алфавите, на разных регистрах, и цифр. Длинна пароля от 6 до 10 символов. </p>
<hr>
<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form   col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">ИНН <sup>*</sup></label>

            <input type="number" name="login" value="" id="login-id" class="enter-field form-control" required />
        </div>

        <div class="form-group">
            <label class="enter-label" for="name-id">Имя / логин <sup>*</sup></label>

            <input type="text" name="name" value="" id="name-id" class="enter-field form-control" required />
        </div>

        <div class="form-group">
            <label class="enter-label" for="email-id">e-mail <sup>*</sup></label>

            <input type="email" name="email" value="" id="email-id" class="enter-field form-control" required />
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-1-id">пароль <sup>*</sup></label>

            <input type="password" name="password_1" value="" id="password-1-id" class="enter-field form-control" required />
        </div>
        <div class="form-group">
            <label class="enter-label" for="password-2-id">повторите пароль <sup>*</sup></label>

            <input type="password" name="password_2" value="" id="password-2-id" class="enter-field form-control" required />
        </div>
        <input type="submit" value="Восстановить" name="recovery" class="enter-button btn btn-primary" />

    </form>

</div>

<p class="text-center text-danger mt-3"><?= $error ?></p>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
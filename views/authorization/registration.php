<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';

if (isset($_POST['registration'])) {

    $inn = valid_inn($_POST['login'], 1);

    if (getUser($pdo, $_POST['login'])) {
        $error .= 'пользователь уже зарегистрирован <br>';
    } else {

        if ($inn == 0) {
            $inn = valid_inn($_POST['login'], 0);
        }

        if ($inn == 0) {
            $error .= 'не корректный ИНН <br>';
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= 'не корректный email <br>';
        }

        if (!valid_phone($_POST['phone'])) {
            $error .= 'не корректный телефон <br>';
        }

        if (!valid_password($_POST['password_1'])) {
            $error .= 'нарушены требования пароля  <br>';
        }

        if (($_POST['password_1'] <> $_POST['password_2'])) {
            $error .= 'разные пароли <br>';
        }

        if ($error) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
        } else {
            $title = 'введенные данные соответствуют требованиям для регистрации';

            $user = addUser($pdo, $_POST);

            if ($user) {
                $title .= 'данные отправлены для проверки. О результатах вам будет отправлено сообщение на зарегистрированный email';
            } else {
                $error .= 'ошибка записи пользователя в базу. обратитесь по телефонам, указанным в контактах';
            }
        }
    }
}
?>

<p class="mt-3 text-center">Поля, помеченные *, обязательны для заполнения.</p>
<p class="mt-3 text-center">Пароль должен состоять из букв латинского алфавите, на разных регистрах, и цифр. Длинна пароля от 6 до 10 символов. </p>
<hr>
<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form  col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">ИНН <sup>*</sup><span>(будет использоваться как логин)</span></label>

            <input type="number" name="login" value="<?= $login ?>" id="login-id" class="enter-field form-control" required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="email-id">e-mail <sup>*</sup></label>

            <input type="email" name="email" value="<?= $email ?>" id="email-id" class="enter-field form-control" required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="phone-id">телефон <sup>*</sup></label>

            <input type="phone" name="phone" value="<?= $phone ?>" id="phonel-id" class="enter-field form-control" required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id-1">введите пароль <sup>*</sup></label>

            <input id="password_id" name="password_1" type="password" value="" id="password-id-1" class="enter-field form-control" required />
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id-2">повторите пароль <sup>*</sup></label>

            <input id="password_id" name="password_2" type="password" value="" id="password-id-2" class="enter-field form-control" required />
        </div>

        <input type="submit" value="Зарегистрироваться" name="registration" class="enter-button btn btn-primary" />

    </form>
</div>


<p class="text-center text-danger mt-3"><?= $error ?></p>
<p class="text-center text-success mt-3"><?= $title ?></p>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
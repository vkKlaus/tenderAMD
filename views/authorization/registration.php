<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';

?>
    <p class="text-center text-danger mt-3"><?= $title?></p>

<p class="mt-3">поля, помеченные *, обязятельны для заполнения</p>

<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form  col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">ИНН <sup>*</sup><span>(будет использоваться как логин)</span></label>

            <input type="number" name="login" value="<?=$login?>" id="login-id" class="enter-field form-control" required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="email-id">e-mail <sup>*</sup></label>

            <input type="email" name="email" value="<?=$email?>" id="email-id" class="enter-field form-control" required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="phone-id">телефон <sup>*</sup></label>

            <input type="phone" name="phone" value="<?=$phone?>" id="phonel-id" class="enter-field form-control"  required>
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id-1">введите пароль <sup>*</sup></label>

            <input id="password_id" name="password_1" type="password" value="" id="password-id-1" class="enter-field form-control" required/>
        </div>

        <div class="form-group">
            <label class="enter-label" for="password-id-2">повторите пароль <sup>*</sup></label>

            <input id="password_id" name="password_2" type="password" value="" id="password-id-2" class="enter-field form-control" required/>
        </div>

        <input type="submit" value="Зарегистрироваться" name="registration" class="enter-button btn btn-primary" />

    </form>
</div>


<p class="text-center text-danger mt-3"><?= $error?></p>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
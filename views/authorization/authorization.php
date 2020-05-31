<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>
<p class="mt-3">поля, помеченные *, обязятельны для заполнения</p>
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
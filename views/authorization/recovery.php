<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>
<p class="mt-3">поля, помеченные *, обязательны для заполнения / после изменеия пароля будет выполнен повторый запрос на разрешение работы</p>

<div class="d-flex justify-content-center mt-5">
    <form method="POST" class="enter-form   col-12 col-md-4">
        <div class="form-group">
            <label class="enter-label" for="login-id">ИНН <sup>*</sup></label>

            <input type="number" name="login" value="" id="login-id" class="enter-field form-control" required/>
        </div>

        <div class="form-group">
            <label class="enter-label" for="email-id">e-mail <sup>*</sup></label>

            <input type="email" name="email" value="" id="email-id" class="enter-field form-control">
        </div>

        <input type="submit" value="Восстановить" name="enter" class="enter-button btn btn-primary" required/>

    </form>
</div>


<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
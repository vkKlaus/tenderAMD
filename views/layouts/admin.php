<?php
$main = false;
$rules = false;
$contact = false;
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/headerConf.php';


if (isset($_POST['action'])){
    if (!isset($_POST['checkbox'])){
        $_POST['checkbox']='1'; 
    }else{
        $_POST['checkbox']='0'; 
    }
    actionUser($pdo,$_POST);
}

$users = getTable($pdo, 'users');

require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>
<h4 class="mt-2 border-bottom"><strong>Список пользователей</strong></h3>
    <div class="row border text-center bg-secondary">
        <div class="col-1 border-right">
            #
        </div>
        <div class="col-1 border-right">
            ИНН
        </div>
        <div class="col-2 border-right">
            название
        </div>
        <div class="col-2 border-right">
            эл.почта
        </div>
        <div class="col-1 border-right">
            телефон
        </div>
        <div class="col-2 border-right">
            адрес юридический
        </div>
        <div class="col-2 border-right">
            адрес фактический
        </div>
        <div class="col-1">
            разрешено
        </div>
    </div>
    <?php
    foreach ($users as $user) { ?>
        <div class="row border text-center mb-2">
            <div class="col-1 border-right">
                <?= $user['id'] ?>
            </div>

            <div class="col-1 border-right">
                <?= $user['inn'] ?>
            </div>

            <div class="col-2 border-right">
                <?= $user['name'] ?>
            </div>

            <div class="col-2 border-right">
                <?= $user['email'] ?>
            </div>
            <div class="col-1 border-right">
                <?= $user['phone'] ?>
            </div>
            <div class="col-2 border-right">
                <?= $user['address_legal'] ?>
            </div>
            <div class="col-2 border-right">
                <?= $user['address_actual'] ?>
            </div>
            <div class="col-1">
               <form method="POST">
               <button type="submit"  name="action" class="enter-button btn btn-outline-primary btn-sm m-1" ><?= ($user['action'] ? '&#10004;' : '&#10008;')?></button>

                   <input type="text" name="id" value="<?= $user['id'] ?>" style="visibility: hidden;   height: 0; width: 0;" >  
                   <input type="checkbox" name="checkbox" value="1"  <?= ($user['action'] ? 'checked' : '')?> style="visibility: hidden">
  
               </form>
            </div>
        </div>
    <?php }
    ?>

    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
    ?>
<?php
$viewDoc = false;

if (isset($_SESSION['user']['action']) && ($_SESSION['user']['action'] == 1)) {
    $viewDoc = true;
}

$project = getTable($pdo, 'project');

$type = getTable($pdo, 'type');


if (isset($_GET['page'])) {
    if ($_GET['page'] == 'left') {
        $_SESSION['page'] = $_SESSION['page'] - 1;
        if ($_SESSION['page'] < 0) {
            $_SESSION['page'] = 0;
        }
    } elseif ($_GET['page'] == 'right') {
        $_SESSION['page'] = $_SESSION['page'] + 1;
    }
} else {
    $_SESSION['page'] = 0;
}

$limit = ' ' . ($_SESSION['page'] * 15) . ', 15';

if (!isset($_SESSION['project'])){
    $_SESSION['project']=0; 
}
if (!isset($_SESSION['type'])){
    $_SESSION['type']=0; 
}
if (!isset($_SESSION['onlyOpen'])){
    $_SESSION['onlyOpen']=0; 
}

if (isset($_POST['select'])) {
    $prj = $_SESSION['project']=$_POST['project'];
    $tp = $_SESSION['type']=$_POST['type'];
    $open =  $_SESSION['onlyOpen']=isset($_POST['onlyOpen']) ? 1 : 0;
}
else{
    $prj = $_SESSION['project'];
    $tp = $_SESSION['type'];
    $open =  $_SESSION['onlyOpen']; 
};

$where = '';

if ($prj) {
    $where .= '`project`=' . $prj;
}

if ($tp) {
    $where .= ($where != '' ? ' AND ' : '') . '`type`=' . $tp;
}

if ($open) {
    $where .= ($where != '' ? ' AND ' : '') . '`close`=0';
}

$tenders = getTable($pdo, 'tenders', $where, '', $limit);

?>
<form action="/" method="POST" class=" pl-2 d-flex justify-content-between align-items-center lex-wrap row bg-secondary">

    <div class="d-flex justify-content-start align-items-center">
        <label class="title-select  text-right">проект:
            <select class=" m-1 list-select" id="project" name='project'>
                <option value=0>Все</option>

                <?php foreach ($project as $value) { ?>
                    <option value=<?= $value['id'] ?> <?= $value['id'] == $prj ? 'selected' : '' ?>><?= $value['name'] ?></option>
                <?php } ?>
            </select>
        </label>

        <label class="title-select  text-right">тип:
            <select class=" m-1 list-select" id="type" name='type'>>
                <option value=0>Все</option>

                <?php foreach ($type as $value) { ?>
                    <option value=<?= $value['id'] ?> <?= $value['id'] == $tp ? 'selected' : '' ?>><?= $value['name'] ?></option>
                <?php } ?>
            </select>
        </label>

        <label class="ml-4" for="only-open">
            <input class="form-check-input" type="checkbox" name="onlyOpen" id="only-open" <?= $open ? 'checked' : '' ?>>
            <span class="title-select ">только действующие</span>
        </label>

        <input type="submit" name="select" value="Отобрать" class="btn btn-info text-dark btn-select btn-sm ml-4">
    </div>
    <div class="pr-3">материалы тендера доступны авторизированным пользователям</div>
</form>

<div class="row">
    <div class="col-12  tender-tab border border-white ">
        <div class="row text-white-50 bg-dark text-center border border-white pt-1 pb-1">
            <div class="col-1 border border-white cell-table">
                <a href="/?sort=num" class="text-white-50"># &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=close" class="text-white-50">закрыт &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=type" class="text-white-50">тип &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=project" class="text-white-50">проект &#10606;</a>
            </div>

            <div class="col border border-white cell-table text-white-50"">
                описание
            </div>

            <div class=" col-1 border border-white cell-table">
                <a href="/?sort=dateOpen" class="text-white-50">открытие &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=dateClose" class="text-white-50">закрытие &#10606;</a>
            </div>

            <?php if ($viewDoc) { ?>
                <div class="col-1 border border-white cell-table text-white-50">
                    тз
                </div>
            <?php } ?>
        </div>
        <!------------------------------------------------------------------------------------->
        <?php
        $bg = true;
        foreach ($tenders as $tender) {

            foreach ($project as $value) {
                if ($value['id'] == $tender['project']) {
                    $prj = $value['name'];
                    break;
                }
            }
            foreach ($type as $value) {
                if ($value['id'] == $tender['type']) {
                    $tp = $value['name'];
                    break;
                }
            }
        ?>
            <div class=" row text-white-50 text-left <?= ($bg ? 'bg-light' : 'bg-wite') ?> mb-2 mt-2 p-1">
                <div class="col-1 text-dark cell-table"><?= $tender['id'] ?></div>
                <div class="col-1 text-dark cell-table"><?= $tender['close'] == 1 ? 'да' : 'нет' ?></div>
                <div class="col-1 text-dark cell-table"><?= $tp ?></div>
                <div class="col-1 text-dark cell-table"><?= $prj ?></div>
                <div class="col text-dark cell-table"><?= $tender['description'] ?></div>
                <div class="col-1 text-dark cell-table"><?= $tender['date_open'] ?></div>
                <div class="col-1 text-dark cell-table"><?= $tender['date_close'] ?></div>
                <?php if ($viewDoc) { ?>
                    <div class="col-1 text-dark cell-table">
                        <a href="#">документаци.zip</a>
                    </div>
                <?php } ?>
            </div>
        <?php $bg = $bg == true ? false : true;
        } ?>

        <hr>

        <div class="row paginator d-flex justify-content-center mb-3">
            <div class="col text-right">
                <a href="/?page=left" class="btn btn-outline-dark pl-5 pr-5 ">
                    <span class="h4">&#171;</span>
                </a>
            </div>

            <div class="col text-left">
                <a href="/?page=right" class="btn btn-outline-dark pl-5 pr-5 ">
                    <span class="h4">&#187;</span>
                </a>
            </div>
        </div>
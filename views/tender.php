<?php


$viewDoc = false;
if (isset($_SESSION['user']['action']) && ($_SESSION['user']['action'] == 1)) {
    $viewDoc = true;
}



$project = getTable($pdo, 'project');

$type = getTable($pdo, 'type');



if (!isset($_SESSION['project'])) {
    $_SESSION['project'] = 0;
}

if (!isset($_SESSION['type'])) {
    $_SESSION['type'] = 0;
}

if (!isset($_SESSION['onlyOpen'])) {
    $_SESSION['onlyOpen'] = 1;
}

if (isset($_POST['select'])) {
    $prj = $_SESSION['project'] = $_POST['project'];
    $tp = $_SESSION['type'] = $_POST['type'];
    $open =  $_SESSION['onlyOpen'] = isset($_POST['onlyOpen']) ? 1 : 0;
} else {
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

if (isset($_GET['sort'])) {
    if (!isset($_SESSION['sort'])) {
        $_SESSION['sort']['fild'] = 'id';
        $_SESSION['sort']['direct'] = 'DESC';
    }

    if ($_SESSION['sort']['fild'] == $_GET['sort']) {
        $_SESSION['sort']['direct'] = $_SESSION['sort']['direct'] == 'ASC' ? 'DESC' : 'ASC';
    } else {
        $_SESSION['sort']['fild'] = $_GET['sort'];
        $_SESSION['sort']['direct'] = 'ASC';
    }
    $sort = '`' . $_SESSION['sort']['fild'] . '` ' . $_SESSION['sort']['direct'];
} else {
    $sort = '`date_open` DESC, `date_close` ASC';
};


if (isset($_GET['page'])) {
    if ($_GET['page'] == 'left') {
        $_SESSION['page'] = $_SESSION['page'] - 1;
        if ($_SESSION['page'] < 0) {
            $_SESSION['page'] = 0;
        }
    } elseif ($_GET['page'] == 'right') {
        $_SESSION['page'] = $_SESSION['page'] + 1;
    } elseif ($_GET['page'] == 'begin') {
        $_SESSION['page'] = 0;
    } elseif ($_GET['page'] == 'end') {

        $page = (int)((getCountElements($pdo, 'tenders', $where) - 25) / 25);
        $_SESSION['page'] = $page;
    }
} else {
    $_SESSION['page'] = 0;
}

$limit = ' ' . ($_SESSION['page'] * 25) . ', 25';

$tenders = getTable($pdo, 'tenders', $where, $sort, $limit);

?>
<form action="/" method="POST" class=" pl-2 d-flex justify-content-between align-items-center lex-wrap row bg-white pt-2">

    <div class="d-flex justify-content-start align-items-center">
        <label class="title-select  text-right ">проект:
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

            <span class="check-box__title">только действующие</span>
        </label>

        <input type="submit" name="select" value="Отобрать" class="ml-3 h6 btn btn-outline-danger  px-3 mt-1  text-danger font-weight-bold rounded-0 btn-sm">
    </div>
    <div class="pr-3">материалы тендера доступны авторизированным пользователям</div>
</form>

<div class="row">
    <div class="col-12  tender-tab border border-white ">
        <div class="row text-white-50 bg-dark text-center border border-white pt-1 pb-1">
            <div class="col-1 border border-white cell-table">
                <a href="/?sort=id" class="text-white-50"># &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=close" class="text-white-50">в работе &#10606;</a>
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
                <a href="/?sort=date_open" class="text-white-50">открытие &#10606;</a>
            </div>

            <div class="col-1 border border-white cell-table">
                <a href="/?sort=date_close" class="text-white-50">закрытие &#10606;</a>
            </div>

            <?php if ($viewDoc) { ?>
                <div class="col-1 border border-white cell-table text-white-50">
                    материалы
                </div>
            <?php } ?>
        </div>
        <!------------------------------------------------------------------------------------->
        <div class="box_tender">
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
                <div class=" row text-white-50 text-left <?= ($tender['close'] ? 'bg-secondary' : ($bg ? 'bg-light' : 'bg-wite')) ?> mb-2 mt-2 p-1">
                    <div class="col-1 text-dark text-center cell-table"><?= $tender['id'] ?></div>

                    <div class="col-1 text-dark text-center cell-table"><?= $tender['close'] == 1 ? 'нет' : 'да' ?></div>

                    <div class="col-1 text-dark text-center cell-table"><?= $tp ?></div>

                    <div class="col-1 text-dark text-center cell-table"><?= $prj ?></div>

                    <div class="col text-dark cell-table"><?= $tender['description'] ?></div>

                    <div class="col-1 text-dark text-center cell-table"><?= $tender['date_open'] ?></div>

                    <div class="col-1 text-dark text-center cell-table"><?= $tender['date_close'] ?></div>

                    <?php if ($viewDoc) { ?>
                        <div class="col-1 text-dark cell-table">
                            <form method="POST" class="d-flex justify-content-center">
                                <input type="text" name="id" value="<?= $tender['id'] ?>" class="d-none">
                                <button type="submit" name="downDoc" value="/archDocs/<?= $tender['documents'] ?>" 
                                class="border-0  <?= ($tender['close'] ? 'bg-secondary ' : ($bg ? 'bg-light' : 'bg-wite')) ?> text-dark " 
                                <?= ($tender['close'] ? 'disabled ' : '') ?>>
                                    <?= $tender['documents'] ?></button>
                            </form>

                        </div>
                    <?php } ?>
                </div>
            <?php $bg = $bg == true ? false : true;
            } ?>
        </div>
        <hr>

        <div class="row paginator d-flex justify-content-center pb-3">

            <a href="/?page=begin" class="btn btn-outline-dark pl-5 pr-5 ml-1 mr-1">
                <span class="h4">|&#171;&#171;</span>
            </a>

            <a href="/?page=left" class="btn btn-outline-dark pl-5 pr-5  ml-1 mr-1">
                <span class="h4">&#171;</span>
            </a>

            <a href="/?page=right" class="btn btn-outline-dark pl-5 pr-5  ml-1 mr-1">
                <span class="h4">&#187;</span>
            </a>

            <a href="/?page=end" class="btn btn-outline-dark pl-5 pr-5  ml-1 mr-1">
                <span class="h4">&#187;&#187;|</span>
            </a>

        </div>
<?php
$main = false;
$rules = false;
$contact = true;
$mainSite = false;

require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/headerConf.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>
<div class="row h5 text-dark mt-5 mb-5">
    <div class="col text-center">
        <?php
        foreach ($contacts as $cont) { ?>
            <div class="row mt-3">
                <div class="col-3 text-right">
                    <?= $cont['title'] ?>:
                </div>

                <div class="col text-left">
                    <?php

                    if ($cont['type'] == 'tel' || $cont['type'] == 'mailto') {
                    ?>
                        <a href="<?= $cont['type'] . ':' . ' ' . $cont['contact'] ?>">
                            <span class="text-dark">
                                <?= $cont['specchar'] . '&#8195;' .  $cont['info'] ?>
                            </span>
                        </a>
                    <?php } else { ?>

                        <?= $cont['specchar'] . '&#8195;'  . $cont['info'] ?>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<hr>
<div class="row d-flex justify-content-md-center justify-content-md-around text-muted  flex-wrap">
    <div class="col-12 col-md-3">
        <div class="mb-2 mt-3">Офис</div>

        <a href="https://yandex.ru/maps/?um=constructor%3A2ea26cab0ed1e7bc7b0b4fce9f33f654009062db5f7ce347b4a52757d681f872&amp;source=constructorStatic" target="_blank"><img src="https://api-maps.yandex.ru/services/constructor/1.0/static/?um=constructor%3A2ea26cab0ed1e7bc7b0b4fce9f33f654009062db5f7ce347b4a52757d681f872&amp;width=320&amp;height=250&amp;lang=ru_RU" alt="" style="border: 0;" /></a>
    </div>
    <div class="col-12 col-md-3 ">
        <div class="mb-2 mt-3">ЖК "Две столицы"</div>

        <a href="https://yandex.ru/maps/?um=constructor%3A09ad468820836dacf59ccd3e42a4c00c67fea14b60e763b8439d924a697c753d&amp;source=constructorStatic" target="_blank"><img src="https://api-maps.yandex.ru/services/constructor/1.0/static/?um=constructor%3A09ad468820836dacf59ccd3e42a4c00c67fea14b60e763b8439d924a697c753d&amp;width=320&amp;height=250&amp;lang=ru_RU" alt="" style="border: 0;" /></a>
    </div>
    <div class="col-12 col-md-3">
        <div class="mb-2 mt-3">ЖК "Бартон"</div>

        <a href="https://yandex.ru/maps/?um=constructor%3Ab832f118007048e164b95b0254f512b5586a79bd8505b38668a6ed201708400e&amp;source=constructorStatic" target="_blank"><img src="https://api-maps.yandex.ru/services/constructor/1.0/static/?um=constructor%3Ab832f118007048e164b95b0254f512b5586a79bd8505b38668a6ed201708400e&amp;width=320&amp;height=250&amp;lang=ru_RU" alt="" style="border: 0;" /></a>
    </div>

</div>



<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
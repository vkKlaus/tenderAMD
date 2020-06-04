<?php
$main=false;
$rules=true;
$contact=false;
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';
?>

<div class="col">
    <h3 class="text-center mt-5">Требования предъявляемые к участнику тендера</h3>

    <ul class="ml-5 list-rules">
        <li>отсутствие у участника задолженности или недоимки по налогам (в случае наличия — веские причины для их обоснования);</li>
        <li>отсутствие у руководителя и других должностных лиц компании-участника судимости в экономической сфере (исключение — погашенная или снятая судимость);</li>
        <li>наличие у участника исключительных прав на результаты интеллектуальной деятельности (исключение — контракты на создание произведений литературы или искусства, на финансирование проката или показа национального фильма);</li>
        <li>отсутствие конфликта интересов между заказчиком и участником (то есть первые лица компаний заказчика и исполнителя не могут состоять в родственных связях, так как всем участникам тендера должны быть обеспечены равные условия).</li>
        <li>участник тендера не может быть офшорной компанией;</li>
        <li>информация об участнике не должна присутствовать в реестре недобросовестных поставщиков и подрядчиков;</li>
        <li>деятельность компании не должна быть приостановлена;</li>
        <li>компания не должна быть ликвидирована;</li>
        <li>компания не должна быть банкротом.</li>
        <li>опыт работы, связанный с предметом закупки;</li>
        <li>положительная деловая репутация участника;</li>
        <li>финансовые возможности для выполнения условий контракта;</li>
        <li>необходимое количество профильных сотрудников в штате компании для исполнения контракта ;</li>
        <li>наличие оборудования и других материальных ресурсов для исполнения контракта.</li>
    </ul>

    <h3 class="text-center mt-5">Для участия в тендере необходимо</h3>

    <ul class="ml-5 list-rules">
        <li>Пройти регистрацию на сайте</li>
        <li>Предоставить ИНН для проверки регистрируемой компании, фирмы, ИП</li>
        <li>Ознакомиться с условиями тендера</li>
        <li>Скачать архивный файл для изучения и подготовки коммерческого предложения</li>
        <li>Заполнить форму запроса для предоставления коммерческого предложения</li>
    </ul>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
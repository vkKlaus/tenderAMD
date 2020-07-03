<?php
$main=true;
$rules=false;
$contact=false;
$mainSite = false;

 require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/headerConf.php';
 require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php';

?>

<?php
 //createDB($pdo);
require $_SERVER['DOCUMENT_ROOT'] . '/views/tender.php';

?>


<?php
 require $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php';
?>
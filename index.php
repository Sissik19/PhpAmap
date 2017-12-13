<?php
require 'classes/HtmlDocument.class.php';
require 'classes/PageInexistanteException.php';
//require 'libs/mobile.lib.php';
//TRY THIS
$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$doc = new HtmlDocument($page);
$doc->applyTemplate('default');
$doc->render();
?>
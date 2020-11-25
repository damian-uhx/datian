<?php
require '../vendor/autoload.php';

$less = new lessc;
try {
    $less->checkedCompile("../style/style.less", "../style/style.css");
}
catch (exception $e) {
    echo "fatal error: " . $e->getMessage();
  }

?>
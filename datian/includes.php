<?php

foreach (glob("settings/*.php") as $filename)
{
    include_once $filename;
}


include_once 'core/helper.php';
include_once 'core/logic.php';
include_once 'core/cud.php';

foreach (glob("view/*.php") as $filename)
{
    include_once $filename;
}

foreach (glob("migration/*.php") as $filename)
{
    include_once $filename;
}


?>
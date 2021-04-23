<?php

function load ($className )
{
    include_once "classes/$className.php";
}


spl_autoload_register('load');

<?php 
spl_autoload_register(function ($class_name) 
{     
    include_once "./Php/Classes/".$class_name . '.Php';
} );
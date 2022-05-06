<?php

/**
 * Автор: Цвор Андрей
 * 
 * Дата реализации: 04.05.2022 13:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Подключение классов, работа с данными
 */

include_once 'vendor/autoload.php';
session_start();

use Classes\User;
use Classes\IsClassUser;
if (!IsClassUser::checkClassUser()) {
    exit('Отсутствует подключение к классу User');
}
use Classes\ListUsers;
use Classes\ConnectDataBase;
use Classes\Validation;

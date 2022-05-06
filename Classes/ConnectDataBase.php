<?php
/**
 * Автор: Андрей Цвор
 * 
 * Дата реализации: 04.05.2022 13:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Информация о базе данных и подключение к ней
 */

const SERVER = 'localhost';
const USERNAME = 'root';
const PASSWORD = 'root';
const DATABASE = 'dbusers';

if (!$connection) {
    $connection = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
}

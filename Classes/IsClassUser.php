<?php
/**
 * Автор: Андрей Цвор
 * 
 * Дата реализации: 06.05.2022 13:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Проверка подключения к классу User
 */

namespace Classes;

/**
 * Класс IsClassUser
 * Проверяет наличие класса User, возвращает true если есть, false если нет
 */

class IsClassUser
{
    public static function checkClassUser()
    {
        if (class_exists('Classes\User') && file_exists('Classes/User.php')) {
            return true;
        } else {
            return false;
        }
    }
}

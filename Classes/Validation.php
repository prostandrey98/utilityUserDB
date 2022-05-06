<?php
/**
 * Автор: Андрей Цвор
 * 
 * Дата реализации: 05.05.2022 16:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Класс для проверки вводимых данных
 */

namespace Classes;

/**
 * Класс Validation
 * Позволеят проверить введенные данные
 * Методы:
 * CheckOnlySymbol. Проверяет, что введенная строка состоит только из буквенных символов.
 * CheckDate. Проверяет, что формат введенной даты соответствует требованию.
 * CheckGender. Проверяет, что введенный пол хранится в логическом виду.
 */

class Validation
{
    public static function checkOnlySymbol(string $string)
    {
        if (preg_match('/^[A-zА-яЁё]+$/iu', $string) != true) {
            return 'Введенные данные должны содержать только буквы';    
        }
    }

    public static function checkDate(string $date)
    {
        if (DateTime::createFromFormat('Y-m-d', $date) != true) {
            return 'Дата введена не корректно';
        }
    }

    public static function checkGender($gender)
    {
        if ($gender != 0 && $gender != 1) {
            return 'Значение половой принадлежности может быть только 0 (муж) или 1 (жен)';
        }
    }
}

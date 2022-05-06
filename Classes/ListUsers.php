<?php
/**
 * Автор: Андрей Цвор
 * 
 * Дата реализации: 05.05.2022 23:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Работа со списками пользователей
 */

namespace Classes;

/**
 * Класс ListUsers
 * Работа со списками пользователей
 * Методы:
 * Construct. Позволяет найти id пользователей и заносит их в массив. Позволяет искать по
 * строке, а так же в различных диапазонах id
 * GetUser. Позволяет получить массив пользователей по списку id, полученном с помощью контруктора
 * DeleteUsers. Позволяет удалить пользователей из БД по списку id.
 */

class ListUsers
{
    public $users_id = [];
    public $users = [];
    public $message;

    /**
     * Функция совершает поиск по всем полям базы данных на наличие искомой строки и, если
     * строка была найдена у какого-либо пользователя, добавляет id пользователя в массив.
     * Так же функция позволят вводить области поиска по id.
     * 
     * $string - искомая строка.
     * $min_id - номер id, с которого начать поиск.
     * $max_id - номер id, на котором закончить поиск.
     * $not_id - инверсия поиска, то есть использовать те варианты, которые не входят в 
     * область $min_id-$max_id
     * 
     * Функция возвразает экземпляр класса, с записанными id пользователей, которые 
     * удовлетворяют поиску 
     */

    public function __construct(string $string, $min_id = NULL, $max_id = NULL, $not_id = false)
    {
        $connection = DataBase::includeDataBase();
        if (gettype($min_id) !== 'integer' && $min_id !== NULL) {
            return $this->message = 'Второй парметр функции должен иметь тип "integer"';
        } 
        if (gettype($max_id) !== 'integer' && $max_id !== NULL) {
            return $this->message = 'Третий парметр функции должен иметь тип "integer"';
        }
        if (gettype($not_id) !== 'boolean') {
            return $this->message = 'Четвертый параметр должен быть true или false';
        } 
        if ($min_id === NULL && $max_id === NULL && $not_id === false) {
            $sql = "SELECT id FROM user
                    WHERE first_name LIKE '%$string%' OR
                          last_name LIKE '%$string%' OR
                          birthday LIKE '%$string%' OR
                          gender LIKE '%$string%' OR
                          birth_city LIKE '%$string%'";
        } else if ($min_id !== NULL && $max_id === NULL && $not_id === false) {
            $sql = "SELECT id FROM user
                    WHERE (first_name LIKE '%$string%' OR
                          last_name LIKE '%$string%' OR
                          birthday LIKE '%$string%' OR
                          gender LIKE '%$string%' OR
                          birth_city LIKE '%$string%') AND
                          id > '$min_id'";
        } else if ($min_id !== NULL && $max_id !== NULL && $not_id === false) {
            $sql = "SELECT id FROM user
                    WHERE (first_name LIKE '%$string%' OR
                          last_name LIKE '%$string%' OR
                          birthday LIKE '%$string%' OR
                          gender LIKE '%$string%' OR
                          birth_city LIKE '%$string%') AND
                          id > '$min_id' AND
                          id < '$max_id'";
        } else if ($min_id !== NULL && $max_id !== NULL && $not_id === true) {
            $sql = "SELECT id FROM user
                    WHERE (first_name LIKE '%$string%' OR
                          last_name LIKE '%$string%' OR
                          birthday LIKE '%$string%' OR
                          gender LIKE '%$string%' OR
                          birth_city LIKE '%$string%') AND
                          (id < '$min_id' OR
                          id > '$max_id')";
        }
        $res_select = $connection->query($sql);
        while ($user = mysqli_fetch_object($res_select)) {
            $this->users_id[] = intval($user->id);
        }
        return $this;
    }

    public function getUsers()
    {
        if (!$this->users_id) {
            return $this->message = 'Массив id пользователей пуст';
        } else {
            foreach ($this->users_id as $id) {
                $user = new User($id);
                $this->users[] = $user;
            }
            return $this->users;
        }
    }

    public function deleteUsers()
    {
        if (!$this->users_id) {
            return $this->message = 'Массив id пользователей пуст';
        } else {
            foreach ($this->users_id as $id) {
                $user = new User($id);
                $user->deleteUser($id);
            }
        }
    }
}

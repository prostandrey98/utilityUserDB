<?php
/**
 * Автор: Андрей Цвор
 * 
 * Дата реализации: 04.05.2022 14:00
 * 
 * Дата изменения: 06.05.2022 17:00
 * 
 * Класс для работы с пользователем
 */

namespace Classes;

/**
 * Класс User
 * Работа с конкретным экземпляром пользователя.
 * Пользователь имеет такие свойства, как Имя, фамилия, день рождения, пол и город рождения.
 * Методы:
 * Construct. Создает новый экземпляр пользоваетля или находит пользователя по id в БД.
 * SaveUser. Добавляет экземляр пользователя в БД.
 * DeleteUser. Удаляет экземпляр пользователя из БД по id.
 * GetAge. Возвращает возраст пользователя исходя из его даты рождения.
 * GetGender. Преобразовывает логическое представления половой принадлежности в строковую.
 * FormatUser. Возвращает экземпляр пользователя с преобразованными возрастом и полом.
 * ReadUser. Позволяет найти пользователя в БД по id.
 */


class User
{
    public $id;
    public $first_name;
    public $last_name;
    public $birthday;
    public $gender;
    public $birth_city;
    public $message;

    public function __construct($id_or_first_name = NULL, $last_name = NULL, $birthday = NULL, 
        $gender = NULL, $birth_city = NULL
    ) {
        if ($id_or_first_name === NULL) {
            return $this->message = 'Невозвожно создать экземляр';
        } else if(gettype($id_or_first_name) !== 'integer') {
            $this->first_name = $id_or_first_name;
            $this->last_name = $last_name;
            $this->birthday = $birthday;
            $this->gender = $gender;
            $this->birth_city = $birth_city;
            return $this;
        } else {
            $dbuser = User::readUser($id_or_first_name);
            $this->id = $dbuser->id;
            $this->first_name = $dbuser->first_name;
            $this->last_name = $dbuser->last_name;
            $this->birthday = $dbuser->birthday;
            $this->gender = $dbuser->gender;
            $this->birth_city = $dbuser->birth_city;
            return $this;
        }
    }

    public function saveUser()
    {
        $connection = DataBase::includeDataBase();
        if ($this->id !== NULL) {
            $sql = "UPDATE user
                    SET first_name='$this->first_name', 
                        last_name='$this->last_name',
                        birthday='$this->birthday', 
                        gender='$this->gender',
                        birth_city='$this->birth_city'
                    WHERE id='$this->id'";
        } else {
            $sql = "INSERT INTO `user` (first_name, last_name, birthday, gender, birth_city)
                    VALUES ('$this->first_name', '$this->last_name', '$this->birthday', '$this->gender', '$this->birth_city')";
        }
        $res_insert = $connection->query($sql);
    }

    public function deleteUser(int $id)
    {
        $connection = DataBase::includeDataBase();
        $sql = "DELETE FROM `user` WHERE id=$id";
        $res_delete = $connection->query($sql);
    }

    public static function getAge(string $birthday): string
    {
        return substr((date('Ymd') - date('Ymd', strtotime($birthday))), 0, -4);
    }

    public static function getGender($gender): string
    {
        if ($gender == 0) {
            return 'муж';
        } else {
            return 'жен';
        }
    }

    public static function formatUser($user)
    {
        if ($user->birthday !== NULL) {
            $birthday = User::getAge($user->birthday);
        } else {
            $birthday = NULL;
        }
        if ($user->gender !== NULL) {
            $gender = User::getGender($user->gender);
        } else {
            $gender = NULL;
        }
        return ($format_user = new User($user->first_name, 
                                        $user->last_name, 
                                        $birthday, 
                                        $gender, 
                                        $user->birth_city));
    }

    public static function readUser(int $id): object
    {
        $connection = DataBase::includeDataBase();
        $sql = "SELECT * FROM `user` WHERE id=$id";
        $res_select = $connection->query($sql);
        $user = mysqli_fetch_object($res_select);
        return $user;
    }
}

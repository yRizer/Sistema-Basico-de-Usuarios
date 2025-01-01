<?php 

    namespace App\library;

    class Security {

        /**
         * Validação de Nome
         * @param mixed $username
         * @return bool|int
         */
        public static function checkUsername($username) {
            return preg_match('/^[\w]+$/', $username);
        }

        /**
         * Validação de Senha
         * @param mixed $password
         * @return bool|int
         */
        public static function checkPassword($password) {
            return preg_match('/^[\w\W]+$/', $password);
        }

        /**
         * Validação de Email
         * @param mixed $email
         * @return bool|int
         */
        public static function checkEmail($email) {
            return preg_match('/^[\w\-\.]+@([\w\-]+\\.)+[\w\-]{2,4}$/', $email);
        }


    }
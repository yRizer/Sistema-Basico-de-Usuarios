<?php

namespace App\db;

use App\library\Security;
use PDO;
use PDOException;

class DataBase
{
    // Add your methods and properties here

    private $host = "localhost";
    private $port = '3306';
    private $username = 'root';
    private $password = 'tata789741';

    private $conn = null;

    /**
     * Executa um código SQL
     * @param string $sql
     * @param array $arrayParams
     */
    private function execute($sql, $arrayParams)
    {
        $stmt = $this->conn->prepare($sql);

        try {
            foreach ($arrayParams as $key => $value) {

                // Verifica o tipo do valor
                if (is_int($value)) {
                    $param = PDO::PARAM_INT;
                } elseif (is_bool($value)) {
                    $param = PDO::PARAM_BOOL;
                } elseif (is_null($value)) {
                    $param = PDO::PARAM_NULL;
                } elseif (is_string($value)) {
                    $param = PDO::PARAM_STR;
                } else {
                    $param = FALSE;
                }

                if ($param) {
                    $stmt->bindValue($key + 1, $value, $param);
                }
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "<hr>Erro ao executar o código SQL: " . $e->getMessage();
        } finally {
            $stmt = null;
            $this->conn = null;
            // echo "<br>Conexão fechada";
        }
    }

    /**
     * Conecta ao banco de dados
     */
    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=testevaga", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "<br>Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Cadastra um usuário no banco de dados
     * @param string $nome
     * @param string $email
     * @param string $senha
     */
    public function cadastrar($nome, $email, $senha)
    {
        try {
            $isNameValid = Security::checkUsername($_POST['name']);
            $isEmailValid = Security::checkEmail($_POST['email']);
            $isPasswordValid = Security::checkPassword($_POST['password']);

            if ($isNameValid && $isEmailValid && $isPasswordValid && !$this->UserExist($email)) {
                $this->connect();
                $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
                $this->execute($sql, [$nome, $email, md5($senha)]);

                return true;
            } else {
                if ($this->UserExist($email)) {
                    // echo 'Usuário já cadastrado';
                } else {
                    // echo 'Cadastro inválido';
                }

                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Verifica se o Usuário já existe
     * @param mixed $email
     * @return bool
     */
    public function UserExist($email)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "SELECT nome FROM users WHERE email = ?";
        $query = $this->execute($sql, [$email])->fetchAll();

        return count($query) > 0;
    }

    public function Login($email, $senha)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "SELECT * FROM users WHERE email = ? AND senha = ?";
        $query = $this->execute($sql, [$email, $senha])->fetch(PDO::FETCH_ASSOC);
        return $query;
    }

    public function SetNewProfileImage($id, $newProfileImagePath)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "UPDATE users SET profile_image = ? WHERE id_user = ?";
        $query = $this->execute($sql, [$newProfileImagePath, $id]);
        return $query;
    }

    public function updateName($id, $newName)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "UPDATE users SET nome = ? WHERE id_user = ?";
        $query = $this->execute($sql, [$newName, $id]);
        return $query;
    }

}

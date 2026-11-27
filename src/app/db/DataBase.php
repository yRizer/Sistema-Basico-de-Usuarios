<?php

namespace App\db;

use App\library\Security;
use PDO;
use PDOException;

class DataBase
{
    // Add your methods and properties here

    // Credenciais lidas do ambiente (veja o README). Nunca escreva a senha aqui.
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;

    private $conn = null;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->port = getenv('DB_PORT') ?: '3306';
        $this->database = getenv('DB_NAME') ?: 'testevaga';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
    }

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
            // Loga o erro sem expor detalhes do banco para o usuário
            error_log('Erro ao executar SQL: ' . $e->getMessage());
            return false;
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
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database;charset=utf8mb4", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "<br>Connected successfully";
        } catch (PDOException $e) {
            error_log('Falha na conexão com o banco: ' . $e->getMessage());
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
                $this->execute($sql, [$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);

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
            error_log('Erro no cadastro: ' . $e->getMessage());
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

    /**
     * Valida e-mail e senha. Retorna os dados do usuário (sem a senha) ou false.
     * Contas antigas salvas com md5 são aceitas uma vez e migradas para password_hash.
     * @param string $email
     * @param string $senha senha em texto puro, como digitada no formulário
     */
    public function Login($email, $senha)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->execute($sql, [$email]);
        $user = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

        if (!$user) {
            return false;
        }

        $hash = $user['senha'];
        $valid = password_verify($senha, $hash);

        // Compatibilidade com senhas antigas em md5
        if (!$valid && strlen($hash) === 32 && hash_equals($hash, md5($senha))) {
            $valid = true;
        }

        if (!$valid) {
            return false;
        }

        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            $this->connect();
            $this->execute(
                "UPDATE users SET senha = ? WHERE id_user = ?",
                [password_hash($senha, PASSWORD_DEFAULT), $user['id_user']]
            );
        }

        unset($user['senha']);
        return $user;
    }

    /**
     * Busca os dados do usuário (sem a senha) pelo id
     * @param int $id
     */
    public function getUserById($id)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        $sql = "SELECT * FROM users WHERE id_user = ?";
        $stmt = $this->execute($sql, [$id]);
        $user = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

        if ($user) {
            unset($user['senha']);
        }

        return $user;
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

<?php

require_once __DIR__.'../Database/UserDatabase.php';

class DatabaseSchema {
    private UserDatabase $userDatabase;

    public function __construct(UserDatabase $userDatabase) {
        $this->userDatabase = $userDatabase;
    }

    public function createTable() {
        $conn = $this->userDatabase->connect();

        if ($conn) {
            $tableName = 'exemplo'; // Defina o nome da tabela
            $query = "CREATE TABLE IF NOT EXISTS $tableName (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nome VARCHAR(50) NOT NULL,
                        email VARCHAR(50) NOT NULL
                      )";

            try {
                $conn->exec($query);
                echo "Tabela criada com sucesso!";
            } catch (PDOException $e) {
                echo "Erro ao criar a tabela: " . $e->getMessage();
            }
        } else {
            echo "Não foi possível conectar ao banco de dados.";
        }
    }

    public function insertData($nome, $email) {
        $conn = $this->userDatabase->connect();

        if ($conn) {
            $tableName = 'exemplo'; // Defina o nome da tabela
            $query = "INSERT INTO $tableName (nome, email) VALUES (:nome, :email)";

            try {
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                echo "Dados inseridos com sucesso!";
            } catch (PDOException $e) {
                echo "Erro ao inserir dados: " . $e->getMessage();
            }
        } else {
            echo "Não foi possível conectar ao banco de dados.";
        }
    }
}

// Configurações do banco de dados
$hosting = '127.0.0.1';
$database_name = 'popular';
$user_name = 'root';
$define_password = null;

// Crie uma instância da classe UserDatabase
$userDatabase = new UserDatabase($hosting, $database_name, $user_name, $define_password);

// Crie uma instância da classe DataInsertion
$dataInsertion = new DatabaseSchema($userDatabase);

// Exemplo de criação de tabela
$dataInsertion->createTable();

// Exemplo de inserção de dados
$dataInsertion->insertData('Exemplo Nome', 'exemplo@email.com');

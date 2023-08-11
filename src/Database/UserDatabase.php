<?php

require_once __DIR__.'./Database.php';

class UserDatabase extends Database
{
    public function __construct(string $hosting, string $database_name, string $user_name, $define_password)
    {
        parent::__construct($hosting, $database_name, $user_name, $define_password);
    }
}

$hosting = readline('enter hosting: ');
$database_name = readline('enter database_name: ');
$user_name = readline('enter user_name: ');
$define_password = readline('enter define_password: ');


$createDatabase = new UserDatabase($hosting, $database_name, $user_name, $define_password = '');

$conn = $createDatabase->connect();

if ($conn) {
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} else {
    echo " . Não foi possível conectar ao banco de dados.";
}

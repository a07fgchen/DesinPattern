<?php

include_once "./DatabaseConnection.php";

// namespace Design\Dependency;

class DatabaseConfiguration
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $host, int $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

$config = new DatabaseConfiguration(
    'localhost',
    3306,
    'domnikl',
    '1234'
);

try {
    echo "<pre>";
    $connection = new DatabaseConnection($config);
    var_dump(
        $connection->getDsn()
    );   
    } catch (\Throwable $th) {
    throw $th;
}
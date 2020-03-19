<?php

class DataBaseHandler
{
    private const HOST = "localhost";
    private const PORT = 5433;
    private const USER = "root";
    private const PASSWORD = "";
    private const CHARSET = 'utf8';
    protected $pdo;
    protected function __construct(string $databaseName)
    {
        try
        {
            //https://www.postgresqltutorial.com/postgresql-php/
            //https://www.postgresqltutorial.com/postgresql-php/connect/
            //postgreSQL
            // $dsn = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            //     self::HOST,
            //     self::PORT,
            //     $databaseName,
            //     self::USER,
            //     self::PASSWORD);
            // $this->pdo = new PDO($dsn);
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $dsn = 'mysql:host=' . self::HOST . ';dbname=' . $databaseName . ';charset=' . self::CHARSET;
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]; 
            $this->pdo = new PDO($dsn, self::USER, self::PASSWORD, $opt);

        }
        catch(PDOException $e)
        {
            die('Connection Error : ' . $e->getMessage() );
        }
    }
}
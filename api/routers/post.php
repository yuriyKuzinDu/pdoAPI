<?php

$data = API::getData();
if ($data === [])
    $data = json_decode(file_get_contents('php://input'),true);

try
{
    $TableModel->insert($data);
    $status = '201';
    $message = 'success';
    include 'routers/success.php';
}
catch(PDOException $e)
{
    $error = $e->getMessage();
}
catch(Throwable $e)
{
    $error = 'Invalid data or table';
}
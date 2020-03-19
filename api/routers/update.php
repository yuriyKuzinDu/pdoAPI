<?php

$data = API::getData();
if ($data === [])
    $data = json_decode(file_get_contents('php://input'),true);

try
{
    $responseBody = $TableModel->update($data,API::getWhere()) . ' affected rows';
    $status = '200';
    $message = 'success';
    include 'routers/success.php';
}
catch(PDOException $e)
{
    $error = $e->getMessage();
}
catch(Throwable $e)
{
    $error = 'Bad Request';
}
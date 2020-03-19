<?php

try
{
    $responseBody = $TableModel->delete(API::getWhere()) . ' affected rows';
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
<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'model/TableModel.php';
require_once 'core/API.php';

$TableModel = new TableModel(API::getDbName(),API::tableName());
$method = API::method();
$error = 'Bad Request';
$status = '400';
$responseBody = [];
include "routers/$method.php";
include 'routers/bad_request.php';

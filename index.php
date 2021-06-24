<?php 
session_start();
//load models
require "config.php";
require "connectDB.php";
require "functions.php";
require "model/Student.php";
require "model/StudentRepository.php";

require "model/Subject.php";
require "model/SubjectRepository.php";

require "model/Register.php";
require "model/RegisterRepository.php";
//router
$c = $_GET["c"] ?? "student";
$a = $_GET["a"] ?? "list";
$controllerName = ucfirst($c). "Controller";//StudentController
require "controller/" . $controllerName . ".php";
$controller = new $controllerName;//new StudentController
$controller->$a();//$controller->list()
?>
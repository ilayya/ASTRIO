<?php

/*
worker - сотрудник
department - отдел предприятия

Структура таблиц:

CREATE TABLE `worker` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`firstname` varchar(100) NOT NULL,
`lastname` varchar(100) NOT NULL,
`middlename` varchar(100) NOT NULL,
`department_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8

CREATE TABLE `department` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8

Необходимо составить два sql - запроса:

Выводит название отделов, в которых имеется 5 и более сотрудников
Выводит 2 столбца, в первом выводится название отдела, во втором id всех сотрудников данного отдела, перечисленные через запятую.
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$dbName = "testwork";
$dbUser = "root";
$dbPassword = "usbw";

$connection = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

$sql = "SELECT `department`.`name` FROM `department`
  WHERE  (SELECT COUNT( * ) FROM  `worker`
  WHERE  `department_id` =  `department`.`id`) > 4";

foreach($connection->query($sql) as $row) {
  echo "В отделе ".$row['name']." работает более 5 человек<br/>";
}

$sql = "SELECT `department`.`name`, `worker`.`id`
        FROM `department` INNER JOIN `worker`
        ON `worker`.`department_id` =   `department`.`id`";

echo "<br/><br/><table><tr><td>Department</td><td>Workers</td></tr>";

$key = "";

foreach($connection->query($sql) as $row) {
  if ($key == $row['name']) {

    echo ",".$row['id'];

  } else{

    echo "</td></tr><tr><td>".$row['name']."</td><td>".$row['id'];
    $key = $row['name'];

  }
}
echo "</td></tr></table>";

?>

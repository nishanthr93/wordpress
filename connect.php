<?php
error_reporting(E_ALL);
$link = mysqli_connect('http://aaecho.org/phpmyadmin', 'root', 'Boomer5!');
if (!$link) {
die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';
mysqli_close($link);

die();

?>
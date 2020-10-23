<?php

$conn = mysqli_connect('localhost', 'JacobDB', '', 'jacobdb');

if(!$conn){
	echo 'Connection error ' . mysqli_connect_error();
}
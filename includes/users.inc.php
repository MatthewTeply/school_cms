<?php
//users.inc.php slouži jako most mezi User classou a indexem (stránkou)
//Zde mají funkce prefix 'inc_', slouží k rozpoznání mezi funkci s .inc souboru a .class souboru

//Vzor : GET, SET

session_start();

include("../classes/users.class.php");

function inc_setUser($uid, $pwd, $em) { //Zahrnujeme registrační funkci

	$object = new User;
	$object->setUser($uid, $pwd, $em);
}

function inc_getUser($uid, $pwd) {

	$object = new User;
	$object->getUser($uid, $pwd);
}

function inc_un_getUser() {

	$object = new User;
	$object->un_getUser();
}

//PHP žádosti

//Login
if (isset($_POST['login_subm']))
	inc_getUser($_POST['uid'], $_POST['pwd']);

//Logout
if (isset($_GET['logout']))
	inc_un_getUser();

//Ajax žádosti
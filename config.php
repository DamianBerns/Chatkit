<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'chat');

mysqli_set_charset($conn, 'utf8');

function showChatBox($user_id, $path = null) {
	global $conn;
	if(is_null($path)){
		$chat = include 'chatBox.php';
	}else{
		$chat = include $path.'chatBox.php';
	}

	return $chat;
}

function auth() {
	global $conn;
	if (isset($_SESSION['name'])) {

		$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `name` = '" . $_SESSION['name'] . "'");

		$user = mysqli_fetch_object($sql);
		return $user;
	} else {
		return [];
	}
}

function activeChats() {
	return isset($_SESSION['chats']) ? $_SESSION['chats'] : [];
}

function addChat($id) {
	$chats = isset($_SESSION['chats']) ? $_SESSION['chats'] : [];

	if (!in_array($id, $chats)) {
		$chats[$id] = $id;
	}
	$_SESSION['chats'] = $chats;
}

function removeChat($id) {
	$chats = isset($_SESSION['chats']) ? $_SESSION['chats'] : [];

	if (!in_array($id, $chats)) {
		unset($chats[$id]);
	}
	$_SESSION['chats'] = $chats;
}

?>
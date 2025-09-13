<?php
require __DIR__.'/vendor/autoload.php';

$user = null;
try {
	$svc = \Johnm\Userservice\UserService::withDefaults('https://reqres.in/api/', 10, 'reqres-free-v1');
	$user = $svc->getUserById(2);
} catch (\Johnm\Userservice\Exception\ApiException $e) {
	header('Content-Type: text/html');
	echo "<p>Error!</p>";
	echo $e->getMessage();
	die;
}

if($user) {
	$users = $svc->listUsers();
	$createUserResult = $svc->createUser('Fred', 'Plumber');

	$output = [
		'create_user' => $createUserResult,
		'user_2' => $user,
		'all_users' => $users,
	];

	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
}

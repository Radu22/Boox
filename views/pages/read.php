<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	$users_arr = array();
	$users_arr['records'] = array();
	require_once("../../connection.php");
	require_once("../../models/users.php");

	$users = User::all();
	if(!empty($users)){
		foreach ($users as $user) {
			$current_user= array(
				"id" => $user->id,
				"first_name" => $user->firstname,
				"last_name" => $user->lastname,
				"email" => $user->email,
				"username"=> $user->username
			);
			array_push($users_arr['records'], $current_user);
		}
		echo json_encode($users_arr);
	}
	else{
		echo json_encode(array("message"=>"No users found"));
	}


?>
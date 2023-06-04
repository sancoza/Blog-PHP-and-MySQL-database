<?php

include(ROOT_PATH . '/app/database/db.php');

if (isset($_POST['register-btn'])) {
  $errors = array();

  if (empty($_POST['username'])) {
    array_push($errors, 'Username is required');
  }

  if (empty($_POST['email'])) {
    array_push($errors, 'Email is required');
  }
  if (empty($_POST['password'])) {
    array_push($errors, 'Password is required');
  }


  if ($_POST['passwordConf'] != $_POST['password']) {
    array_push($errors, 'Passwords do not match');
  }

  if (count($errors) === 0) {
    unset($_POST['register-btn'], $_POST['passwordConf']);
    $_POST['admin'] = 0;

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user_id = create('users', $_POST);
    $user = selectOne('users', ['id' => $user_id]);
    dd($user);
  }
}

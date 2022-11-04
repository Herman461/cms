<?php

header('Access-Control-Allow-Origin: *');

require_once '../../vendor/autoload.php';
require_once './Database.php';

use Firebase\JWT\JWT;

define('SECRET_KEY', 'form');

$data = [
    'username' => [
        'field' => 'username',
        'min_length' => 6,
        'max_length' => 256
    ],
    'password' => [
        'field' => 'password',
        'min_length' => 6,
        'max_length' => 64
    ],
    'email' => [
        'field' => 'email',
        'min_length' => 6,
        'max_length' => 256,
        'callbacks' => [
            'is_email' => function ($value) {
                return stripos($value, '@') ?: $_SESSION['errors']['email'] = 'The field email is not correct';
            }
        ]
    ]
];


function debug($value) {
    echo '<pre>' . print_r($value, 1) . '</pre>';
}

class Auth
{

    public function __construct($database, $data)
    {
        $this->database = $database;
        $this->data = $data;
    }

    public function authenticate($id)
    {
        $date = new DateTimeImmutable();

        $payload = [
            'iat' => $date->getTimestamp(),
            'iss' => $_SERVER['SERVER_NAME'],
            'exp' => $date->modify('+5 minutes')->getTimestamp(),
            'user_id' => $id
        ];

        return JWT::encode($payload, SECRET_KEY, 'HS256');
    }

    public function register()
    {
        $this->validate();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql_add = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

        $this->database->query($sql_add);

        $user_id = intval($this->database->insert_id);

        $jwt = $this->authenticate($user_id);
        echo $jwt;
    }

    public function verify()
    {
        $this->validate();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql_select = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->database->query($sql_select);

        $data = mysqli_fetch_assoc($result);

        $is_verified_password = password_verify($password, $data['password']);

        if (!$is_verified_password) {
            $_SESSION['errors']['password'] = 'Your password is incorrect';
            exit;
        }

        $id = intval($data['id']);

        $this->authenticate($id);
    }

    private function validate() {
        global $_SESSION;


        foreach ($_POST as $key => $value) {

            $field = $this->data[$key];
            $str_length = strlen($value);

            if (array_key_exists('min_length', $field) && $str_length < $field['min_length']) {
                $_SESSION['errors'][$key] = "The field " . $field['field'] . " should contains more than " . $field['min_length'] . " characters";
            }

            if (array_key_exists('max_length', $field) && $str_length > $field['max_length']) {
                $_SESSION['errors'][$key] = "The field " . $field['field'] . " should contains less than" . $field['max_length'] . "characters";
            }

            if (array_key_exists('callbacks', $field)) {
                foreach ($field['callbacks'] as $callback) {
                    call_user_func($callback, $value);
                }
            }

        }
//        if (array_key_exists('errors', $_SESSION)) exit;


    }
}


$auth = new Auth($conn, $data);

$auth->verify();
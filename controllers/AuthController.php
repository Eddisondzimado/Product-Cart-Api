<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/jwt.php';
use Firebase\JWT\JWT;

class AuthController {

    public function login($data) {
        global $con, $JWT_SECRET;

        $username = mysqli_real_escape_string($con, $data['username']);
        $password = $data['password'];

        $query = "SELECT * FROM admins WHERE username='$username' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid login"]);
            return;
        }

        $admin = mysqli_fetch_assoc($result);

        if (!password_verify($password, $admin['password'])) {
            http_response_code(401);
            echo json_encode(["error" => "Wrong password"]);
            return;
        }

        $payload = [
            "user" => $admin['username'],
            "exp" => time() + 86400
        ];

        $token = JWT::encode($payload, $JWT_SECRET, "HS256");

        echo json_encode([
            "token" => $token
        ]);
    }
}

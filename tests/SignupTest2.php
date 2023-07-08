<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../controllers/administration/signupController.php";
require __DIR__ . "/../controllers/dbs.php";

class SignupTest extends TestCase
{
    protected function setUp(): void
    {
        $existsEmail = "existsemail@example.com";
        $password = "password123";
        $picture = "example.jpg";
        $role = "user";

        $result = addQuery("INSERT INTO user VALUES(NULL, 'existing_user', '$existsEmail', '$password', '$picture','$role' NOW())");
      
    }
    public function testSignupPasswordMismatch()
    {
        $data = [
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password2' => 'differentpassword'
        ];
        
        $result = signup($data);

        $this->assertEquals('password', $result);
    }
    public function testSignupEmailAlreadyExists()
    {
        $existsEmail = "existsemail@example.com";
        $password = "password123";

        $data = [
            "username" => "new_user",
            "email" => $existsEmail,
            "password" => $password,
            "password2" => $password
        ];

        $result = signup($data);

        $this->assertEquals('email', $result);
    }
}
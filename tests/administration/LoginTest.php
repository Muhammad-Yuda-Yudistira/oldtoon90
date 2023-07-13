<?php
use PHPUnit\Framework\TestCase;


require 'vendor/autoload.php';
require __DIR__ . "/../../controllers/administration/loginController.php";
require __DIR__ . "/../../controllers/dbs.php";
require __DIR__ . "/../../config/config.php";

class LoginTest extends TestCase
{
    private $user = 
            [
                'username' => 'user123',
                'email' => 'existing_email@example.com',
                'password' => 'password123',
                'picture' => 'images/users/profile-none.jpg',
                'role' => 'user',
            ],
            $admin = 
            [
                'username' => 'admin123',
                'email' => 'admin_email@example.com',
                'password' => 'password123',
                'picture' => 'images/users/profile-none.jpg',
                'role' => 'admin',
            ];
    protected function setUp(): void
    {
        $username = $this->user['username'];
        $email = $this->user['email'];
        $password = $this->user['password'];
        $picture = $this->user['picture'];
        $role = $this->user['role'];

        $usernameAdmin = $this->admin['username'];
        $emailAdmin = $this->admin['email'];
        $passwordAdmin = $this->admin['password'];
        $pictureAdmin = $this->admin['picture'];
        $roleAdmin = $this->admin['role'];

        $password = hash('sha256', $password);
        $passwordAdmin = hash('sha256', $passwordAdmin);

        // masukan user ke database
        addQuery("INSERT INTO user VALUES(NULL, '$username', '$email', '$password', '$picture', '$role', NOW())");

        addQuery("INSERT INTO user VALUES(NULL, '$usernameAdmin', '$emailAdmin', '$passwordAdmin', '$pictureAdmin', '$roleAdmin', NOW())");
    }
    protected function tearDown(): void
    {
        $email = $this->user['email'];
        $emailAdmin = $this->admin['email'];

        deleteQuery("DELETE FROM user WHERE email='$email'");
        deleteQuery("DELETE FROM user WHERE email='$emailAdmin'");
    }
    public function testEmailHasNotBeenRegistered()
    {
        $email = $this->user['email'];
        $email = "new_email@example.com";

        $result = login($email, $this->user['password']);

        $this->assertFalse($result);
    }
    public function testPasswordMismatchedByUser()
    {
        $fakePassword = $this->user['password'];
        $fakePassword = 'salahPassword';

        $result = login($this->user['email'], $fakePassword);

        $this->assertFalse($result);
    }
    public function testLoginIsSuccessedByEmail()
    {
        $result = login($this->user['email'], $this->user['password']);

        $this->assertEquals('user', $result);
    }
    public function testLoginIsSuccessedByUsername()
    {
        $result = login($this->user['username'], $this->user['password']);

        $this->assertEquals('user', $result);
    }
    public function testAdminLogin()
    {

        $result = login($this->admin['email'], $this->admin['password']);

        $this->assertEquals('admin', $result);
    }
}
<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../controllers/administration/loginController.php";
require __DIR__ . "/../../controllers/dbs.php";

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

    // private $username = 'user', 
    //         $email = 'existing_email@example.com', 
    //         $password = 'pasword123',
    //         $picture = 'images/users/profile-none.jpg',
    //         $role = 'user';
    
    protected function setUp(): void
    {
        $username = $this->user['username'];
        // masukan user ke database
        addQuery("INSERT INTO user VALUES(NULL, '$username', '$this->email', '$this->password', '$this->picture', '$this->role', NOW())");
    }
    protected function tearDown(): void
    {
        deleteQuery("DELETE FROM user WHERE email='$this->email'");
    }
    public function testEmailHasNotBeenRegistered()
    {
        $email = $this->email;
        $email = "new_email@example.com";

        $result = login($email, $this->password);

        $this->assertFalse($result);
    }
    public function testLoginIsSuccessed()
    {
        $result = login($this->email, $this->password);

        $this->assertEquals('user', $result);
    }
    public function testAdminLogin()
    {

        $result = login($this->email, $this->password);
    }
}
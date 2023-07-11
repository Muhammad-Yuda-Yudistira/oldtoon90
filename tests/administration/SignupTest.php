<?php
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

require __DIR__ . "/../../controllers/dbs.php";
require __DIR__ . "/../../controllers/administration/signupController.php";

class SignupTest extends TestCase
{
    private $data = 
    [
        'username' => 'john_doe',
        'email' => 'john@example.com',
        'password' => 'password123',
        'password2' => 'password123'
    ];

    protected function setUp(): void
    {
        $existingEmail = 'existsemail@example.com';
        $existingUser = 'existing_user';
        
        // Menggunakan fungsi query atau metode lainnya untuk menambahkan email tersebut ke dalam database
        addQuery("INSERT INTO user VALUES(NULL, 'user', '$existingEmail', 'password123', 'images/users/profile-none.jpg', 'user', NOW())");
        addQuery("INSERT INTO user VALUES(NULL, '$existingUser', 'email@example.com', 'password123', 'images/users/profile-none.jpg', 'user', NOW())");
    }

    protected function tearDown(): void
    {
        $existingEmail = 'existsemail@example.com';
        $existingUser = 'existing_user';
        $successEmail = 'john@example.com';

        deleteQuery("DELETE FROM user WHERE email='$existingEmail'");
        deleteQuery("DELETE FROM user WHERE username='$existingUser'");
        deleteQuery("DELETE FROM user WHERE email='$successEmail'");
    }

    public function testPasswordMismatch()
    {
        $differentPassword = 'differentpassword';

        $data = $this->data;
        $data['password2'] = $differentPassword;

        $result = signup($data);

        $this->assertEquals('password', $result);
    }

    public function testEmailAlreadyExists()
    {
        // Menyiapkan kondisi awal
        // Menyimpan email yang sudah ada di database
        $existingEmail = 'existsemail@example.com';

        // Menyiapkan data untuk pengujian
        $data = $this->data;
        $data['email'] = $existingEmail;

        $result = signup($data);

        $this->assertEquals('email', $result);
    }

    public function testUsernameHasBeenUsed()
    {
        $existingUser = 'existing_user';

        $data = $this->data;
        $data['username'] = $existingUser;

        $result = signup($data);

        $this->assertEquals('username', $result);
    }

    public function testSignupIsSuccessed()
    {
        $result = signup($this->data);

        $this->assertEquals('success', $result);
    }
}

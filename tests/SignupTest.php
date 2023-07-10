<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../controllers/testing/dbs.php";
require __DIR__ . "/../controllers/administration/signupController.php";

class SignupTest extends TestCase
{
    protected function setUp(): void
    {
        $existingEmail = 'existsemail@example.com';
        
        // Menggunakan fungsi query atau metode lainnya untuk menambahkan email tersebut ke dalam database
        addQuery("INSERT INTO user VALUES(NULL, 'user', '$existingEmail', 'password123', 'images/users/profile-none.jpg', 'user', NOW())");
    }
    public function testPasswordMismatch()
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

    public function testEmailAlreadyExists()
    {
        // Menyiapkan kondisi awal
        // Menyimpan email yang sudah ada di database
        $existingEmail = 'existsemail@example.com';

        // Menyiapkan data untuk pengujian
        $data = [
            'username' => 'new_user',
            'email' => $existingEmail,
            'password' => 'password123',
            'password2' => 'password123'
        ];

        $result = signup($data);

        $this->assertEquals('email', $result);
    }
}

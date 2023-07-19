<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../controllers/film.php";
require __DIR__ . "/../../models/filmModel.php";

class DeleteFilmTest extends TestCase
{
    protected function setUp(): void
    {
        $data = 
        [
            'title' => "sample film",
            'episode' => 12,
            'film' => 'serial',
            'tipe' => 'cartoon',
            'aired' => 1990,
            'series' => 3,
            'franchise' => 'sample franchise',
            'authors' => 'sample authors',
            'artists' => 'sample artist 1, sample artist 2',
            'studios' => 'smaple studio',
            'channel' => ['tpi, indosiar'],
            'year' => 2001,
            'day' => ['senin, selasa, rabu, kamis'],
        ];

        $filename = 'sample-cover.jpg';
        
        addFilm($data, $filename);
    }
    public function testDeleteFilmSuccessed()
    {
        $title = 'sample film';

        $result = deleteFilm($title);

        $this->assertTrue($result);
    }
    public function testDeleteCoverSuccessed()
    {
        $title = 'sample film';
        $cover = 'images/covers/sample-cover.jpg';

        $result = deleteCover($title);

        $this->assertEquals($cover, $result);
    }
}
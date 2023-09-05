<?php require "../config/config.php"; ?>

<?php $nameMenu = 'Home'; ?>

<?php include "templates/header.php" ?>
<?php include "templates/nav.php" ?>

<div class="container">
    <!-- about section -->
    <ul class="about">
        <h3 class="title" style="font-size: 1.3rem; padding-bottom: 20px;">about</h3>
        <hr>
        <li>museum anime, cartoon, tokusatsu, film anak tahun 90an sampai 2000an / old cartoon.</li>
        <li>khususnya yang tayang di indonesia.</li>
    </ul>
    <!-- info upload -->
    <div class="info-upload">
        <h3 class="title" style="font-size: 1.3rem; padding-bottom: 20px;">info upload film terbaru</h3>
        <hr>
        <p>setiap hari upload episode baru!</p>
    </div>
    <!-- superiority section -->
    <dl class="superiority">
        <h3 class="title" style="font-size: 1.3rem; padding-bottom: 20px;">superiority</h3>
        <hr>
        <dt>Sulit mencari anime, kartun, tokusatsu zaman dulu?</dt>
        <dd>disinilah tempatnya!</dd>

        <dt>tidak hanya itu, fanart image dan komik pun ada!</dt>
        <dd>dibuat langsung oleh mangaka kami.</dd>

        <dt>Video HD</dt>
        <dd>Kami mementingkan kualitas video khusus pengguna desktop</dd>
    </dl>
    <dl class="goals">
        <h3 class="title" style="font-size: 1.3rem; padding-bottom: 20px;">goals</h3>
        <hr>
        <dt>visi</dt>
        <dd>menjadi wadah bagi para penikmat kartun zaman dulu untuk bernostalgia dan mencari informasi.</dd>
        <dt>misi</dt>
        <dd>memastikan komunitas menikmati layanan kami dengan bijaksana dan tidak berlebihan dalam menikmatinya.</dd>
    </dl>
</div>

<?php require_once "templates/footer.php" ?>
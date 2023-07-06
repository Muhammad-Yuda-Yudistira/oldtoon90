<?php 
session_start();

require "../../config/config.php";

if(isset($_COOKIE['email']))
{
    $email = $_COOKIE['email'];
}

$baseUrl = "http://localhost/2023/mei/kids90/";

$contacts = [
    [
        "name" => "whatsapp",
        "link" => 'https://wa.me/62895335059382',
    ],
    [
        "name" => "gmail",
        "link" =>  'https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=yudistira22112022@gmail.com',
    ],
    [
        "name" => "linkedin",
        "link" => 'https://www.linkedin.com/in/muhammad-yuda-24a071258/',
    ],
    [
        "name" => "showwcase",
        "link" => 'https://www.showwcase.com/yudistira22112022714',
    ],
    [
        "name" => "github",
        "link" => 'https://github.com/Muhammad-Yuda-Yudistira',
    ],
];
?>

<?php require "../templates/header.php" ?>
<?php require "../templates/nav.php" ?>
   
<div class="container">
    <!-- role yang dibutuhkan -->
    <dl class="space role-list">
        <h3 class="title">role yang dibutuhkan untuk pengembangan website!</h3>

        <dt>frontend / fullstack developer</dt>
        <dd>memperbaiki, membuat baru UI halaman dengan tampilan yang modern.</dd>

        <dt>administrator</dt>
        <dd>mengisi content melalui halaman admin. content saat ini: mengupload film, menambahkan film baru.</dd>

        <dt>marketing</dt>
        <dd>mempromosikan, sharing website di medsos, internet dan dunia nyata.</dd>

        <dt>analyst website</dt>
        <dd>meriset dan menentukan content yang harus diupload.</dd>

        <dt>seniman</dt>
        <dd>membuat konten fanart komik dan picture berkaitan dengan tujuan kami.</dd>

        <dt>system analyst</dt>
        <dd>membuat desain UI (tampilan website) dan memikirkan penambahan fitur berdasarkan sistem.</dd>
    </dl>
    <!-- contact saya -->
    <ul class="space contact-list">
        <div class="title">
            <h3>contacts:</h3>
        </div>
        <?php foreach($contacts as $contact): ?>
            <li>
                <figure>
                    <a href="<?= $contact['link'] ?>" target="_blank">
                        <img src="<?= $baseUrl ?>images/contact/<?= $contact['name'] ?>.svg" alt="<?= $contact['name'] ?>">
                    </a>
                    <a href="<?= $contact['link'] ?>" target="_blank">
                        <figcaption><?= $contact['name'] ?></figcaption>
                    </a>
                </figure>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- hire me -->
    <div class="space hire">
        <h4 class="title">hire me?</h4>
        <h4>hello i am programmer as fullstack developer.</h4>
        <figure>
            <a href="https://www.freelancer.co.id/u/yudistira00" target="_blank">
                <img src="<?= $baseUrl ?>images/contact/freelancer.svg" alt="freelancer">
            </a>
            <a href="https://www.freelancer.co.id/u/yudistira00" target="_blank">
                <figcaption>freelancer</figcaption>
            </a>
        </figure>
    </div>
</div>

<?php require "../templates/footer.php" ?>
<?php 
session_start();

if(isset($_COOKIE['email']))
{
    $email = $_COOKIE['email'];
}
?>

<?php
require_once "dbs.php";

if(isset($_POST['submit']))
{
    $orderId = rand();
    $statusOrder = 1;
    $email = $_POST['email'];
    $name = $_POST['name'];
    $nominal = $_POST['nominal'];

    $query = "INSERT INTO donation VALUES('',$orderId,'$email',$nominal,'$name', $statusOrder,CURRENT_TIMESTAMP())";
    $result = addQuery($query);

    if($result < 0)
    {
        echo "Donasi gagal masuk ke database!";
        exit();
    }

    if($statusOrder == 3)
    {
        $statusOrderText = "Telah dibayar!";
    }
    else if($statusOrder == 2)
    {
        $statusOrderText = "Pending!";
    }
    else if($statusOrder == 1)
    {
        $statusOrderText = "Belum dibayar!";
    }

    $base = "http://localhost/2023/mei/kids90/controllers/";
}
?>



<?php require "../ui/templates/header.php" ?>
<?php require "../ui/templates/nav.php" ?>
   
<div class="container-login">

    <div class="login">
        <h2>Preview</h2><span></span>
        <ul>
            <li>Order_id: <?= $orderId ?></li>
            <li>Email: <?= $email ?></li>
            <li>Atas Nama: <?= $name ?></li>
            <li>Nominal: <?= $nominal ?></li>
            <li>Nominal: <?= $statusOrderText ?></li>
        </ul>

        <form action="<?= $base ?>checkout-process.php?order_id=<?= $orderId ?>" method="POST">
            <input type="hidden" name="amount" value="<?= $nominal ?>">
            <input type="submit" value="Confirm">
        </form>
    </div>
</div>

<?php require "../ui/templates/footer.php" ?>
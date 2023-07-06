<?php
namespace Midtrans;

require_once dirname(__FILE__) . "/../payment/Midtrans.php";
require_once __DIR__ . "/dbs.php";

$orderId = $_GET['order_id'];
$donatur = query("SELECT * FROM donation WHERE order_id=$orderId");

$email = $donatur[0]['email'];
$name = $donatur[0]['name'];
$nominal = $donatur[0]['nominal'];

Config::$serverKey = 'SB-Mid-server-c7_EscbBMVroRhJeGTStknXi';
Config::$clientKey = 'SB-Mid-client-Ud8oPk2GSgy5dMlp';

// non-relevant function only used for demo/example purpose
// printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $orderId,
    'gross_amount' => $nominal, // no decimal allowed for creditcard
);
// Optional
$item_details = array (
    array(
        'id' => 'a1',
        'price' => $nominal,
        'quantity' => 1,
        'name' => "Donation"
    ),
  );
// Optional
$customer_details = array(
    'first_name'    => $name,
    'last_name'     => "",
    'email'         => $email,
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}

?>

<!DOCTYPE html>
<html>
    <body>
        <button id="pay-button">Bayar!</button>
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>');
            };
        </script>
    </body>
</html>

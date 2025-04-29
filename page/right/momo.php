<?php
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOYOURCODE';
$accessKey = 'YOUR_ACCESS_KEY';
$secretKey = 'YOUR_SECRET_KEY';

$orderInfo = "Thanh toán đơn hàng tại THDH Store";
$amount = "10000"; // số tiền thanh toán
$orderId = time() . "";
$redirectUrl = "https://yourwebsite.com/momo_success.php";
$ipnUrl = "https://yourwebsite.com/momo_ipn.php";
$extraData = "";

// Tạo chữ ký
$rawHash = "accessKey=".$accessKey."&amount=".$amount."&extraData=".$extraData."&ipnUrl=".$ipnUrl."&orderId=".$orderId."&orderInfo=".$orderInfo."&partnerCode=".$partnerCode."&redirectUrl=".$redirectUrl."&requestId=".$orderId."&requestType=captureWallet";
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'accessKey' => $accessKey,
    'requestId' => $orderId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'extraData' => $extraData,
    'requestType' => "captureWallet",
    'signature' => $signature,
    'lang' => 'vi'
);

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$result = curl_exec($ch);
curl_close($ch);

$jsonResult = json_decode($result, true);

// Điều hướng người dùng đến trang thanh toán MoMo
header('Location: ' . $jsonResult['payUrl']);
exit();
?>

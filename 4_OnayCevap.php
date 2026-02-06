<?php
// Ödemenin alındığı sayfa, 3_OdemeOnay sayfasında kart doğrulama başarılı ve MD değeri alınmışsa 

$MerchantOrderId = $_POST["MerchantOrderId"];
$Amount = $_POST["Amount"]; //Islem Tutari
$MD = $_POST["MD"]; //Islem Tutari
$CustomerId = "99502648";// Bankadaki müsteri numarası
$MerchantId = "714116"; //Sanal pos mağaza numarası, başvuru onayıyla işyerine gönderilir. 
$UserName = "n8napi"; // https://kurumsal.kuveytturk.com.tr adresinde Kullanıcı İşlemleri - Kullanıcı Ekle alanında işyeri tarafından olusturulan api rolünde kullanici adı
$Password = "357896";// api rolünde kullanici adının sifresi
$HashedPassword = base64_encode(sha1($Password, "ISO-8859-9")); //md5($Password);
$HashData = base64_encode(sha1($MerchantId . $MerchantOrderId . $Amount . $UserName . $HashedPassword, "ISO-8859-9"));

$xml = '<KuveytTurkVPosMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<APIVersion>1.0.0</APIVersion>
<HashData>' . $HashData . '</HashData>
<MerchantId>' . $MerchantId . '</MerchantId>
<CustomerId>' . $CustomerId . '</CustomerId>
<UserName>' . $UserName . '</UserName>
<TransactionType>Sale</TransactionType>
<InstallmentCount>0</InstallmentCount>
<CurrencyCode>0949</CurrencyCode>
<Amount>' . $Amount . '</Amount>
<MerchantOrderId>' . $MerchantOrderId . '</MerchantOrderId>
<TransactionSecurity>3</TransactionSecurity>
<KuveytTurkVPosAdditionalData>
<AdditionalData>
    <Key>MD</Key>
    <Data>' . $MD . '</Data>
</AdditionalData>
</KuveytTurkVPosAdditionalData>
</KuveytTurkVPosMessage>';

$data = "";
try {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml', 'Content-length: ' . strlen($xml)));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_URL, 'https://sanalpos.kuveytturk.com.tr/ServiceGateWay/Home/ThreeDModelProvisionGate');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
} catch (Exception $e) {
	// Handle error quietly or capture
}

$xxml = simplexml_load_string($data);
$isSuccess = ($xxml && $xxml->ResponseCode == "00");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sonuç - HCA Ambalaj</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<div class="container nav-wrapper">
			<a href="index.php" class="logo">HCA Ambalaj</a>
		</div>
	</header>
	<main class="payment-section">
		<div class="card" style="text-align: center; border-color: <?php echo $isSuccess ? '#22c55e' : '#ef4444'; ?>;">
			<div class="card-header">
				<?php if ($isSuccess): ?>
					<div style="font-size: 3rem; color: #22c55e; margin-bottom: 1rem;">&#10004;</div>
					<h2 style="color: #22c55e;">Ödeme Başarılı</h2>
					<p>İşleminiz başarıyla gerçekleştirildi.</p>
				<?php else: ?>
					<div style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;">&#10006;</div>
					<h2 style="color: #ef4444;">Ödeme Başarısız</h2>
					<p>İşleminiz gerçekleştirilemedi.</p>
				<?php endif; ?>
			</div>

			<?php if ($xxml): ?>
				<div
					style="background: #f8fafc; padding: 1rem; border-radius: 0.5rem; text-align: left; margin-bottom: 1.5rem;">
					<div class="form-group">
						<label class="form-label">Sipariş No</label>
						<div class="form-control" style="background: transparent; border: none; padding: 0;">
							<?php echo $xxml->MerchantOrderId; ?></div>
					</div>
					<div class="form-group">
						<label class="form-label">Mesaj</label>
						<div class="form-control" style="background: transparent; border: none; padding: 0;">
							<?php echo $xxml->ResponseMessage; ?></div>
					</div>
					<div class="form-group">
						<label class="form-label">Referans No</label>
						<div class="form-control" style="background: transparent; border: none; padding: 0;">
							<?php echo $xxml->ProvisionNumber; ?></div>
					</div>
				</div>
			<?php else: ?>
				<p>Sunucudan yanıt alınamadı.</p>
			<?php endif; ?>

			<a href="index.php" class="btn-primary" style="display: inline-block;">Ana Sayfaya Dön</a>
		</div>
	</main>
</body>

</html>
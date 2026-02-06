<?php
$AuthenticationResponse = $_POST["AuthenticationResponse"];
$RequestContent = urldecode($AuthenticationResponse);

$xxml = simplexml_load_string($RequestContent) or die("Error: Cannot create object");
// print_r($xxml); // Hidden for production/clean view
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Onayı - HCA Ambalaj</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container nav-wrapper">
            <a href="index.php" class="logo">HCA Ambalaj</a>
        </div>
    </header>

    <main class="payment-section">
        <div class="card">
            <div class="card-header">
                <h2>Ödeme Onayı</h2>
                <p>Lütfen işlem detaylarını kontrol edip onaylayınız.</p>
            </div>

            <form action='http://localhost/KuveytTurk_Ornek_PHP/4_OnayCevap.php' method='post'>

                <div class="form-group">
                    <label class="form-label">Hata Kodu</label>
                    <input name="ResponseCode" type="text" class="form-control"
                        value="<?php echo $xxml->ResponseCode ?>" readonly />
                </div>

                <div class="form-group">
                    <label class="form-label">Açıklama</label>
                    <input name="ResponseMessage" type="text" class="form-control"
                        value="<?php echo $xxml->ResponseMessage ?>" readonly />
                </div>

                <!-- Hidden or less important fields can be grouped or hidden if not needed for user review, but kept for submission -->
                <!-- Showing all as per original example but styled -->

                <div class="row">
                    <div class="col">
                        <label class="form-label">Üye Sipariş No</label>
                        <input name="MerchantOrderId" type="text" class="form-control"
                            value="<?php echo $xxml->VPosMessage->MerchantOrderId ?>" readonly />
                    </div>
                    <div class="col">
                        <label class="form-label">SanalPos Sipariş No</label>
                        <input name="OrderId" type="text" class="form-control"
                            value="<?php echo $xxml->VPosMessage->OrderId ?>" readonly />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">İşlem Tutarı</label>
                    <input name="Amount" type="text" class="form-control"
                        value="<?php echo $xxml->VPosMessage->Amount ?>" readonly />
                </div>

                <!-- Hidden fields for data transmission -->
                <input type="hidden" name="ProvisionNumber" value="<?php echo $xxml->VPosMessage->ProvisionNumber ?>" />
                <input type="hidden" name="RRN" value="<?php echo $xxml->VPosMessage->RRN ?>" />
                <input type="hidden" name="Stan" value="<?php echo $xxml->VPosMessage->Stan ?>" />
                <input type="hidden" name="MD" value="<?php echo $xxml->MD ?>" />
                <input type="hidden" name="HashData" value="<?php echo $xxml->VPosMessage->HashData ?>" />

                <button type="submit" id="submit" class="btn-primary" style="width: 100%; margin-top: 1.5rem;">İşlemi
                    Tamamla</button>
            </form>
        </div>
    </main>
</body>

</html>
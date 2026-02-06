<?php
$AuthenticationResponse = $_POST["AuthenticationResponse"];
$RequestContent = urldecode($AuthenticationResponse);

$xxml = simplexml_load_string($RequestContent) or die("Error: Cannot create object");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlem Hatası - HCA Ambalaj</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container nav-wrapper">
            <a href="index.php" class="logo">HCA Ambalaj</a>
        </div>
    </header>

    <main class="payment-section">
        <div class="card" style="border-color: #ef4444;">
            <div class="card-header">
                <h2 style="color: #ef4444;">İşlem Başarısız</h2>
                <p>Ödeme işlemi sırasında bir hata oluştu.</p>
            </div>

            <form>
                <div class="form-group">
                    <label class="form-label">Hata Kodu</label>
                    <input name="ResponseCode" type="text" class="form-control"
                        value="<?php echo $xxml->ResponseCode ?>" readonly />
                </div>

                <div class="form-group">
                    <label class="form-label">Hata Mesajı</label>
                    <input name="ResponseMessage" type="text" class="form-control"
                        value="<?php echo $xxml->ResponseMessage ?>" readonly />
                </div>

                <div class="form-group">
                    <label class="form-label">Sipariş No</label>
                    <input name="MerchantOrderId" type="text" class="form-control"
                        value="<?php echo $xxml->VPosMessage->MerchantOrderId ?>" readonly />
                </div>
            </form>

            <a href="payment.php" class="btn-primary"
                style="display: block; text-align: center; margin-top: 1.5rem; background: #ef4444;">Tekrar Dene</a>
        </div>
    </main>
</body>

</html>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme - HCA Ambalaj</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container nav-wrapper">
            <a href="index.php" class="logo">HCA Ambalaj</a>
            <nav>
                <a href="index.php" class="nav-link">Ana Sayfa</a>
            </nav>
        </div>
    </header>

    <main class="payment-section">
        <div class="card">
            <div class="card-header">
                <h2>Ödeme Yap</h2>
                <div class="card-logos">
                    <!-- SVG Placeholders for Card Logos -->
                    <svg height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M45 0H3C1.3 0 0 1.3 0 3V27C0 28.7 1.3 30 3 30H45C46.7 30 48 28.7 48 27V3C48 1.3 46.7 0 45 0Z"
                            fill="#F4F4F4" />
                        <path
                            d="M19.1 19.6C17.6 20.4 16 20.8 14.3 20.8C9.6 20.8 6.3 17.2 6.3 12.4C6.3 7.6 9.6 4.1 14.3 4.1C16 4.1 17.6 4.5 19.1 5.3L17.7 8.2C16.8 7.6 15.6 7.2 14.4 7.2C11.5 7.2 9.5 9.3 9.5 12.4C9.5 15.6 11.5 17.6 14.4 17.6C15.6 17.6 16.8 17.3 17.7 16.7L19.1 19.6ZM28.5 20.5H25.3L22.8 13.7L20.3 20.5H17.1L21.3 10.1L21.2 10L17.6 4.3H21L23.1 8.5L25.3 4.3H28.6L22.7 13.9L28.5 20.5ZM35.3 20.5H32.1V4.3H35.3V20.5ZM42.5 7.3H38.7V10.8H42.1V13.6H38.7V17.5H42.5V20.5H35.5V4.3H42.5V7.3Z"
                            fill="#1A1F71" />
                    </svg>
                    <svg height="30" viewBox="0 0 40 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M37.5 0H2.5C1.1 0 0 1.1 0 2.5V27.5C0 28.9 1.1 30 2.5 30H37.5C38.9 30 40 28.9 40 27.5V2.5C40 1.1 38.9 0 37.5 0Z"
                            fill="#2566AF" />
                        <path
                            d="M12.5 15.7C12.5 18.2 14.1 20.4 16.4 21.2C14.7 23.9 11.8 25.7 8.5 25.7C3.8 25.7 0 21.9 0 17.2C0 12.5 3.8 8.7 8.5 8.7C11.8 8.7 14.7 10.5 16.4 13.2C14.1 14 12.5 16.2 12.5 15.7Z"
                            fill="#E60019" />
                        <path
                            d="M20.6 15.7C20.6 18.2 22.2 20.4 24.5 21.2C22.8 23.9 19.9 25.7 16.6 25.7C16.2 25.7 15.8 25.7 15.4 25.6C16.9 24 17.8 21.9 17.8 19.6V11.8C17.8 9.5 16.9 7.4 15.4 5.8C15.8 5.7 16.2 5.7 16.6 5.7C19.9 5.7 22.8 7.5 24.5 10.2C22.2 11 20.6 13.2 20.6 15.7Z"
                            fill="#FF5F00" />
                        <path
                            d="M31.5 8.7C29.2 8.7 27.1 9.6 25.6 11.1C26.7 12.3 27.3 13.9 27.3 15.7C27.3 17.5 26.7 19.1 25.6 20.3C27.1 21.8 29.2 22.7 31.5 22.7C36.2 22.7 40 18.9 40 14.2C40 12.5 36.2 8.7 31.5 8.7Z"
                            fill="#F79E1B" />
                    </svg>
                </div>
            </div>

            <form action="2_Odeme.php" method="POST">
                <div class="form-group">
                    <label class="form-label" for="cardHolder">Kart Sahibi</label>
                    <input type="text" id="cardHolder" name="CardHolderName" class="form-control" placeholder="Ad Soyad"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="cardNumber">Kart Numarası</label>
                    <input type="text" id="cardNumber" name="CardNumber" class="form-control"
                        placeholder="0000 0000 0000 0000" maxlength="19" required>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Son Kullanma (Ay)</label>
                        <select name="CardExpireDateMonth" class="form-control" required>
                            <option value="">Ay</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $val = sprintf("%02d", $i);
                                echo "<option value='$val'>$val</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Son Kullanma (Yıl)</label>
                        <select name="CardExpireDateYear" class="form-control" required>
                            <option value="">Yıl</option>
                            <?php
                            $year = date("y");
                            for ($i = 0; $i < 15; $i++) {
                                $val = $year + $i;
                                echo "<option value='$val'>20$val</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row" style="margin-top: 1.5rem;">
                    <div class="col">
                        <label class="form-label" for="cvv">CVV</label>
                        <input type="text" id="cvv" name="CardCVV2" class="form-control" placeholder="000" maxlength="4"
                            required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="amount">Tutar (TL)</label>
                        <!-- Default value or empty -->
                        <input type="text" id="amount" name="Tutar" class="form-control" placeholder="100" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 2rem;">Ödemeyi
                    Tamamla</button>

                <div class="secure-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>256-bit SSL ile güvenli ödeme</span>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
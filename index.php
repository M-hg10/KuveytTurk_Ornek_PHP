<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCA Ambalaj</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container nav-wrapper">
            <a href="index.php" class="logo">HCA Ambalaj</a>
            <nav>
                <!-- <a href="#" class="nav-link">Ürünler</a>
                <a href="#" class="nav-link">Hakkımızda</a> -->
                <a href="payment.php" class="btn-primary">Ödeme Yap</a>
            </nav>
        </div>
    </header>

    <main class="hero">
        <div class="hero-content">
            <h1>Kaliteli Ambalaj Çözümleri</h1>
            <p>HCA Ambalaj olarak, işiniz için en iyi ve en güvenilir ambalaj ürünlerini sunuyoruz. Özel baskılı
                ürünlerimizle markanızı öne çıkarın.</p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="payment.php" class="btn-primary">Hemen Ödeme Yap</a>
            </div>
        </div>
    </main>

    <footer style="text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.875rem;">
        &copy; <?php echo date("Y"); ?> HCA Ambalaj. Tüm hakları saklıdır.
    </footer>
</body>

</html>
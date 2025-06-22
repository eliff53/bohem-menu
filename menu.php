
<?php include 'baglanti.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohem Çikolata Menü</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Great+Vibes&family=Allura&family=Pacifico&display=swap');

        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cormorant Garamond', serif;
            background: linear-gradient(135deg, #3d2f1f 0%, #4a1e1e 50%, #2a1810 100%);
            min-height: 100vh;
            color: #f4e6d1;
            position: relative;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            
        }
        
        /* Header bölümü */
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 50px 50px;
            background: rgba(74, 30, 30, 0.4);
            border-radius: 15px;
            border: 1px solid rgba(244, 230, 209, 0.2);
            backdrop-filter: blur(10px);
            
         }
        
       .title {
            font-family: 'Great Vibes', cursive; /* Çok kıvrımlı ve zarif */
            font-size: 4.5rem;
            color: #d4af37; /* Altın rengi */
            margin-bottom: 20px;
            letter-spacing: 3px;
            text-shadow: 
            2px 2px 4px rgba(0,0,0,0.7),
            0 0 20px rgba(212, 175, 55, 0.5),
            0 0 40px rgba(212, 175, 55, 0.3);
            transform: rotate(-2deg); /* Hafif eğim */
             transition: all 0.3s ease;
             position: relative;
             z-index: 1;
        }

        .title:hover {
            transform: rotate(0deg) scale(1.05);
            text-shadow: 
            3px 3px 6px rgba(0,0,0,0.8),
            0 0 30px rgba(212, 175, 55, 0.7),
            0 0 60px rgba(212, 175, 55, 0.5);
        }
        
        .subtitle {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #c8a882;
            font-weight: 400;
            font-style: italic;
            margin-top: 15px;
        }
        
        /* Navigasyon */
        .navigation {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 40px;
            overflow-x: auto;
            padding: 0 10px;
        }
        
        .nav-item {
            background: rgba(90, 51, 51, 0.8);
            color: #f4e6d1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(244, 230, 209, 0.3);
            backdrop-filter: blur(10px);
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .nav-item:hover {
            background: rgba(107, 66, 38, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .nav-item.active {
            background: #4a1e1e;
            color: #c8a882;
            box-shadow: 0 3px 10px rgba(0,0,0,0.4);
        }
        
        /* Menü grid */
        .menu-grid {
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-top: 50px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 40px;
            transition: all 0.3s ease;
            padding: 25px;
            background: rgba(74, 30, 30, 0.15);
            border-radius: 20px;
            border: 1px solid rgba(244, 230, 209, 0.1);
            width: 100%;
            animation: fadeInUp 0.6s ease forwards;
        }
        
        /* Tek sıradaki ürünler: resim sol, açıklama sağ */
        .menu-item:nth-child(odd) {
            flex-direction: row;
        }
        
        /* Çift sıradaki ürünler: resim sağ, açıklama sol */
        .menu-item:nth-child(even) {
            flex-direction: row-reverse;
        }
        
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            background: rgba(74, 30, 30, 0.25);
            border-color: rgba(244, 230, 209, 0.3);
        }
        
        .item-image {
            width: 320px;
            height: 220px;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover .item-image {
            box-shadow: 0 15px 45px rgba(0,0,0,0.5);
        }
        
        .menu-item:hover .item-image img {
            transform: scale(1.08);
        }
        
        .item-content {
            flex: 1;
            padding: 10px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 160px;
            text-align: left;
        }
        
        .item-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #c8a882;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .item-description {
            font-size: 1.1rem;
            color: #b8956f;
            line-height: 1.7;
            margin-bottom: 20px;
            font-style: italic;
        }
        
        .item-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #8b4a4a;
            margin-top: auto;
        }
        
        .price-symbol {
            font-size: 1.3rem;
            opacity: 0.8;
        }
        
        /* Hakkımızda Bölümü */
        .about-section {
            background: rgba(244, 230, 209, 0.05);
            padding: 40px 20px;
            margin-top: 60px;
            border-top: 1px solid rgba(244, 230, 209, 0.1);
            color: #d4c5a9;
            text-align: center;
        }
        
        .about-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #c8a882;
        }
        
        .about-section h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #c8a882;
        }
        
        .about-section p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .contact-info {
            margin-top: 20px;
        }
        
        .social-link {
            color: #f4e6d1;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
        }
        
        .social-link img {
            width: 20px;
            height: 20px;
            filter: brightness(0.9);
        }
        
        .admin-link {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 10px;
        }
        
        .admin-link a {
            color: #f4e6d1;
            text-decoration: none;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .admin-link a:hover {
            opacity: 1;
        }
        
        /* Responsive tasarım */
        @media (max-width: 1024px) {
            .menu-item {
                gap: 30px;
                padding: 20px;
            }
            
            .item-image {
                width: 280px;
                height: 200px;
            }
        }
        
        @media (max-width: 768px) {
            .title {
                font-size: 2.8rem;
                letter-spacing: 1px;
            }
            
            .subtitle {
                font-size: 1.2rem;
            }
            
            .nav-item {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
            
            .menu-grid {
                gap: 25px;
            }
            
            .menu-item {
                flex-direction: column !important;
                text-align: center !important;
                gap: 20px;
                padding: 20px;
            }
            
            .menu-item .item-content {
                text-align: center !important;
            }
            
            .item-image {
                width: 100%;
                max-width: 400px;
                height: 220px;
            }
            
            .item-content {
                padding: 15px 0;
            }
            
            .item-title {
                font-size: 1.5rem;
            }
            
            .item-description {
                font-size: 1rem;
            }
            
            .item-price {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .menu-item {
                padding: 15px;
                gap: 15px;
            }
            
            .item-image {
                height: 180px;
            }
            
            .item-content {
                padding: 10px 0;
            }
            
            .item-title {
                font-size: 1.3rem;
            }
            
            .item-description {
                font-size: 0.9rem;
            }
            
            .item-price {
                font-size: 1.3rem;
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .menu-item:nth-child(2) { animation-delay: 0.1s; }
        .menu-item:nth-child(3) { animation-delay: 0.2s; }
        .menu-item:nth-child(4) { animation-delay: 0.3s; }
        .menu-item:nth-child(5) { animation-delay: 0.4s; }
        .menu-item:nth-child(6) { animation-delay: 0.5s; }
        .menu-item:nth-child(7) { animation-delay: 0.6s; }
        .menu-item:nth-child(8) { animation-delay: 0.7s; }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="title">Bohem Çikolata</h1>
            
            
            <nav class="navigation">
                <button class="nav-item active" onclick="filtreleKategori('all')">Tümü</button>
                <?php
                $kategoriler = $conn->query("SELECT * FROM kategoriler");
                while ($kategori = $kategoriler->fetch_assoc()) {
                    echo '<button class="nav-item" onclick="filtreleKategori(' . $kategori['id'] . ')">' . htmlspecialchars($kategori['kategori_adi']) . '</button>';
                }
                ?>
            </nav>
        </header>
        
        <div class="menu-grid">
            <?php
            $urunler = $conn->query("SELECT * FROM urunler");
            while ($urun = $urunler->fetch_assoc()) {
                echo '
                <div class="menu-item" data-kategori="' . $urun['kategori_id'] . '">
                    <div class="item-image">
                        <img src="resimler/' . htmlspecialchars($urun['resim']) . '" alt="' . htmlspecialchars($urun['urun_adi']) . '">
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">' . htmlspecialchars($urun['urun_adi']) . '</h3>
                        <p class="item-description">' . htmlspecialchars($urun['aciklama']) . '</p>
                        <div class="item-price">' . number_format($urun['fiyat'], 0) . ' <span class="price-symbol">₺</span></div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    
    <section class="about-section">
        <div class="container" style="max-width: 900px; margin: 0 auto;">
            <h2>Hakkımızda</h2>
            <p style="margin-bottom: 30px;">
                Bohem Çikolata, geleneksel tarifler ve el yapımı lezzetleriyle size unutulmaz tatlar sunmak için kurulmuş bir atölyedir. Her ürünümüzü özenle hazırlar, kaliteli malzemeler kullanarak en lezzetli deneyimi yaşatmayı hedefleriz.
            </p>
            
            <h3>Bize Ulaşın</h3>
            <div class="contact-info">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2995.4950146255023!2d36.25733247553152!3d41.34159309883529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4088794b49dcdebb%3A0x694408739d0e9995!2sBOHEM%20%C3%87ikolata%20%26%20Waffle!5e0!3m2!1str!2str!4v1749634528215!5m2!1str!2str" 
                    width="200" 
                    height="200" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <p>📞 +90 505 346 52 54</p>
                <p>✉️ <a href="mailto:samsunchocoworld.pr@gmail.com" style="color: inherit; text-decoration: none;">
      samsunchocoworld.pr@gmail.com
          </a></p>


                
                <a href="https://www.instagram.com/bohemcikolatawaffle" target="_blank" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram">
                    @bohemcikolatawaffle
                </a>
            </div>
            
            <div class="admin-link">
                <a href="login/login.php">Admin Paneli</a>
            </div>
        </div>
    </section>
    
    <script>
        
function filtreleKategori(kategoriId) {
    // Tüm navigasyon butonlarından active sınıfını kaldır
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => item.classList.remove('active'));
    
    // Tıklanan butona active sınıfını ekle
    event.target.classList.add('active');
    
    // Ürünleri filtrele
    const urunler = document.querySelectorAll('.menu-item');
    urunler.forEach(urun => {
        if (kategoriId === 'all') {
            urun.style.display = 'flex';
            urun.style.opacity = '1';
            urun.style.visibility = 'visible';
        } else if (urun.dataset.kategori == kategoriId) {
            urun.style.display = 'flex';
            urun.style.opacity = '1';
            urun.style.visibility = 'visible';
        } else {
            urun.style.display = 'none';
            urun.style.opacity = '0';
            urun.style.visibility = 'hidden';
        }
    });
}
       
        // Hover effect for menu items
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>

    <script>
    const aramaInput = document.querySelector('input[name="arama"]');
    const urunTablo = document.querySelector('tbody');

    aramaInput.addEventListener('input', () => {
        const kelime = aramaInput.value;

        fetch(`urun_ara.php?arama=${encodeURIComponent(kelime)}`)
            .then(res => res.text())
            .then(data => {
                urunTablo.innerHTML = data;
            })
            .catch(err => {
                console.error("Arama hatası:", err);
            });
    });
</script>

</body>
</html>
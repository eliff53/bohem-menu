# Bohem Menu - PHP Restoran Menü Uygulaması

Bu proje, Bohem adlı bir restoran/kafeterya için geliştirilmiş PHP tabanlı menü yönetim sistemidir.

## 🍽️ Özellikler

- **Menü Görüntüleme**: Müşteriler için görsel menü arayüzü
- **Admin Paneli**: Ürün ekleme, düzenleme, silme işlemleri
- **Kullanıcı Yönetimi**: Admin giriş sistemi
- **Resim Yönetimi**: Ürün fotoğrafları için görsel yönetim
- **Responsive Tasarım**: Mobil uyumlu arayüz

## 🚀 Kurulum

### Gereksinimler
- PHP 7.4 veya üzeri
- MySQL/MariaDB veritabanı
- Web sunucusu (Apache/Nginx)

### Adımlar

1. **Projeyi klonlayın:**
```bash
git clone https://github.com/kullaniciadi/bohem-menu.git
cd bohem-menu
```

2. **Veritabanı bağlantısını yapılandırın:**
   - `baglanti.php` dosyasını düzenleyin
   - Veritabanı bilgilerinizi girin

3. **Web sunucusunda çalıştırın:**
   - Dosyaları web sunucunuzun kök dizinine kopyalayın
   - Tarayıcınızda `http://localhost/bohem-menu` adresine gidin

## 📁 Proje Yapısı

```
bohem-menu/
├── admin/              # Admin panel dosyaları
├── login/              # Giriş sistemi
├── resimler/           # Ürün fotoğrafları
├── baglanti.php        # Veritabanı bağlantısı
├── index.php           # Ana sayfa
├── menu.php            # Menü sayfası
├── stil.css            # CSS stilleri
└── README.md           # Bu dosya
```

## 🔧 Yapılandırma

### Veritabanı Ayarları
`baglanti.php` dosyasında aşağıdaki bilgileri güncelleyin:

```php
$servername = "localhost";
$username = "veritabani_kullanici";
$password = "veritabani_sifre";
$dbname = "bohem_menu";
```

## 👨‍💻 Admin Paneli

Admin paneline erişmek için:
- URL: `http://localhost/bohem-menu/admin/`
- Varsayılan kullanıcı adı ve şifre: (veritabanında tanımlanmalı)

## 📸 Ekran Görüntüleri

[Buraya uygulamanızın ekran görüntülerini ekleyebilirsiniz]

## 🤝 Katkıda Bulunma

1. Bu repository'yi fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/yeni-ozellik`)
3. Değişikliklerinizi commit edin (`git commit -am 'Yeni özellik eklendi'`)
4. Branch'inizi push edin (`git push origin feature/yeni-ozellik`)
5. Pull Request oluşturun

## 📄 Lisans

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır.

## 📞 İletişim

- **Geliştirici**: [Adınız]
- **E-posta**: [E-posta adresiniz]
- **GitHub**: [GitHub profiliniz]

## 🙏 Teşekkürler

Bu projeyi geliştirirken kullanılan tüm açık kaynak kütüphanelere teşekkürler. 
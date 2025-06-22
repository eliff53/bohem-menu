# 🚀 Bohem Menu - Deployment Rehberi

## Netlify Sınırlaması
Netlify PHP sunucu tarafı kodunu çalıştıramaz. Bu yüzden aşağıdaki alternatifleri kullanın:

## 🌐 Önerilen Hosting Seçenekleri

### 1. InfinityFree (Ücretsiz - Önerilen)
**Adres:** https://infinityfree.net

#### Kurulum Adımları:
1. **Hesap oluşturun** - Ücretsiz kayıt
2. **Subdomain seçin** - Örn: `bohem-menu.infinityfreeapp.com`
3. **FTP bilgilerini alın**
4. **Dosyaları yükleyin:**
   ```bash
   # FileZilla veya başka FTP istemcisi kullanın
   Host: ftpupload.net
   Username: [verilen kullanıcı adı]
   Password: [verilen şifre]
   Port: 21
   ```

#### Veritabanı Kurulumu:
1. **phpMyAdmin'e giriş yapın**
2. **Yeni veritabanı oluşturun**
3. **baglanti.php dosyasını güncelleyin:**
   ```php
   $servername = "sql.infinityfree.com";
   $username = "[verilen kullanıcı adı]";
   $password = "[verilen şifre]";
   $dbname = "[veritabanı adı]";
   ```

### 2. Vercel (Ücretsiz - PHP Desteği)
**Adres:** https://vercel.com

#### Kurulum Adımları:
1. **GitHub hesabınızla giriş yapın**
2. **"New Project" seçin**
3. **bohem-menu repository'sini seçin**
4. **Framework Preset:** Other
5. **Deploy edin**

### 3. Heroku (Ücretli - Profesyonel)
**Adres:** https://heroku.com

#### Kurulum Adımları:
1. **Heroku CLI kurun**
2. **Hesap oluşturun**
3. **Uygulamayı deploy edin:**
   ```bash
   heroku create bohem-menu-app
   git push heroku main
   ```

## 🔧 Özel Domain Bağlama

### InfinityFree'de:
1. **Domain Management** bölümüne gidin
2. **"Add Domain"** seçin
3. **Kendi domain'inizi girin** (örn: bohem-menu.com)
4. **DNS ayarlarını yapılandırın**

### Vercel'de:
1. **Project Settings** > **Domains**
2. **Domain ekleyin**
3. **DNS kayıtlarını güncelleyin**

## 📱 Test Etme

### Yerel Test (XAMPP/WAMP):
1. **XAMPP kurun:** https://www.apachefriends.org/
2. **Projeyi htdocs klasörüne kopyalayın**
3. **Apache ve MySQL'i başlatın**
4. **http://localhost/bohem-menu** adresine gidin

### Online Test:
1. **Hosting'e deploy edin**
2. **Veritabanını kurun**
3. **Admin paneline giriş yapın**
4. **Ürün ekleyin ve test edin**

## 🛠️ Sorun Giderme

### Veritabanı Bağlantı Hatası:
- Hosting bilgilerini kontrol edin
- Veritabanı kullanıcı adı/şifresini doğrulayın
- Veritabanının oluşturulduğundan emin olun

### Resim Yükleme Sorunu:
- `resimler/` klasörünün yazma izinlerini kontrol edin
- Dosya boyutu limitlerini kontrol edin

### Admin Paneli Erişim:
- Kullanıcı adı/şifre bilgilerini kontrol edin
- Session ayarlarını kontrol edin

## 📞 Destek

Sorun yaşarsanız:
- Hosting sağlayıcısının destek sayfasını ziyaret edin
- GitHub Issues bölümünde sorun bildirin
- E-posta ile iletişime geçin 
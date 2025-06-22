# 🌐 InfinityFree Veritabanı Kurulum Rehberi

## 📋 Adım 1: InfinityFree Hesabı Oluşturma

1. **https://infinityfree.net** adresine gidin
2. **"Sign Up"** butonuna tıklayın
3. **E-posta adresinizi** girin
4. **Şifrenizi** belirleyin
5. **Hesabınızı doğrulayın**

## 📋 Adım 2: Hosting Hesabı Oluşturma

1. **"Create Account"** bölümüne gidin
2. **Subdomain seçin** (örn: `bohem-menu.infinityfreeapp.com`)
3. **"Create Account"** butonuna tıklayın
4. **Hosting bilgilerinizi not edin**

## 📋 Adım 3: Veritabanı Oluşturma

### 3.1 phpMyAdmin'e Giriş
1. **Control Panel**'e gidin
2. **"phpMyAdmin"** linkine tıklayın
3. **Kullanıcı adı ve şifrenizi** girin

### 3.2 Veritabanı Oluşturma
1. **Sol menüden** "New" veya "Yeni" seçin
2. **Veritabanı adını** girin (örn: `bohem_menu`)
3. **"Create"** veya "Oluştur" butonuna tıklayın

### 3.3 Tabloları Oluşturma
1. **Oluşturduğunuz veritabanını** seçin
2. **"SQL"** sekmesine tıklayın
3. **`database_setup.sql`** dosyasındaki kodu kopyalayın
4. **"Go"** veya "Git" butonuna tıklayın

## 📋 Adım 4: Bağlantı Ayarlarını Güncelleme

### 4.1 baglanti.php Dosyasını Düzenleme
`baglanti.php` dosyasında şu bilgileri güncelleyin:

```php
$servername = "sql.infinityfree.com";
$username = "YOUR_INFINITYFREE_USERNAME";  // Control Panel'den alın
$password = "YOUR_INFINITYFREE_PASSWORD";  // Control Panel'den alın
$dbname = "YOUR_DATABASE_NAME";            // Oluşturduğunuz veritabanı adı
```

### 4.2 Bilgileri Nereden Alacağınız
1. **Control Panel**'e gidin
2. **"MySQL Databases"** bölümüne gidin
3. **Veritabanı bilgilerinizi** not edin:
   - **Host:** sql.infinityfree.com
   - **Username:** [verilen kullanıcı adı]
   - **Password:** [verilen şifre]
   - **Database:** [oluşturduğunuz veritabanı adı]

## 📋 Adım 5: Dosyaları Yükleme

### 5.1 FTP Bilgilerini Alma
1. **Control Panel**'e gidin
2. **"FTP Accounts"** bölümüne gidin
3. **FTP bilgilerinizi** not edin:
   - **Host:** ftpupload.net
   - **Username:** [verilen kullanıcı adı]
   - **Password:** [verilen şifre]
   - **Port:** 21

### 5.2 FileZilla ile Yükleme
1. **FileZilla** indirin: https://filezilla-project.org/
2. **FTP bilgilerinizi** girin
3. **Tüm proje dosyalarını** `htdocs` klasörüne yükleyin

## 📋 Adım 6: Test Etme

### 6.1 Ana Sayfa Testi
- **https://your-subdomain.infinityfreeapp.com** adresine gidin
- Ana sayfanın yüklendiğini kontrol edin

### 6.2 Admin Paneli Testi
- **https://your-subdomain.infinityfreeapp.com/admin/** adresine gidin
- **Kullanıcı adı:** admin
- **Şifre:** admin123

### 6.3 Veritabanı Testi
- Menü sayfasında ürünlerin görüntülendiğini kontrol edin
- Admin panelinde ürün ekleme/düzenleme işlemlerini test edin

## 🛠️ Sorun Giderme

### Veritabanı Bağlantı Hatası
- Hosting bilgilerini kontrol edin
- Veritabanının oluşturulduğundan emin olun
- Kullanıcı adı/şifre bilgilerini doğrulayın

### Resim Yükleme Sorunu
- `resimler/` klasörünün yazma izinlerini kontrol edin
- Dosya boyutu limitlerini kontrol edin (InfinityFree'de 10MB)

### Admin Paneli Erişim Sorunu
- Kullanıcı adı: `admin`
- Şifre: `admin123`
- Session ayarlarını kontrol edin

## 📞 Destek

Sorun yaşarsanız:
- **InfinityFree Forum:** https://forum.infinityfree.net/
- **GitHub Issues:** Projenizin GitHub sayfasında sorun bildirin
- **E-posta:** [E-posta adresiniz]

## 🔐 Güvenlik Notları

1. **Varsayılan şifreyi değiştirin**
2. **Admin kullanıcı adını değiştirin**
3. **Düzenli yedek alın**
4. **Güncel tutun**

## 🎉 Tebrikler!

Veritabanınız başarıyla kuruldu! Artık Bohem Menu uygulamanız online olarak çalışıyor. 
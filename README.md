## Bu Proje Hakkında

Görev Yönetimi demo projesi, [Laravel](https://laravel.com/) altyapısını ve [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) paketini kullanarak görev yönetimi için gerekli bazı API endpointleri sağlar. Bunlar:

- Görevleri isteğe bağlı filtreleri kullanarak listeleme
- Görev görüntüleme
- Görev güncelleme
- Görev silme
- Kullanıcılara görev atama
- Görev atanan kullanıcılara e-posta gönderme

gibi fonksiyonların gerçekleştirilmesini sağlar.
## Kurulum

Aşağıdaki adımları takip ederek projeyi yerel makinenize klonlayabilir ve kurabilirsiniz.
1. Projeyi klonlama:

   ```bash
    git clone https://github.com/metinbolat/task-management-api.git
    
    cd task-management-api
    ```
   Eğer `.env` dosyasında veritabanı ayarları gibi değişiklikler yapmanız gerekmiyorsa
   aşağıdaki `Artisan` komutunu kullanabilirsiniz:

    ```bash
    php artisan project:install
    ```

Bu komut, şu işlemleri sırasıyla gerçekleştirir:

- Composer yükler
- `.env.example` dosyasını `.env` ismiyle kopyalar
- `.env` dosyasında `APP_KEY` değeri oluşturur.
- Veritabanı kurulumlarını gerçekleştirir
- Test amaçlı olarak veritabanı tablolarına sahte kullanıcı ve görev verisi yazar

Eğer özelleştirmeniz gereken noktalar varsa, aşağıdaki adımları izleyebilirsiniz:

2. Bağımlılıkları yükleme:
    ```bash
    composer install
    ```

3. `.env` dosyasını ayarlayın:
   `.env.example` dosyasını `.env` olarak kopyalayın ve veritabanı ayarlarınızı yapın.

4. Uygulama anahtar kodu oluşturma:
    ```bash
    php artisan key:generate
    ```

Bir kullanıcıya görev atandığında e-posta gönderilmesini sağlamak için gerekli `Mailer` kurulumlarını
tamamlamanız yeterli olacaktır.


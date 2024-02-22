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
2. Bağımlılıkları yükleme:
   ```bash
   composer install
   ```

3. `.env` dosyasını ayarlama:
   `.env.example` dosyasını `.env` olarak kopyalayın ve veritabanı ayarlarınızı yapın.

4. Uygulama anahtar kodu oluşturma:
    ```bash
    php artisan key:generate
    ```
5. Veritabanı kurulumlarını tamamlama ve tablolara sahte veri yazma:
    ```bash
    php artisan migrate --seed
    ```
Bir kullanıcıya görev atandığında e-posta gönderilmesini sağlamak için gerekli `Mailer` kurulumlarını
tamamlamanız yeterli olacaktır.


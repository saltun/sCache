sBotClass
=========

Kolay kullanımlı PHP dosya cache sistemi

- Sıkıştırma Özelliği
- Load hesaplama özelliği



2 Adımda Kurulum
===========================

sCache sınıfını sayfamıza dahil edelim.

``` php
require_once "sCache.php";

```

Sayfamızın en üst kısmın'da sCache'i çalıştıralım.
** eğer sayfanın en üstünde çalıştırmaz iseniz cache tam anlamı ile çalışmaz **

``` php
$sCache = new sCache($options);
```

Tüm kurulum işlemi bu kadardır. 

> **Notlar:**

> - Eğer zaman değeri belirmez iseniz cache süreleri 60 saniyedir.
> - Eğer özel cache yolu belirtmez iseniz ana dizinde **sCache** dizin oluşturup içinde tutacaktır.
> - Cache adresleri md5 ile şifrelenip tutulmaktadır.
> - Eğer cache'e sıkıştırma özelliğini aktif etmez iseniz sıkıştırma yapmadan tutacaktır.
> - Eğer load özelliğini açmaz iseniz load değerleri gösterilmeyecektir.
Ayarları düzenlemek için dizi olarak ayarları göndermeniz gerekir bunu nasıl yapacağınızı öğrenmek için alttaki dökümana bakınız.



Ayarlar ( Options )
===========================
Ayarları bir dizi halinde sınıfın başlangıcında göndermeniz gerekir göndere bileceğiniz değerler ise altta listelenmiştir
- time = Cachenin tutulacağı süre dilimi ( standart 60 saniye ) 
- dir = Cache dosyalarınızın tutulacağı dizin adı. Yok ise otomatik oluşturulur ( standart **sCache** ) 
- buffer = Oluşturulan cache dosyalarında sıkıştırılma yapılmasını ister iseniz **true** değerini göndermelisiniz ( standart kapalıdır ) 
- load = Sayfanın load süresi yani açılma süresinin en altta görünmesini istiyor iseniz **true** değeri göndermelisiniz.

Şimdi yukarıdaki özelliklerin hepsini kullanarak örnek bir ayar dizini oluşturup gönderelim.

``` php
$options = array(
	'time'   => 120, // 120 saniye yani 2 dakika
	'dir'    => 'sCache2', // sCache2 klasörü oluşturup buraya yazılsın.
	'buffer' => true, // html sayfalarımızın sıkıştırılmasını aktif edelim.
	'load'   => true  // sayfamızın sonunda load değerimiz görünsün.
	);

$sCache = new sCache($options); // ayarları sınıfımıza gönderip sınıfı çalıştıralım.
```


Tüm Cache dosyalarını temizleme
===========================
clearCache fonksiyonunu çalıştırdığınız zaman cache'de belirtilen dizindeki tüm cache dosyaları silinir eğer standart dizin dışında farklı bir dizinde cache dosyalarınızı tutuyor iseniz ayarları göndermeyi unutmayınız.
``` php
$sCache->clearCache();
```



Author : Savaş Can Altun
Mail : savascanaltun@gmail.com
Web : http://savascanaltun.com.tr

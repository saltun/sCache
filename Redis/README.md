sCache Class Redis Versiyon
=========

Redis desteği eklenmiştir redis desteği ile kullanımda standart kullanım ile aynı şekildedir sadece redis server'e bağlanmanız yeterlidir  örnek dosyalarını inceleye bilirsiniz redis server'e bağlantı için **[Predis](https://github.com/nrk/predis)** Kullanılmıştır.


**[Genel Sınıf Kullanım Dökümanı](https://github.com/saltun/sCache/blob/master/README.md)**


Örnek Redis server bağlantısı ve Sınıf başlangıcı
===========================

sCache sınıfını sayfamıza dahil edelim.

``` php
require_once "predis/autoload.php"; // Predis yolu
require_once "sCache.php"; // sCache Sınıfı yolu

$redis=array("scheme" => "tcp","host" => "127.0.0.1","port" => 6379); // Predis ile redis bağlantı bilgileri bunun detayları için Predis dökümanını okuyunuz

$sCache = new sCache($redis); // Sınıf başlangıcı 

```


Author : Savaş Can Altun
Mail : savascanaltun@gmail.com
Web : http://savascanaltun.com.tr

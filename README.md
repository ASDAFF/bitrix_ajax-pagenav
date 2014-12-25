Постраничная навгиция на ajax jQuery для CMS Bitrix
===================

Как пользоваться
---------
```php
<? if (isset($_GET['ajax']) && $_GET['ajax'] == '1') $APPLICATION->RestartBuffer(); ?>
вызов компонента
<? if (isset($_GET['ajax']) && $_GET['ajax'] == '1') die; ?>
```

В настроуках компонента выбираем шаблон ajax
# Laravel Task
laravel package untuk task management

## Install :
```bash
$ composer require bantenprov/task:dev-master
```

## Edit `app/config.php`
```php
'providers' => [
        App\Providers\RouteServiceProvider::class,
        
        //...
        Bantenprov\TaskManagement\TaskServiceProvider::class,
```

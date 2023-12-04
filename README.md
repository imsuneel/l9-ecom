## Installation
### Data has been generated through laravel factory faker

1. `git clone https://github.com/imsuneel/l9-ecom.git l9-ecom`
2. `cd l9-ecom`
2. `cp .env.example .env`

3. `composer install`

4. `php artisan key:generate`

5. Set database credentials in '.env' file

6. Set smtp credentials in '.env' file

7. `php artisan migrate && php artisan passport:keys`

8. Use Password grant client `php artisan passport:install --uuids`

9. `composer dumpautoload -o`

10. `php artisan migrate`

11. `php artisan db:seed`


## Permissions

### Local only

```
sudo chown -R :www-data bootstrap/cache
sudo chmod -R ug+rwx bootstrap/cache
sudo chown -R :www-data storage/
sudo chmod -R ug+rwx storage/
```



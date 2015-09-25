@servers(['web' => 'admin@192.168.1.120'])

@task('deploy')
    cd /share/Web/wol
    git pull origin master
    composer install --no-interaction --no-dev --prefer-dist
    php artisan migrate --force
@endtask

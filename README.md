composer require laravel/ui

php artisan ui bootstrap --auth

php artisan migrate

npm install
npm run dev

Utilizado laravel-excel para exportação de relatorios excel
https://laravel-excel.com/

composer require mpdf/mpdf

para configurar o mpdf no laravel-excel, ir em config/excel.php, pesquisar por 'pdf' e alterar para 'mpdf' o valor 'Excel::MPDF'

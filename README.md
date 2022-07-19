# Invoices
Invoicing software solution

## TODO
- [x] CRUD
- [ ] Bulk import for invoices


## How to install and run the project

```
cd parent_of_your_repo
git clone https://github.com/Merchans/invoices.git
cd invoices
composer install
npm install
copy .env.example and rename to .env
set up .env (local db connection)
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
go to http://127.0.0.1:8000
```

## Rules
- For the bugs we use commit -m "fix: your fix message"
- For the new functionality we use commit -m "feat: about new feat"

## How it work
### index
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/index.png)
### create
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/create.png)
### show / print
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/invoice.png)
### edit
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/edit.png)
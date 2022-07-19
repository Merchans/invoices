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
![alt text](http://url/to/img.png)
### create
### show / print
### edit

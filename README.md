# Invoices
Invoicing software solution

## TODO
- [x] CRUD
- [ ] Bulk import for invoices
- [ ] Table searching
- [ ] Add filter to table
- [ ] Add sorting to table


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
- **The user expects:**
    - list of all created invoices
    - possibility to create an invoice
    - the ability to print, edit or delete an invoice

- **The system requires:**
    - click to "Create invoice"
    - click to "Print", "Edit", "Delete"

### create
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/create.png)
- **The user expects:**
    - possibility to create an invoice

- **The system requires:**
    - fill in all details on the page

### show / print
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/invoice.png)
- **The user expects:**
    - possibility to print or save as pdf the invoice

- **The system requires:**
    - click to "Print"
        - select the method of printing

### edit
![homepage](https://raw.githubusercontent.com/Merchans/invoices/ea59dbf5925fcca1264f9612255668dfb59f4a40/public/images/edit.png)
- **The user expects:**
    - possibility to change all invoice data

- **The system requires:**
    - click to "Update invoice"


### Procedure at work:
1. install framework Laravel
2. installing the package for UI
3. create routs
4. create controllers
5. create models
6. create blade files
7. create a CRUD on the invoice model
8. manage the relationship between an invoice and its items
9. devise a way in which data can be retrieved from a public source
10. insert data from an external source into a blad designed for printing invoices and forms for editing and creating invoices


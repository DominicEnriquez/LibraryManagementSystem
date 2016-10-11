## Library Management System

This simple application written using [Laravel 5.1 LTS](https://laravel.com/docs/5.1) Framework

## System Specifications

- User portal  - for members of the Library
- Admin portal - for Librarians

### Public Access

- User Login
- Member Registration
- Member Forgot Password

### User Portal

- search for a book by Title and/or Author
- borrow a book
- return a book

### Admin Portal

- manage Books (add, edit, delete)   [title, author, isbn, quantities, shelf location]
- manage Members (add, edit, delete)
- view Report - book loans, balance quantities

### Restrictions

- each book is loaned for a maximum duration of 2 calendar weeks
- failure to return a book before expiry will cause a Fine to be charged to the Member @ $2 per day or part thereof
- each Member can loan a maximum of 6 books
- each Junior Member (age <= 12 years) can loan a maximum of 3 books

# Polarix

PHP 8 + MySQL implementation of the first functional Polarix flow.

## Functional flow

`Sign in -> Register sale -> Persist sale details -> Decrease product stock`

The implementation uses PDO prepared statements, password hashing, sessions, role-aware users, transactions, foreign keys, separate services, and an integration test.

## Local setup with XAMPP

1. Start Apache and MySQL.
2. Run `database/schema.sql` in phpMyAdmin.
3. Run `php database/seed.php` to create demo data.
4. Configure database variables if your MySQL credentials are not the defaults.
5. Serve the project from Apache and call `public/api/login.php` and `public/api/sales.php`.

The default XAMPP configuration in this project uses MySQL port `3307`.

## Integration test

Set `POLARIX_TEST_DSN` to a test MySQL database and run:

```bash
php tests/integration.php
```

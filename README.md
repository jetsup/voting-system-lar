# Voting System

## Usage

For instructions on how to configure the system, take a look at [setup.md](setup.md) file.

### Note

The project utilizes seeded data at it's core. Default `admin` user and a sample `voter` accounts qre created in the seed therefore it will be necessary to run the command with seed option

```bash
php artisan migrate:refresh --seed
```

The default credentials are **email:** `admin@account.com` **password:** `Admin123.` for the admin and **email:** `voter@account.com` **password:** `Voter123.` for the voter account.

# APP Code Test

## Requirements
1. A local server running php 8.1 or higher and mysql 8.0 or higher

## Installation
1. Clone the repository
2. Run `composer install`
3. Copy the `.env.example` file to `.env`
4. Update the `.env` file with your database credentials. Note: there is no need to update the database name as the database will be created in the next step.
5. Run `php db-setup.php` to create the database and tables
6. Run `./vendor/bin/phpunit tests` to confirm the application is set up and working correctly

## Notes

- I stored the total minutes as a single column in the database, instead of two separate columns for hours and minutes.
As that would require an additional calculation step to separate the total minutes and minutes, and would be much less efficient.
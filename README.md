# zara

CLI commands: 
`php artisan download:url someURLHEre` - for place new url file into Queue
`php artisan files:list`  - for output file lists and statuses from database

Http routes:
https://zara.app/ - index route with file lists, statuses and link for adding new file to download
https://zara.app/api/file - route for add file to download via POST form

Install:
as usual migrating, settings .env etc.

Unit test:
[x] http
[x] storage
[x] console

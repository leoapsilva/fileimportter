# FileImportter
Imports files in CSV and XML files to database using Laravel.

## What it does?

* Import immediately or enqueue a file
* Check the status of a enqueued import using RestAPI
* Easily extensible for other file formats
    * Create a <your_model>Import class
    * use traits TableImportable
    * Create <your_model>Resource class
    * Create <your_model>Collection class
    * Create Import, Resource e Collection of nested models
    * Bind model and file format 
    * FileImporter Class does the magic :P

## Features

* Import CVS 
    * With defined header
    * Accepts empty fields
        * Only the key is required
    * Imports doing upserts
        * Check if the row is already in database and updates the fields 
    * Easily extensible to other classes (models)
    * Stores each imported file on a table
        * Date and time
        * Number of rows
        * User
        * Filename
        * Model
        * Data imported in JSON - for future "undo" feature
* Import XML
    * Easily extensible to other classes (models)
    * Nested tags in diffent tables
    * Validation
        * Extension
        * Mime
        * Model must match the root tag
        * Empty file
        * Open / close tag absence
* Dashboard
    * Total of rows imported
    * Unique rows
    * Duplicate rows
    * Empty fields
* Unit and Feature tests
    * Using XML and CVS as test scenarios
* RestAPI
    * ImportFile (Jobs)
    * People (XML)
    * ShipOrders (XML)
* Data table
    * Search for every fields easyly and reactively (thanks to livewire)
    * Choose number of rows per page
    * Order by any field (thanks to livewire)
    
# Install, config and run

## Prerequisites
   * Docker and Docker-compose installed
     * Choose the better option for you Operating System and taste
   * Account on docker-hub

## Steps
1. Clone this project
2. Create a .env file (you can copy from .env.example)
3. Edit .env ``APP_URL`` 
    * On my environment I use ``localhost``
    * Keep the port ``8000``
````
APP_URL=http://localhost::8000
````

3. Edit .env ``DB_*`` parameters

````
DB_CONNECTION=mysql
DB_HOST=your_db_address
DB_PORT=3306
DB_DATABASE=fileimportter
DB_USERNAME=pick_a_user
DB_PASSWORD=choose_a_password
````

5. ``DB_PASSWORD`` **cannot be empty otherwise MySQL server will keep restarting!**
6. Edit .env ``QUEUE_CONNECTION`` 
````
QUEUE_CONNECTION=database
````
7. Edit ``docker-compose.yml``
    * Depending on the OS you are executing you could change the volume diretory.
    * Particularly I struggled with VirutalBox on Win7 and Kitematic (yeah... It's too 2015, but still works!).
    * I had to map a directory and then mount on docker VM.
    * If it is your environment, please refer to this article: 
    http://support.divio.com/en/articles/646695-how-to-use-a-directory-outside-c-users-with-docker-toolbox-docker-for-windows
   
   * Edit app volume to directory where you named on VirtualBox 
      ````
       volumes:
      - your_mapped_directory:/var/www/
      ```` 
   * Edit ngix volume to directory where you named on VirtualBox
   ````
       volumes:
      - /home/docker/projects/importcsv/:/var/www/
      - /home/docker/projects/importcsv/docker-compose/nginx/:/etc/nginx/conf.d/
   ````
8. Compile the app image
    * Use ``docker-compose build app`` on CLI where ``Dockerfile.yml`` and ``docker-compose.yml`` are located.
    * If you are using VS Code there is a good plugin that helps a lot: ``ms-azuretools.vscode-docker``
9. If everything works fine, you should see something like this (depending on you environment)
````
Creating fileimportter-db    ... done
Creating fileimportter-nginx ... done
Creating fileimportter-app   ... done
```` 
10. You can check if is running using ``docker-compose ps`` on CLI and you should see
Check if it is running
sudo docker-compose ps
````
       Name                      Command               State          Ports
-----------------------------------------------------------------------------------
fileimportter-app     docker-php-entrypoint php-fpm    Up      9000/tcp
fileimportter-db      docker-entrypoint.sh mysqld      Up      3306/tcp, 33060/tcp
fileimportter-nginx   /docker-entrypoint.sh ngin ...   Up      0.0.0.0:8000->80/tcp
````

11. Open a shell (or any other way to execute a command) to app to run composer and generate the key 
``# docker-compose exec app composer update``
``# docker-compose exec app php artisan key:generate``

12. Start the queue
``# docker-compose exec app php artisan queue:work``

* This command cannot be stoped otherwise the job that enqueues a file import will never start or finish.
* When you choose enqueue a file importing you will also see the processing status of the jobs like:
````
$ php artisan queue:work
[2021-01-20 05:20:16][2] Processing: App\Jobs\ProcessFileImport
[2021-01-20 05:20:16][2] Failed:     App\Jobs\ProcessFileImport
[2021-01-20 05:22:51][3] Processing: App\Jobs\ProcessFileImport
[2021-01-20 05:22:51][3] Processed:  App\Jobs\ProcessFileImport
````

13. Now you can open a browser on URL defined on step *3*.
14. Click on "Register", pick a username and password.
15. If your have a message like
``SQLSTATE[HY000] [2002] Connection refused``
you have to change the address of you database.
    * Inspect the db container and find its IP address.
    * On my environment I had this problem and this article helped me to solve the problem:
    https://laracasts.com/discuss/channels/laravel/dock-laravel-sqlstatehy000-2002-connection-refused


## Future features
* Undo a file import removing the rows on database
* Remove duplicate rows
* Prevent import duplicated rows 
  * Still imports duplicate rows for some models
  
## The name
* "File importer" reminds me  Harry Potter and I'm a fan :P

## Thanks
* Medialoot for free Lumino Theme
  * https://www.medialoot.com/
* @Maatwebsite for Laravel-Excel
  * https://github.com/maatwebsite/Laravel-Excel
* @livewire for Livewire
  * https://github.com/livewire/livewire
* Youghourta Benali for the helpful tutorial about Jobs and Queues
  * https://laravel-news.com/laravel-jobs-and-queues-101
  * He is also author of http://laraveltesting101.com 
* Great Laravel 8.x documentation
  * https://laravel.com/docs/8.x/
* ACFBentveld for XML Import package
  * https://github.com/ACFBentveld
* Jeffrey Way from Laracasts
  * In special for the screencast serie "Laravel From Scratch"
   (*Laravel 6, but still a great resource of knowledge)
  * https://laracasts.com/series/laravel-6-from-scratch 

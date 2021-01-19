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
    
## Screenshots


## Instalation


## Running

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

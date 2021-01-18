# importFile
Import a CSV and XML files to database using Laravel using job and queue.

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
    * Let FileImporter Class do its magic!

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
    * Search for every fields esasy and reactively (thanks to livewire)
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
  

## 
# Thanks
* Medialoot for free Lumino Theme
  * https://www.medialoot.com/
* @Maatwebsite for Laravel-Excel
  * https://github.com/maatwebsite/Laravel-Excel
* @livewire for Livewire
  * https://github.com/livewire/livewire

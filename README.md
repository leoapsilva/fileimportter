# importcsv
Import a CSV file to database using Laravel.

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
  
* Dashboard
    * Total of rows imported
    * Unique rows
    * Duplicate rows
    * Empty fields

* Data table
    * Search for every fields esasy and reactively (thanks to livewire)
    * Choose number of rows per page
    * Order by any field (thanks to livewire)
    
## Screenshots



## Future features
* Undo a file import removing the rows on database
* Remove duplicate rows
* Prevent import duplicate rows
  
# Thanks
* Medialoot for free Lumino Theme
  * https://www.medialoot.com/
* @Maatwebsite for Laravel-Excel
  * https://github.com/maatwebsite/Laravel-Excel
* @livewire for Livewire
  * https://github.com/livewire/livewire

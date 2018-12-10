# LibraryCatalog
PHP code to create an online library catalog using MySQL as repository. Tha catalog will be available
though a web site that users can browse. Adminstrative functions will also performed from a web interface.

You can see a sample in action at 
http://www.casalcatala.ca/CasalBiblioteca/biblioteca.htm

I want to recognize the finacial support given to this project by the Generalitat de Catalunya through 
their support to the Casal Català de Vancouver- Catalan Association of Vancouver


## Structure
The [public] folder contains the files that user will access to find books.

The files under the root directory are the files user by the administrator. They allow
to add new book and new authors to the collection.

The admnimistrator credentials are stored in the database. At this moment there is not an interface to 
edit these credentials. 


## Usage
Copy the files into the location you want to use them. 
Install the DB on MySQL by executing BiblioDBStructure.sql. The script will create all the tables for 
the database names casalcat_casalbiblioteca
Modify the common_variables.php script to point to your db
(Note: Currently the name of the DB is set to casalcat_casalbiblioteca, of course you can modify it!)


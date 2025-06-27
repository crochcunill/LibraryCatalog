# LibraryCatalog
PHP code to create an online library catalog using MySQL as repository. Tha catalog will be available
though a web site that users can browse. Administrative functions will also performed from a web interface.

You can see a sample in action at 
http://www.casalcatala.ca/CasalBiblioteca/biblioteca.htm

I want to recognize the financial support given to this project by the Generalitat de Catalunya through their support to the Casal Català de Vancouver- Catalan Association of Vancouver


## Structure
The [public] folder contains the files that user will access to find books.

The files under the root directory are the files user by the administrator. They allow to add new book and new authors to the collection. When you connect to *localhost* you connect to the administration page.

The administrator credentials are stored in the database (table *administradors* ). At this moment there is not an interface to edit these credentials. 


## Usage
Copy the files into the location you want to use them. 
Install the DB on MySQL by executing BiblioDBStructure.sql. The script will create all the tables for the database names casalcat_casalbiblioteca
Modify the *common_variables.php* script to point to your db and fill it with the name of the host, user and password. Currently they are set to the mySQL defaults.


(Note: Currently the name of the DB is set to casalcat_casalbiblioteca, of course you can modify it!)

## More information
The Docker LAMP structure is cloned from:
https://github.com/mzazon/php-apache-mysql-containerized

Note: the PHP server has been upgraded to 7.4

An example of a more current version of the stack can be found at
https://github.com/akospasztor/docker-lamp

I suggest to read the README file associated to the LAMP stack before installing the files to run the LibraryCatalog
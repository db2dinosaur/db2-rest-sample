# db2-rest-sample
Sample PHP, HTML and JavaScript to drive DB2 for z/OS Native REST API.

We eneded up creating this as part of an investigation in to the Native REST API now available in DB2 for z/OS via DDF. It uses data from the sample tables (DEPT and EMP) to produce a web based departmental quick reference, with phone numbers. 

To run this, your will need:

1. DB2 for z/OS V11 or higher
2. A test web server (we used Apache) with PHP installed (web server plugin and command line)
3. A client machine with a web browser that supports JavaScript. We've tested with Chrome and IE (11).

If you're looking for more information on the DB2 for z/OS REST API, there's a blog on the Triton Consulting web site (www.triton.co.uk) that was written as a result of developing this and covers the subject in more detail than I'm going to here!

The sample uses 2 REST services:

* GetDepartments - which gets a list of departments and their managers, and
* GetEmployeesByDepartment - which pretty much does what it says!

These are created by two corresponding PHP scripts:

* crGetDepartments.php
* crGetEmployeesByDepartment.php

To use these, you will need to edit them as follows:

1. Change $url and replace "s0w1.local.zpdt:2046" to the address and port of your DB2 for z/OS service
2. Change "collectionID" "GILLJSRV" to a package collection that you can bind into - this also forms part of the service address
3. Change "qualifier" as necessary. DB2 V11 uses "DSN81110" as the sample schema, DB2 V12 uses "DSN81210"
4. Change $userid / $pwd to a suitable mainframe ID

Then run them using:

php -f crGetDepartments.php

php -f crGetEmployeesByDepartment.php

The sample is intended to run from the document root of the web server. Before you copy them over, you'll need to edit the two web server PHP scripts:

* GetDepartments.php
* GetEmployeesByDepartment.php
 
These provide the glue between the HTML / JavaScript and the REST services. The same edits will need to be applied to these two as for the previous two PHP scripts.

Once editted, copy these and the staff.html and staff.css files to the document root of your test web server.

Run by pointing your web browser at:

  http://my.test.web.server/staff.html

If you run into trouble, try the following checklist:

1. If you point your web browser at http://my.db2.service:port/services/ you should get a JSON encoded list of installed services back from DB2. Make sure the two services appear in the list. NB Chrome users will find the JSON Formatter extension (by Callum Locke) in the Chrome Store useful!
2. On the web server, in the document root (e.g. /var/www/htdocs) when you issue the following command, you should see the JSON return from the GetDepartments service: php -f GetDepartments.php
3. If you need to test the GetEmployeesByDepartment.php script and its supporting service, edit the supplied testGetEmployeesByDepartment.php (as above) and run it from the command line with: php -f testGetEmployeesByDepartment.php

Good luck!

db2dinosaur - January 2017

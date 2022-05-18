# ValuAg Project

## Description
 
 Our main object for this project was to digitalize the forms that are used by employees of the Big Yield Growers. This forms were used for tracking the planting operation. After we digitalized the main forms, we also developed some pages that collected and showed data in a table. 
 
 Gradually developing the website for 2 semesters, we implemented many different processes and quaility of life changes. After the implementation of sprout process in the plating site, we also adapted our site to collect datas of these sprouts too. We implemented a search function which serves as another tool to inspect the seeds planted.
 - Documentation can be found in files above.
 
## Team Members

 - Mahmut Cuneyt Unsal
 - Emre Serdar
 - Erkut Cetiner
 
## Requirements for installation 

 - Amazon Linux Server with dependencies installed in it
 - Backup of the server
 - Script for deployment
 - SQL dump
 - Basic WordPress knowledge to publish pages

## What we did to fresh EC2 Instance ?

 - do a sudo yum update && sudo yum upgrade
 - Install wordpress to /var/www/html and configure credentials in wp-admin.php
 - Install the webserver (either nginx or apache), and configure it for wordpress
 - Install phpMyAdmin and import the sql dump
 - Deploy our code using our deploy script
 - Go to wordpress and publish page templates manually
 
 ## Some Screenshots of the Website
 - Planting Process Form 
 
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/plant.png)
  
 This form is used to replace planting process tracking papers used by employees. As in the planting facility, employee first enters the level that is being worked on. Then selects the seed type from a list provided from our database. And employee selects a harvesting color for the seed. After entering the amount planted and button clicked, backend process starts.

 When this button is clicked, our website also collects data of date and the employee name to store in the database. 
  
 - Insert data into actions table. -> To track actions done by employees.
 - Update data from unit table. -> Done for showing which units are available or not.
 - Insert data into seed id table. -> Done for unique ids which will later be used in search.
 
 3 SQL processes of planting are shown above:
  
 - Table Result of a Search
 
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/searchresult.png)
  
 This table is generated for showing unique seeds action history. This is developed because a tracking process was needed. This table shows data from action table of a seed, also data from seed id table. To implement this we needed to write 3 different PHP files, 1 for searching and 2 for results since there are 2 types of seeds and they are very different from each other. Shown screenshot above is result of a sprout.
 
 - Admin Panel
 
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/adminpanelpng.png)
  
 Admin Panel is restricted only to admin users of the website. Here you can add or delete seeds or units. This is restricted because changing these were normally done by hand in the database since these values won't change often.  
 
 ## Database Structure
 
  Below you can see the database table schemes, the usual WP tables are excluded.
  
  ![Database Structure](https://github.com/valuagorg/php/blob/master/imgs/databaseimg.png)

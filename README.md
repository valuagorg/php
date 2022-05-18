# ValuAg Project

## Description
 
 Our main object for this project was to digitalize the forms that are used by employees of the Big Yield Growers. This forms were used for tracking the planting operation. After we digitalize the main forms, we also developed some pages that collected and showed data in a table.After developing the website for 2 semesters, we implemented many different processes and quaility of life changes. After the implementation of sprout process in the plating site, we also adapted our site to collect datas of these sprouts too. We implemented a search function which serves as another tool to inspect the seeds planted.
 
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
 
 ## Plant
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/plant.png)
  
   Planting page
  
 ## Table Result
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/searchresult.png)
 
 ## Admin Panel
  ![Alt](https://github.com/valuagorg/php/blob/master/imgs/adminpanelpng.png)
 
 ## Database Structure
 
  Below you can see the database table schemes, the usual WP tables are excluded.
  
  ![Database Structure](https://github.com/valuagorg/php/blob/master/imgs/databaseimg.png)

Installation steps
======================

- Create a new db with your desired name
- Import the following files in the following order to the database using a tool such as PHPMYADMIN:
  - protected/data/schema.sql
  - protected/data/inserts.sql
- Make sure you change the configuration values located under protected/config/main.php such as:
  - facebookappid
  - facebookapikey
  - facebookapisecret
  - emailin
  - emailout
- Make sure you change the DB values in both protected/config/dev.php and protected/config/production.php

- Access the application and you should see the index page of the site module. 
- In order to access the application admin control panel, You must first login in the front end site so navigate to the login page
  and use the following email address and password to access the admin panel and have the admin role permissions:
  - Email: admin@admin.com
  - Password: admin


Contributing
=======================

If you wish to contribute please follow these steps:

- Fork the source code
- Create an issue for what ever you're working on
- Push the code to a branch and then open a pull request

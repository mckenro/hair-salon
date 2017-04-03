# _Hair Salon App_

#### _Epicodus PHP Week 3 Independent Project, March 31, 2017_

#### By _**Rob McKenzie**_

## Description

_Program that allows the input of Stylists and their Clients into a MySql database. Stylists and Clients can also be editted and deleted. View the project repository on GitHub here https://github.com/mckenro/hair_salon_

## Setup/Installation Requirements

* _Download or clone project files_
* _Run Composer Install or Composer Update in terminal_
* _Use MAMP to run the Apache server from the project web folder._

## Specs (include project specs below)
* _Create tests for Stylist object_
* _Create functions for testing the Stylist object_
* _Add initial routing to app.php_
* _Create tests for Client object_
* _Create functions for testing the Client object_
* _Create views pages_
* _Add routing_

## SQL Commands for the databases
* _CREATE DATABASE hair_salon;_
* _CREATE TABLE stylists (name VARCHAR (255), id serial PRIMARY KEY);_
* _CREATE TABLE clients (client_name VARCHAR (255), stylist_id (INT), id serial PRIMARY KEY);_
* _ALTER TABLE clients ADD stylist_id;_

## Known Bugs

_No known bugs,_

## Support and contact details

_If you run into any issues or have questions, ideas or concerns, please contact Rob McKenzie at mckenro@gmail.com_

## Technologies Used
* _Bootstrap 3.3.7_
* _JQuery 3.2.0_
* _Silex 1.1_
* _Twig 1.0_
* _PHPUnit 4.5.*_
* _MySql_

### License

*This project is licensed under the MIT license*

Copyright (c) 2017 **_Rob McKenzie_**

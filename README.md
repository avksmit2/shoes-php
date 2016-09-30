# _Shoe Stores_

#### _An application that shows which stores have particular shoes, {September 30, 2016}_

#### By _**Angela Smith**_

## Description

_{This application allows a user to go to certain stores and see what brands of shoes they have, as well as look to see which stores have a particular brand. The user can add, delete or update a store's brands or a brand's stores. }_

## Specifications

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| Application will return the name of a store a user inputs | "Payless" | "Payless" |
| Application will return the names of multiple stores a user inputs | "Payless", "Famous Footwear" | "Payless", "Famous Footwear" |
| Application will return the updated name of a store a user inputs | "Payless", "Payless Shoesource" | "Payless Shoesource" |
| The user can delete all stores | "Payless", "Famous Footwear" | "" |
| Application will return the store a user has searched for | "Payless", "Famous Footwear" | "Payless" |
| Application will return the name of a brand a user inputs | "Nike" | "Nike" |
| Application will return the names of multiple brands a user inputs | "Nike", "Reebok" | "Nike", "Reebok" |
| Application will return the updated name of a brand a user inputs | "Nike", "Converse" | "Convers" |
| The user can delete all brands |  "Nike", "Reebok" | "" |
| Application will return the brand a user has searched for |  "Nike", "Reebok" | "Reebok" |
| Application will allow a user to add a store that carries a brand |  "Nike", "Payless" | "Payless" |
| Application will return all stores that carry a brand |  "Nike", "Payless", "Famous Footwear" | ["Payless", "Famous Footwear"] |
| User can delete a brand and all of the records of it in the stores |  "Nike", "Payless" | "" |
| Application will allow a user to add a brand that is in a store |  "Nike", "Payless" | "Nike" |
| Application will return all brands in a store |  "Nike", "Reebok", "Famous Footwear" | ["Nike", "Reebok"] |
| User can delete a store and all of the records of the brands carried in it |  "Nike", "Payless" | "" |


## Setup/Installation Requirements

* Clone the repository.
* Type in _"apachectl start"_ in the command line.
* Open a browser and navigate to _localhost:8080/phpmyadmin_, enter username: _"root"_ and password: _"root"_ if prompted.
* Go to the Import tab and under "File to import", browse computer to project file, select the zip file and press "Go".
* Using the command line, navigate to the project's root directory.
* Install dependencies by running _$composer install_.
* Navigate to the /web directory and start a local server with _$php -S localhost:8000_.
* Open a browser and go to the address http://localhost:8000 to view the application.

* If there is no file to import, type in the command line _"mysql.server start"_ and then _"mysql -uroot -proot"_.
* Type in _"CREATE DATABASE shoes;"_.
* Type in _"USE shoes;"_.
* Create the tables by typing in _"CREATE TABLE brands (id serial PRIMARY KEY, brand_name VARCHAR(255), price INT, available BOOLEAN);"_ and _"CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255));"_ and _"CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT)_.

## Known Bugs

_There are no known bugs at this time_

## Support and contact details

_Angela Smith: avksmit2@gmail.com_

## Technologies Used

_PHP,
mySQL,
Silex,
Twig,
PHPUnit,
Bootstrap,_

### License

*This webpage is licensed under the MIT license.*

Copyright (c) 2016 **_Angela Smith_**

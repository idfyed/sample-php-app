# Diglias Go PHP sample application
A PHP based web application implementing a integration with the Diglias GO service over the EAPI protocol to authenticate users using the Diglias Me digital ID.

## Disclaimer
This is by no means a fully fledged web application, it is only a example on how to communicate with the Diglias Go service to authenticate a user and retrieve user attributes. The application does not implement authorization at all. In a real world scenario the implementer would have to use the information retrieved from the Diglias system to authorize the user in the current context.

## Compatibility
Since the application is pure PHP it should be possible to run on any platform where PHP exists. It has been developed and tested on Mac OS X. 

## Dependencies
The application is depending on PHP 5.x and a web server on the hosting system and [*composer*](http://getcomposer.org) to manage dependencies and autoloading.  

## Installation
Clone the repository in your preferred location.

In the root of the repository run `composer install` to download project dependencies.

## Usage

### Starting the application
The directory `public/` should be mapped to the root directory of your PHP enabled web server.

### Running the application
1. Point your browser to the root directory of your local web server. 
2. Click the button **Authenticate**. Your browser should now get redirected to the Diglias server that will render a QR code on the screen.
3. Use your Diglias Me id to authenticate yourself to the Diglias system.
4. If the authentication is successful you will be directed back to the application where all the supplied user properties will be rendered on a page.

## Running in Docker

If you prefer, you can run the application in a docker container. In that case it will not be necessary to install PHP or a web server on you local system.

### Build and Run with Docker Compose
If you have `docker-compose` available you can build and run in one command. Change to the root of the repository and issue `docker-compose up`.

To access the application point your browser to `http://[IP OF DOCKER HOST]:8080`. You can find out the IP of the docker host using `docker-machine ip`.

## Application Structure

The application in it self if a fairly straight forward PHP application.

From a Diglias integration point of view there are really two source files that is of interest:

*  `public/authenticate/index.php` - This is where the authentication transaction is initiated by preparing a url and redirecting the user to the Diglias GO server.
*  `src/DigliasRelyingParty.php` and `src/DigliasEndpoint.php` - A set of constants and functions implementing parts of the EAPI protocoll.


## Contact and Feedback
Any questions, or feedback on the code or Diglias in general?

jona(a)diglias.com

Copyright (c) 2016 Diglias AB

Author: Jonas
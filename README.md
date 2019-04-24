# Diglias Go PHP sample application

A PHP based web application implementing an integration with the
Diglias GO service to authenticate users using the Diglias Me digital
ID. Even though this example focuses on using the
Diglias Me Digital ID, implementations that use alternate ID:s such as
Bank ID or Telia will be very similar and the authentication example is relevant in
those cases as well.

## Disclaimer

This is by no means a fully-fledged web application, it is only a
example on how to communicate with the Diglias Go service to
authenticate a user and retrieve user attributes. The application does
not implement authorization at all. In a real world scenario the
implementer would have to use the information retrieved from the Diglias
system to authorize the user in the application context.

## Compatibility
Since the application is pure PHP it should be possible to run on any platform where PHP exists. It has been developed
and tested on Mac OS X.

## Dependencies
The application is depending on PHP 5.x and a web server on the hosting system and [*composer*](http://getcomposer.org)
to manage dependencies and autoloading.  

## Installation

In the root of the project run `composer install` to download project dependencies.

## Usage

### Starting the application

To run the application with the [PHP Built-in web server](http://php.net/manual/en/features.commandline.webserver.php)
issue the following command in the root of the project:

$ `php -S localhost:8123 -t public`

For security reasons the relying party configuration used in the code will only accept requests
originating from `http(s)://localhost*`.

### Running the application
Point your browser to [http://localhost:8123](). The sample includes
3 main scenarios:

#### Authenticate

Demonstrates authentication of a user either by requesting a default
set of attribute or by selecting a subset of attributes to request.
Once the authentication has been successfully completed, it is possible
to add a value to the user's Diglias using the backend RP Management API.

#### Web Flow Connect

This flow shows how to add a attribute to the user's Diglias profile as
part of a normal authentication flow.

#### App Initiated

A sample of how to implement App initiated flow where the user's journey
starts by scanning a static QR code and ends up authenticated with a
web page rendered in the user's web browser or web view in the Diglias
app.

## Running in Docker

If you prefer, you can run the application in a docker container. In that case it will not be necessary to install PHP
nor a web server on you local system.

### Build and Run with Docker Compose

If you have `docker-compose` available you can build and run in one command. Change to the root of the repository and
issue `docker-compose up`.

To access the application point your browser to `http://localhost:8080`.

## Application Structure

The application in it self if a fairly straight forward PHP application based using [Handlebars](http://handlebarsjs.com/)
as a templating engine for rendering HTML.

The code related to Diglias is located as follows:

* `/public/*` - URL Handlers implementing the application logics where communication with the Diglias GO service is
defined.

* `src/Diglias/*` - Wrapper/Helper classes aiding in the communication with Diglias implementing low level integration
functionality.


* `config/config.php` - Defines a number of global variables containing configuration data related to the integration
with the Diglias Go service.

## Contact and Feedback

Any questions, or feedback on the code or Diglias in general?

playground@idfyed.com

Copyright (c) 2019 IDFyed Solutions AB

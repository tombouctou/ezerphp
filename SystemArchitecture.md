# The ezer-php system architecture #

## Overview ##

The server run a continuous php process that could be started manually or by system crontab.
The process never dies and spawn child processes if needed.

## Components ##

The system combined of the following components:
### Engine ###
  * Threads - base server implementation for multiple php processes.
  * Sockets - base sockets server implementation based on the threads server.
  * Business process server
    * Loads the process logic.
    * Loads the process cases.
    * Executes the cases according to the logic, synchronously or asynchronously according to the step type.
  * Data model
    * Logic - represents the business behavior that should be executed.
    * Case - represents a single occurrence of the business logic, usually accompanied with specific case data.
### Persistence ###
Both logic and cases data models are persisted using one of the two persistence modules.
Note that only one of them is required.
  * Propel - persists the data model in DB, using propel ORM.
  * XML - persists the data model in XML files.
### Utilities ###
  * Cache - caches php classes location.
  * Config - loads configuration from XML files.
  * Logger - logs code messages.
### Examples ###
Code examples for using the ezer system as simple multi-threaded server,
sockets server, business process server, using the XML or the Propel persistence modules.
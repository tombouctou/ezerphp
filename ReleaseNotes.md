# PHP Ezer Process manager - Version 1.1.4 #

## CONTENTS ##
  1. [Product Description](#Product_Description.md)
  1. [System Requirements](#System_Requirements.md)
  1. [How to use](#How_to_use.md)
  1. [Contact](#Contact.md)


---


## Product Description ##
These classes offers few different functionalities, seperatly or together,
all of them offering important modules on the way to well orgenized PHP application server.
  * Configuration tool
  * System Process management
  * Sockets and clients management
  * Business Process managemt

### Since 1.0.1 ###
  * Support for asyncronous activity steps

### Since 1.0.2 ###
  * Support for if/else/ifelse flows

### Since 1.0.3 ###
  * Support complex variable types

### Since 1.0.4 ###
  * Support for concurrent flow

### Since 1.0.5 ###
  * Support for BPEL like xml

### Since 1.1.0 ###
  * Support DB persistence over propel ORM

### Since 1.1.1 ###
  * Support XML persistence for process instances

### Since 1.1.2 ###
  * Support DB persistence for process instances

### Since 1.1.3 ###
  * Full DB Support

### Since 1.1.4 ###
  * Foreach Support


I tried to supply an extendable core framework with simple examples.


---


## System Requirements ##
All you need is love and PHP 5.x


---


## How to use ##
You can find usage examples in the examples folder.
All test.php files should be running using CLI.

### Config example ###
Demonstrate the config lib usage, simply var\_dumping the Ezer\_Config object, containing all the data in the XML.
Try to modify the XML and see the resulted dump.

### Thread server example ###
Demonstrate the multi process application server usage.
ThreadCountServer – extends the base Ezer\_ThreadServer and supply simple array of tasks.
ThreadCountClient – extends the base Ezer\_ThreadClient and supply printing functionality that reports the child process output.
ThreadCountHandler – extends the base Ezer\_Process and just counting numbers according to the supplied number, to demonstrate some PHP logic.

### Sockets server example ###
Exactly like the thread server example, but opens a listening socket on port 1500.
Try to connect the server using “telnet your.host.address 1500” / “telnet localhost 1500”.
The server write its output to the client sockets.

### Synchronous Process ###
The config xml should contain the path to your PHP executable.
The logic path should point to the folder where you save your pbp (php business process) files that loaded to the BPM server memory.
The cases path should point to the folder where you save your pbc (php business case) files.
The server scans the cases folder periodically and executes the case according to the business logic.
In the activities folder you can find a simple php activity example that simply prints all the variables it gets.

I added the testMake.php for your convenience, it’s just rename all the files in cases folder from **.arc to**.pbc.
The server renames the case files after loading them into archive files, changing them back to **.pbc files will cause the server to load them again as new cases.**

### Asynchronous Process ###
Just like the synchronous process example, only the activity class extends Ezer\_AsynchronousActivity, it means that the server won’t execute it by himself, but will aggregate the task to one of its child processes.

### If process ###
Just like the synchronous process example, only the business logic demonstrate the usage of if, else and elseif flows.
You can run all the cases concurrently or one by one.

### Complex vars ###
Demonstrate how to define complex type, how to set a part of a variable, and how to set a part in each part of array.
Additional process example added, called "Async Set", shows how to set a variable value remotely from an asynchronous activity step.

### Flow process ###
Demonstrate how to define concurrent execution of few steps.

### Foreach process ###
Demonstrate how to define foreach flows, serial or parallel.

### Propel process ###
Demonstrate how to save process definitions and case definitions in mySql DB over propel ORM.


---


## Contact ##
Please send your suggestions, bug reports and general feedback to [johnathan.kanarek@gmail.com](mailto:johnathan.kanarek@gmail.com)


Enjoy,
Tan-Tan
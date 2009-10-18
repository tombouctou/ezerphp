       ___________________________________________________________

                   PHP Ezer Process manager - Version 1.0.3
                               October 2009
       ___________________________________________________________

                   Copyright (c) 2009 Johnathan Kanarek (Tan-Tan)

_______________________

CONTENTS
_______________________

1. Description
2. System Requirements
3. How to use
4. Contact

_______________________

1. Product Description
_______________________

These classes offers few different functionalities, seperatly or together, 
all of them offering important modules on the way to well orgenized PHP application server.
 - Configuration tool
 - System Process management
 - Sockets and clients management
 - Business Process managemt

Since 1.0.1
 - Support for asyncronous activity steps

Since 1.0.2
 - Support for if/else/ifelse flows

Since 1.0.3
 - Support complex variable types

I tried to supply an extendable core framework with simple examples.

_______________________

2. System Requirements
_______________________

All you need is love and PHP 5.x

______________

3. How to use
______________

You can find usage examples in the examples folder.
All test.php files should be running using CLI.

3.1 Config example
Demonstrate the config lib usage, simply var_dumping the Ezer_Config object, containing all the data in the XML.
Try to modify the XML and see the resulted dump.

3.2  Thread server example
Demonstrate the multi process application server usage.
ThreadCountServer – extends the base Ezer_ThreadServer and supply simple array of tasks.
ThreadCountClient – extends the base Ezer_ThreadClient and supply printing functionality that reports the child process output.
ThreadCountHandler – extends the base Ezer_Process and just counting numbers according to the supplied number, to demonstrate some PHP logic.

3.2 Sockets server example
Exactly like the thread server example, but opens a listening socket on port 1500.
Try to connect the server using “telnet your.host.address 1500” / “telnet localhost 1500”.
The server write its output to the client sockets.

3.3 Synchronous Process
The config xml should contain the path to your PHP executable.
The logic path should point to the folder where you save your pbp (php business process) files that loaded to the BPM server memory.
The cases path should point to the folder where you save your pbc (php business case) files.
The server scans the cases folder periodically and executes the case according to the business logic.
In the activities folder you can find a simple php activity example that simply prints all the variables it gets.

I added the testMake.php for your convenience, it’s just rename all the files in cases folder from *.arc to *.pbc.
The server renames the case files after loading them into archive files, changing them back to *.pbc files will cause the server to load them again as new cases.

3.4 Asynchronous Process
Just like the synchronous process example, only the activity class extends Ezer_AsynchronousActivity, it means that the server won’t execute it by himself, but will aggregate the task to one of its child processes.

3.5 If process
Just like the synchronous process example, only the business logic demonstrate the usage of if, else and elseif flows.
You can run all the cases concurrently or one by one.


______________

4. Contact
______________

Please send your suggestions, bug reports and general feedback to tan-tan@simple.co.il


Enjoy.
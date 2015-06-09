# About the code #

Full phpdoc documentation could be viewed [here](http://ezerphp.sourceforge.net/index.html).


## config ##
Offers base functionality to load XML configuration files into PHP class.

## controller ##
Will contain a process control panel code.

## designer ##
Will contain a process logic designer code.

## engine ##
Contains the engine hart

### core ###
  * threads - base multi-process server.
  * sockets - base sockets server.

### process ###
Contains the code for PHP business process management.
  * logic - code for loading business process definitions to the server memory.
  * logic xml - loads business process from BPEL like xml.
  * case - code for loading and executing business case.

## examples ##
Contains working simple and basic examples
  * config - var\_dumping XMLconfiguration as PHP class.
  * threadsServer - simple multi-process server.
  * socketsServer - simple sockets server.

Process Examples
  1. syncProcess - simple process that demonstrate simple synchronous workflow.
  1. asyncProcess - simple process that demonstrate simple asynchronous workflow.
  1. ifProcess - process that demonstrate if, else and else if workflows.
  1. complexVarsProcess - process that demonstrate complex variables usage.
  1. flowProcess - process that demonstrate concurrent flow workflow.
  1. foreachProcess - demonstrates usage of foreach flow, serial or parallel.
  1. propelProcess - the process definition and the case are loaded from mySql DB using propel ORM.
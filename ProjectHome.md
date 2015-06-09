# PHP Business Process Management and Automation #

The Ezer project attempts to offer PHP developrs the abilities of BPM, business process management and process workflow automation.

So far, we can offer the following functionalities.

### Done: ###
  1. Configuration management - parses any xml file into php class object.
  1. System process management - fork your tasks into several working processes.
  1. Sockets management - enables sockets client to connect the server in order to enable remote command and control, or scalability between few servers.
  1. Business process management.
  1. XML (BPEL like) process and case persistence.
  1. DB (mySql over Propel ORM) process and case persistence.
  1. Support complex variable types.
  1. Asynchronous activities.
  1. Supported step types:
    * PHP
    * Assign
  1. Supported flow types:
    * Sequence
    * Scope
    * If
      * Else
      * ElseIf
    * Flow (concurrent execution of few tasks in the same process).
    * Foreach - parallel or serial.

Currently process design user interface is in the oven.

### TODOs: ###
  1. Support more flow types:
    * While
    * RepeatUntil
    * Switch
  1. Support more step types:
    * Empty
    * Wait
    * Terminate
    * Throw
    * Rethrow
  1. Support XML data type.
  1. Add load balancing according to the following resources
    * DB
    * Network
    * File system
    * CPU
  1. Support BPEL.
    * WSDL
    * More step types:
      * Invoke
      * Pick
      * Receive
      * Reply
      * Compensate
      * CompensateScope
      * Validate
      * OpaqueActivity
  1. Add jquery proccess designer.
  1. Add control panel (maybe flex or jquery).
  1. Add support for BAM systems.

Looked like a lot of work, will be happy for some help.

---


If you liked it, hated it, want to join and help, or any other feedback, please contact me, [johnathan.kanarek@gmail.com](mailto:johnathan.kanarek@gmail.com).

### Additional support ###
  * [EzerPHP System Architecture](http://code.google.com/p/ezerphp/wiki/SystemArchitecture)
  * [How to install EzerPHP](http://code.google.com/p/ezerphp/wiki/Installation)
  * [Understanding the code](http://code.google.com/p/ezerphp/wiki/TheCode)
  * [PHP Documentation](http://ezerphp.sourceforge.net)
  * [Report a bug](http://sourceforge.net/tracker/?func=add&group_id=283834&atid=1203473)
  * [Request for support](http://sourceforge.net/tracker/?func=add&group_id=283834&atid=1203474)
  * [Request for feature](http://sourceforge.net/tracker/?func=add&group_id=283834&atid=1203476)
  * [Help forum](http://sourceforge.net/projects/ezerphp/forums/forum/1027301)
  * [Versions release notes](http://code.google.com/p/ezerphp/wiki/ReleaseNotes)

Tan-Tan
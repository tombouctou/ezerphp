# Installation instructions #

## Get the code ##
You can download the code using the [downloads page](http://code.google.com/p/ezerphp/downloads/list), or you can check it out using the instructions in the [source page](http://code.google.com/p/ezerphp/source/checkout).

## Install the code ##
Once you have the code, just throw it under any folder you choose, e.g. C:\My\Ezer\Server or /opt/ezer/server.

## Configuring the server ##
  1. Create your own application folder need the server folder we created already, e.g. C:\My\Ezer\App or /opt/ezer/app.
  1. Copy the content of one of the examples from the examples folder to your application folder, e.g.
    * xcopy /Y /S /R C:\My\Ezer\Server\examples\syncProcess1\`*` C:\My\Ezer\App
    * rsync -avC /opt/ezer/server/examples/syncProcess1/ /opt/ezer/app
  1. Edit the bootstrap.php to verify that the require\_once statement is pointing to the correct path of engine/infra/Ezer\_Autoloader.php file.
  1. Make sure that the Ezer\_Autoloader::setClassMapFilePath is pointing to existing folder.
  1. Create XML configuration file:
    * For **XML** persistence:
> > 

&lt;config&gt;


> > > 

&lt;phpExe&gt;


> > > > C:\xampp\php\php.exe // path to the php exec

> > > 

&lt;/phpExe&gt;


> > > 

&lt;logicPath&gt;


> > > > logic // path (could be relative) to the folder where the logic XML files are saved.

> > > 

&lt;/logicPath&gt;


> > > 

&lt;instancePath&gt;


> > > > instance // path (could be relative) to the folder where the case results XML files are saved.

> > > 

&lt;/instancePath&gt;


> > > 

&lt;casesPath&gt;


> > > > cases // path (could be relative) to the folder where the case XML files are saved.

> > > 

&lt;/casesPath&gt;



> > 

&lt;/config&gt;


    * For **Propel** (DB) persistence:
> > 

&lt;config&gt;


> > > 

&lt;phpExe&gt;

C:\xampp\php\php.exe

&lt;/phpExe&gt;


> > > 

&lt;database&gt;


> > > > 

&lt;datasources default="ezer"&gt;


> > > > > 

&lt;ezer adapter="mysql"&gt;


> > > > > > <connection phptype="mysql" database="ezer" hostspec="localhost"
> > > > > > > user="root" password="root"
> > > > > > > dsn="mysql:host=localhost;dbname=ezer;user=root;password=root;" />

> > > > > 

&lt;/ezer&gt;


> > > > > 

&lt;log ident="ezer" level="7" /&gt;



> > > > 

&lt;/datasources&gt;



> > > 

&lt;/database&gt;



> > 

&lt;/config&gt;


  1. Create run.php script that includes:
    * ini\_set('max\_execution\_time', 0); // Enable the script to run forever.
    * require\_once 'bootstrap.php'; // Loads the classes auto loader
    * $config = Ezer\_Config::createFromPath('config.xml'); // Loads the configuration file
    * $server = new Ezer\_BusinessProcessServer(...); // Instantiate new server
    * $server->addCasePersistance(...);
    * $server->run();
  1. Run the server from command line:
**php run.php**
TitaniumPHP is a simple PHP console environment meant to run 
within your project context.

A FEW THINGS YOU CAN DO WITH TITANIUM:

- Testing code
- Running cron jobs
- Creating custom management plugins and functions
- Manage your code 
- Testing environments
- Accessible command line scripting
- Testing databases
- Debugging performance issues
- Reflection
- etc.

CREATING A USER DEFINED FUNCTION:

User defined functions are the backbone of Titanium, we've left it up 
to you to decide and build the functions you need.

To create a function, open up the <titanium>/functions directory and 
duplicate the fn.help.php file and rename to what ever you want(no spaces).
This will give you a function template to start from.

Open your new file and look for: //p- %^help$%i

This is a regex pattern that gets used by the console to determine
what function to run. When Titanium loads up, it looks for these 
patterns and cache's them internally. 

Any named matching groups will be passed as paramenters to the 
function.

Change the 'help' part to anything you want to use to access 
your function from the command line.

Next, look for fn_help($q, $matches, $post). Replace 'help' with the same 
name you used for your command pattern, remember to replace spaces with 
underscores. 

TO GET STARTED:

- cd <titanium_directory>
- chmod a+x shell.php
- php shell.php
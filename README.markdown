TitaniumPHP is a flexible PHP console environment intended to run within your project context - similar to Django's built in shell utility.

[<img src="http://wixel.net/fshare/titanium.png">]

#  Things you can do with TitaniumPHP

- Test code
- Run cron jobs
- Database versioning
- Create custom functions
- Manage your code 
- Test environments
- Create command line apps with ease
- Test databases
- Debug performance issues
- Reflection
- etc.

# Getting started

1. Download Titanium
2. Unzip it and copy the directory into your PHP project directory root.

Then open your terminal and do the following: 

<pre>
> cd [titanium_directory]
> chmod a+x shell.php
> php shell.php
OR
> ./shell.php with chmod a+x permissions
OR 
./shell.php [command] [param1] [param2] [param3]...etc
</pre>

Titanium allows you to include your project files and interact with your code via the command line 
and Titanium custom functions.

#  Creating custom functions

User defined functions are the backbone of Titanium, we've left it up 
to you to decide and build the functions you need.

Functions can be thought of as plugins that extend the base functionality
of Titanium.

To create your own function, open up the `<titanium>/functions` directory and 
duplicate the `fn.help.php` file and rename to what ever you want __(no spaces)__.
This will give you a simple function template to start from.

Open your new file and look for: `//p- %^help$%i`

This is a regular expression that's used by the console to determine
what function to run. When Titanium loads, it looks for  
patterns and cache's them internally. 

Any named matching groups will be passed as parameters to your  
custom function.

Change the _'help'_ part to anything you want to use to access 
your function from the TitaniumPHP command line.

Next, look for `fn_help($q, $matches, $params)`. Replace _'help'_ with the same 
name you used for your command pattern, remember to replace spaces with 
underscores. 

Titanium uses static methods internally, this means that you can use 
any of the core methods inside your custom functions. 

<pre>
	
- Output::write($text, $color = "normal", $newline = false, $newlinecount = 1);
- Template::render($filename, $data = NULL);

</pre>

Your custom function files should look like the following:

<pre>
	
// Filename: fn.test.php	

//p- %^test$%i

/**
 * Test template
 *
 * @param string $q
 * @param array $matches
 * @param array $params
 */
 function fn_test($q, $matches, $params) 
 {
	// Put your code here. 
 }

</pre>

#  Creating custom function templates

If you need your custom functions to output formatted data to the command line, you can create 
a custom template in `<titanium>/templates/functions/`.

Titanium uses the Savant3 template engine to render output, so familiarize 
yourself with it - [Savant3](http://phpsavant.com/ "Savant3")

You output your template content to the CLI using:

<pre>

Output::write(Template::render('functions/[your template name].tpl.php'), false, true);

</pre>

You can assigned variables and other data to use in your template by adding a 
second parameter to the static render() method, like this:

<pre>

$data = array(
 'name'    => 'Sean Nieuwoudt',
 'company' => 'Wixel.net',
 'other'   => array(1,2,4,5,6,7)
);

Output::write(Template::render('functions/[your template name].tpl.php', $data), false, true);

</pre>

#  TODO

* Add config loader for user created config files
* Core database classes supporting Postgresql, MySQL, SQLite
* Ability to use config tokens in function names & arguments
* Replace static help.tpl.php with dynamically generated content
* Add events & event hooks to the framework
* Custom function to list all available configs & values
* Add HTTP API specific testing core class and interacting with HTTP based services
* Logger class with multiple writers
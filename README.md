# tFramework and conversion analytics


=======
IMPORTANT

All changes are never updated to the master branch, but to the development branch. New final changes are committed to master via a pull request. If you are working on a spesific feature a new branch is created for that feature. Please test your implementation before committing to development. 

Installation instructions (assumes certain folder structures, you may change if you dare :) )

1) First you need to install latest XAMPP with php 7 support (recommended). https://www.apachefriends.org/index.html . 
Install xampp to c:/newxampp (highly recommended)
Confirm everything is working with xampp in the provided command panel
Remove the index file at /htdocs 

( 2) OPTIONAL: Install node.js https://nodejs.org/en/ to c:/nodejs follow the installation instructions in node.js website.  You can choose the latest version. https://docs.npmjs.com/getting-started/installing-node. Development has been done using Node.js v7.9.0. Install node to c:/nodejs (not in program files). Create a folder /app in the nodejs folder. )

3) Install github desktop https://desktop.github.com/ . Clone this repo to to: C:\githubProjects\tFramework. Then if you are using windows (7,8 or 10) run unpack.bat to copy the framework and htdocs to the correct folders.

4) Create database in mysql from database files. 

5) generate a new project in console by setting: php console.php build projectName host dbName dbUser dbPassword . For updating set update as second parameter instead of build. 
   (note that generated schemas exists already). To use your particular app set SITE in boostrap to the correct one. 

You can use bat files if you wish or simply copy framework apps etc manually. 

Note:
htdocs folder: newxampp/htdocs (or whatever you have set)
framework folder: newxampp/framework
apps folder: newxampp/apps

If you wish to test out APCu cache you need to enable it in php ini with opcache for instance (opcache refresh is set to 1): 

[apcu]
apc.enabled=1
apc.shm_size=32M
apc.ttl=7200
apc.enable_cli=1
apc.serializer=php

[opcache]
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=1
opcache.validate_timestamps=1
opcache.fast_shutdown=1
opcache.enable_cli=1



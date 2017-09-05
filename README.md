# tFramework and conversion analytics

IMPORTANT
All changes are never updated to the master branch, but to the development branch. New final changes are committed to master via a pull request. If you are working on a spesific feature a new branch is created for that feature. 

Installation instructions (assumes certain folder structures, you may change if you dare :) )

1) First you need to install xampp (recommended). https://www.apachefriends.org/index.html . You can use the latest version (with php7)
Install xampp to c:/xampp (highly recommended)
Confirm everything is working with xampp in the provided command panel
Remove the index file at /htdocs 

2) Install node.js https://nodejs.org/en/ to c:/nodejs follow the installation instructions in node.js website.  You can choose the latest version. https://docs.npmjs.com/getting-started/installing-node. Development has been done using Node.js v7.9.0. Install node to c:/nodejs (not in program files). Create a folder /app in the nodejs folder.

3) Install github desktop https://desktop.github.com/ . Clone this repo to to: C:\githubProjects\tFramework. Then if you are using windows (7,8 or 10) run unpack.bat to copy the framework and htdocs to the correct folders.

4) Edit the C:\xampp\framework\config\config.php and set the correct port, username and password (defaults are port: 3306 , user: root, password: "")

5) Create new databases: tt_analytics , product_analytics and tt_analytics in mysql . Upload the sql tables in utf8_unicode_ci (or you can choose other utf-8 as long as you set all the tables correctly)

6) Install expessjs https://expressjs.com/en/starter/installing.html in the app folder. Use npm init --yes. Run npm install express --save 

7) Edit the mysql settings in server.js in nodejs/app folder

8) Hit localhost in browser. You can use developer tools to see the calls and console messages. calls to nodejs server should fail. 

9) Run express app in CMD (admin) in folder /nodejs/app with npm start , The server should now start. refresh localhost page using ctrl + r

Using .bat files
You can use the bat files in the htdocs, nodejs and famework folders to upload changes to your single github repo. or use the update.bat file




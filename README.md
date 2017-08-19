# tFramework
tFramework

Installation instructions

1) First you need to install xampp (recommended). https://www.apachefriends.org/index.html . You can use the latest version
Save the xampp installation to c:/xampp (highly recommended)
Confirm everything is working with xampp in the provided command panel
Remove the index file at /htdocs 

2) Install node.js https://nodejs.org/en/ to c:/nodejs follow the installation instructions in node.js website, development has been done using 6.11.2 LTS so that is the recommended version. Create folder /app in the node.js folder

3) If you are using windows (7,8 or 10) run unpack.bat to copy the framework and htdocs to the correct folders.

4) Edit the C:\xampp\framework\config\config.php and set the correct port, username and password (defaults are port: 3306 , user: root, password: "")

5) Create new databases: tt_analytics , product_analytics and tt_analytics in mysql . Upload the sql tables in utf8_unicode_ci (or you can choose other utf-8 as long as you set all the tables correctly)

6) Install expessjs https://expressjs.com/en/starter/installing.html in the app folder. Use npm init --yes. Run npm install express --save 

7) Edit the mysql settings in server.js 

8) Hit localhost in browser . Check that script loader is not blocking. 

9) run express app in CMD (admin) in folder /nodejs/app with npm start , The server should now start

Pending improvements
- Loader aLoader will undergo some changes and improvements. 

Using .bat files
You can use the bat files in the htdocs, nodejs and famework folders to upload changes to your single github repo. 








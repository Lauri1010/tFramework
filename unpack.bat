@echo off 
robocopy C:\githubProjects\tFramework C:\xampp\framework /zb /e /s /copyall /XD C:\githubProjects\tFramework\htdocs /XD C:\githubProjects\tFramework\nodejs
robocopy C:\githubProjects\tFramework\nodejs\app C:\nodejs\app /zb /e /s /copyall
robocopy C:\githubProjects\tFramework\htdocs C:\xampp\htdocs /zb /e /s /copyall 
pause
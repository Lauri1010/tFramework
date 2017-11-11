@echo off
robocopy C:\githubProjects\tFramework C:\newxampp\framework /zb /e /s /copyall /XD C:\githubProjects\tFramework\htdocs /XD C:\githubProjects\tFramework\nodejs /XD C:\githubProjects\tFramework\apps
robocopy C:\githubProjects\tFramework\apps C:\newxampp\framework /zb /e /s /copyall /XD C:\githubProjects\tFramework\apps
robocopy C:\githubProjects\tFramework\nodejs\app C:\nodejs\app /zb /e /s /copyall 
pause
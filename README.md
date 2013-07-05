# The 3rd TTUPC Print Service

大同大學程式設計競賽 (TTUPC, Tatung University Programming Contest) 

[Contest Web Page](https://sites.google.com/site/ttucsc/programming_competition_3rd)

Contest provide contestant use this web service print there source code to debug.

## How to deploy

This project base on LAMP(Linux, Apache, MySQL, PHP).

1.  Import `ContestResult_printService_Backup.sql` into your MySQL database, and change the contest data to yours.
    * Setting team infomation at table `team`.
  
2.  setting up MySQL user and password.
    * at `print/include/config.php` and `printadmin/include/config.php`

    **Attention!! DO NOT Create user and set password same as the config file**

3.  Setting contestant's computer IP
    * use each contestant's computer open web page `http:[server_ip]/printadmin/setteam.php`, enter team number then continue, server will auto save this computer IP.

4.  Create the upload folder
    * Default upload folder at `/upload`, create the folder as same path.

5.  Prepare another Windows computer as the print server.
    * **require ls, ssh, rsync, ab**
    * **Setup ssh auto login**
    * setting your server info in `getfile.bat` and `auto_print.c`
    * compile `auto_print.c` and run it.


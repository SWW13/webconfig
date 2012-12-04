webconfig - PHP mailserver configuration
=========

webconfig is a webinterace to manage domains, users and forwardings of a mailserver with the following setup:
http://wiki.freakempire.de/doku.php/linux/virtueller_e-mail_server_unter_debian_etch_und_postfix

There is an similar webserver setup description in english which should also work:
http://www.howtoforge.com/virtual-users-domains-postfix-courier-mysql-squirrelmail-debian-lenny


webconfig extends the database with some primary keys and an admin table for the domain administrators.
You can use the cake shell to update the database to the webconfig schema using 'cake schema create' and 'cake schema update'.

After that you have to copy the config files in 'app/config':
core.php.default to core.php and set the path to your virtual vmail home folder 'vmail_dir'.
database.php.default to database.php and setup the database connection.
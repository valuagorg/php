#!/bin/sh

rm -rf /home/ec2-user/temprepo
cd "/home/ec2-user" &&  git clone https://github.com/valuagorg/php.git /home/ec2-user/temprepo
cd "/home/ec2-user/temprepo" && grep -rl localhost/wordpress_byg . | xargs sed -i 's#localhost/wordpress_byg/#3.145.147.1/#g'

echo -e '<?php\n//Connecting to DB\n$conn=mysqli_connect("valuag-1.c3eyserr5izf.us-east-1.rds.amazonaws.com","AdminUsernameJim","jimistheadmin123!","byg");' > /home/ec2-user/temprepo/add/conn.php

rm -rf /var/backups/twentytwentyone/twentytwentyone
mv /var/www/html/byg/wp-content/themes/twentytwentyone /var/backups/twentytwentyone
mv /home/ec2-user/temprepo  /var/www/html/byg/wp-content/themes/twentytwentyone


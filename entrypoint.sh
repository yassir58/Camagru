#!/bin/bash

set -e

echo 'variables: ' $MYSQL_DATABASE $MYSQL_HOST $MYSQL_PASSWORD

mysqld --user=mysql --datadir=/var/lib/mysql
# wait

# # Wait for MySQL to be ready
# until mysql -h"$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e ";" &> /dev/null; do
#     >&2 echo "MySQL is unavailable - sleeping"
#     sleep 1
# done

# >&2 echo "MySQL is up - executing SQL script"
# mysql  -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /create_tables.sql

# >&2 echo "SQL script executed successfully"


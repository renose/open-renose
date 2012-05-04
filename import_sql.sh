mysql --user=renose --password=dev -e "DROP DATABASE renose"
mysql --user=renose --password=dev -e "CREATE DATABASE renose"
mysql --user=renose --password=dev --database=renose --default-character-set=utf8 < renose_dev.sql
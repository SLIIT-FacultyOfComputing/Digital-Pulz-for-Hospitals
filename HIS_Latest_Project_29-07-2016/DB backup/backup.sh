#!/bin/sh
DAY=`date +%Y-%m-%d_%H%M%S`
STORE="E:/autobackup"

mysqldump -u root HIS > $STORE/his_backup_$DAY.sql


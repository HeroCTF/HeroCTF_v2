#!/usr/bin/env bash
echo "Creating mongo users..."
mongo admin --host localhost -u root -p p4ssw0rd --eval "db.createUser({user: 'root', pwd: 'p4ssw0rd', roles: [{role: 'readWrite', db: 'admin'}]});"
echo "Mongo users created."

#!/usr/bin/env bash

cd $PWD/others/

echo "=> Stopping dockers"
docker-compose down
echo "=> Starting dockers"
docker-compose up -d --build


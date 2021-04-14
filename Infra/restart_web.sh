#!/usr/bin/env bash

cd $PWD/web/

echo "=> Stopping dockers"
docker-compose down
echo "=> Starting dockers"
docker-compose up -d --build

docker exec -dit web_xss1_1 /bin/bash -c "/entry.sh"
docker exec -dit web_xss2_1 /bin/bash -c "/entry.sh"

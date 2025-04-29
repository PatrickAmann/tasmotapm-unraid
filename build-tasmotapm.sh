#!/bin/bash
docker build -t tasmotapm-ng-builder .
docker run --rm -v .:/workdir tasmotapm-ng-builder
docker image rm tasmotapm-ng-builder:latest -f

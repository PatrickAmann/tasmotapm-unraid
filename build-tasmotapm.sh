#!/bin/bash
docker build -t tasmotapm-builder .
docker run --rm -v .:/workdir tasmotapm-builder
docker image rm tasmotapm-builder:latest -f

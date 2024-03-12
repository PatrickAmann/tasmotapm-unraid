FROM aclemons/slackware:latest
COPY src/mkpkg.sh /workdir/src/mkpkg.sh
WORKDIR /workdir/src
ENTRYPOINT ["./mkpkg.sh", "tasmotapm"]

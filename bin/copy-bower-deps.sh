#!/usr/bin/env bash

ASSETSDIR="$(dirname $0)/../assets/"

if [ ! -d "$ASSETSDIR" ]; then
    echo "> assets directory '$ASSETSDIR' not found !" >&2
    exit 1
fi

cd "$ASSETSDIR"

# bootstrap
rsync -avzh bootstrap/dist/ .
# font awesome
cp -vrf font-awesome/css/* ./css/
cp -vrf font-awesome/fonts/* ./fonts/
# HTML5shiv
cp -vf html5shiv/dist/html5shiv.js ./js/
cp -vf html5shiv/dist/html5shiv.min.js ./js/
# IE10 viewport workaround
cp -vf ie10-viewport-bug-workaround/dist/ie10-viewport-bug-workaround.js ./js/
cp -vf ie10-viewport-bug-workaround/dist/ie10-viewport-bug-workaround.min.js ./js/
cp -vf ie10-viewport-bug-workaround/dist/ie10-viewport-bug-workaround.css ./css/
cp -vf ie10-viewport-bug-workaround/dist/ie10-viewport-bug-workaround.min.css ./css/
# RespondJS
cp -vf respond/dest/respond.src.js ./js/
cp -vf respond/dest/respond.min.js ./js/


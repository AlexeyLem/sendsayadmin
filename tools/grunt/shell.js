module.exports = {
    build: {
        command: 'rm -rf ./build && node ./node_modules/requirejs/bin/r.js -o ./tools/buildConfig.js && ln -snf ./build/ public'
    },
    dev: {
        command: 'ln -snf ./app/ public'
    }
};
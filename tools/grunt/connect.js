var rewrite = require('connect-modrewrite');

module.exports = {
    server: {
        options: {
            port: 8080,
            base: 'public',
            keepalive: true,
            middleware: function (connect, options, middlewares) {
                middlewares.unshift(rewrite(['!\\.html|\\.swf|\\.eot|\\.woff|\\.ttf|\\.js|\\.ejs|\\.css|\\.svg|\\.jp(e?)g|\\.png|\\.gif$ /index.html']));
                return middlewares;
            }
        }
    }
};
module.exports = {
    blocks: {
        files: [{
            expand: true,
            src: [
                './app/blocks/**/*.less',
                './app/kit/**/*.less',
                './app/common.less'
            ],
            ext: '.css',
            extDot: 'last'
        }]
    }
};
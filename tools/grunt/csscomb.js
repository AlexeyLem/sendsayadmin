module.exports = {
    options: {
        config: './.csscomb.json'
    },
    dynamic_mappings: {
        expand: true,
        src: [
            './app/blocks/**/*.less',
            './app/kit/**/*.less',
            './app/*.less'
        ]
    }
};
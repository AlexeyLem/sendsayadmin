module.exports = function (grunt) {

    grunt.loadNpmTasks('grunt-shell');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-connect');
    grunt.loadNpmTasks('grunt-newer');
    grunt.loadNpmTasks('grunt-csscomb');

    grunt.config.init({
        shell: require('./tools/grunt/shell'),
        less: require('./tools/grunt/less'),
        connect: require('./tools/grunt/connect'),
        csscomb: require('./tools/grunt/csscomb')
    });

    require('./tools/gruntTasks')(grunt);
};
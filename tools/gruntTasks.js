module.exports = function (grunt) {
    grunt.registerTask('default', ['config', 'shell:dev']);
    grunt.registerTask('dev', ['config', 'shell:dev']);
    grunt.registerTask('build', ['config', 'shell:build']);
};
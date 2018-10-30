module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.config.init({
        targetDir: './test/sandbox/public',
        nodeModulesPath: __dirname + "/node_modules"
    });

    grunt.loadTasks('./test/sandbox/public/modules/YawikDemoSkin');
    grunt.registerTask('default',['yawik:demo']);
};
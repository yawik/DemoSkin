module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.config.init({
        targetDir: './test/sandbox/public',
        nodeModulesPath: __dirname + "/node_modules"
    });

    grunt.file.recurse('./test/sandbox/public/modules',function(absPath,rootDir,subDir,fileName){
        if('Gruntfile.js' === fileName){
            grunt.loadTasks(rootDir+'/'+subDir);
        }
    });

    grunt.registerTask('default',['copy','less','concat','cssmin','uglify']);
};

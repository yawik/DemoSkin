let Encore = require('@symfony/webpack-encore');
let CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/dist')
    .setPublicPath('/build')
    .addStyleEntry('YawikDemoSkin', './public/less/YawikDemoSkin.less')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableLessLoader()
    .setManifestKeyPrefix('build')
;
const demoConfig = Encore.getWebpackConfig();
demoConfig.name = 'demo';

Encore.reset();
Encore
    .setOutputPath('test/sandbox/public/build/')
    .setPublicPath('/build')

    .addEntry('yawik', './test/sandbox/public/modules/Core/yawik.js')
    .addStyleEntry('../modules/YawikDemoSkin/dist/YawikDemoSkin', './public/less/YawikDemoSkin.less')
    .addEntry('bootstrap-dialog', './test/sandbox/public/modules/Core/bootstrap-dialog.js')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableLessLoader()
    .autoProvideVariables({
        'global.$': 'jquery',
        jQuery: 'jquery',
        'global.jQuery': 'jquery',
    })
    .addPlugin(new CopyWebpackPlugin([
        {
            from: "./node_modules/tinymce/skins",
            to: "skins"
        }
    ]))
;

const coreConfig = Encore.getWebpackConfig();
coreConfig.name = 'core';
coreConfig.resolve = {
    extensions: ['.js'],
    alias: {
        'jquery-ui/ui/widget': 'blueimp-file-upload/js/vendor/jquery.ui.widget.js'
    }
};


module.exports = [demoConfig,coreConfig];
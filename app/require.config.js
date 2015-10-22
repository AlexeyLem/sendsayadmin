require.config({
    baseUrl: '/',
    paths: {
        'jquery': 'bower_components/jquery/dist/jquery.min',
        'i18n': 'bower_components/i18n/i18n',
        'highcharts': 'bower_components/highcharts/modules/no-data-to-display',
        'highcharts-module': 'bower_components/highcharts/highcharts',
        'moment': 'bower_components/moment/moment',
        'jquery-ui': 'bower_components/jquery-ui-1.11.4.custom/jquery-ui',
        'zeroclipboard': 'bower_components/zeroclipboard/dist/ZeroClipboard'
    },
    map: {
        '*': {
            'svg': 'components/svgLoader/svgLoader',
            'lodash': 'bower_components/lodash/lodash',
        }
    },
    shim: {
        'highcharts': {
            'exports': 'Highcharts',
            'deps': ['highcharts-module']
        }
    },
    config: {
        i18n: {
            locale: 'en-us'
        }
    },
    urlArgs: 'version=' + Date.now(),
    waitSeconds: 20
});
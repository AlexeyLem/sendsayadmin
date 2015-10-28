require.config({
    baseUrl: '/',
    paths: {
        'jquery': 'libs/jquery/dist/jquery.min',
        'i18n': 'libs/i18n/i18n',
        'highcharts': 'libs/highcharts/modules/no-data-to-display',
        'highcharts-module': 'libs/highcharts/highcharts',
        'moment': 'libs/moment/moment',
        'jquery-ui': 'libs/jquery-ui-1.11.4.custom/jquery-ui',
        'zeroclipboard': 'libs/zeroclipboard/dist/ZeroClipboard'
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
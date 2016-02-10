var gulp = require('gulp');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var connect = require('gulp-connect');
var modRewrite = require('connect-modrewrite');
var map = require('map-stream');
var gutil = require('gulp-util');

/*
gulp.task('connect', function () {
	connect.server({
		root: 'app/',
		port: 8080,
		livereload: true,
		middleware: function (connect, opt) {
			// `localhost/server/api/getuser/1` will be proxied to `192.168.1.186/server/api/getuser/1` 
			opt.route = '/api';
			opt.context = 'test.sendsay.ru/admin/api/';
			var proxy = new Proxy(opt);
			return [proxy];
		}
	});
});
*/

var jsPathes = [
		'./app/helpers/*.js',
		'./app/directives/*.js',
		'./app/filters/*.js',
		'./app/pages/*.js',
		'./app/services/*.js'
	];

// Линтинг файлов

var myReporter = map(function (file, cb) {
  if (!file.jshint.success) {
    console.log('JSHINT fail in '+file.path);
    file.jshint.results.forEach(function (err) {
      if (err) {
        console.log(' '+file.path + ': line ' + err.line + ', col ' + err.character + ', code ' + err.code + ', ' + err.reason);
      }
    });
  }
  cb(null, file);
});

gulp.task('lint', function() {
	
	gulp.src([
			'./app/helpers/*.js',
			'./app/directives/*.js',
			'./app/filters/*.js',
			'./app/pages/*.js',
			'./app/services/*.js'
		])
		.pipe(jshint())
		.pipe(jshint.reporter('default'));

});

// Локальный сервер для разработки
gulp.task('connect', function() {
	
	connect.server({
	    root: 'app',
	    livereload: false,
	    port: 8080,
	    middleware: function(connect, opt) {
			return [
				modRewrite(['!\\.html|\\.swf|\\.eot|\\.woff|\\.ttf|\\.js|\\.css|\\.svg|\\.jp(e?)g|\\.png|\\.gif$ /index.html', '^/api/(.*)$ https://test.sendsay.ru/admin/api/$1 [P]'])
			]
		}

	});

    console.log('Server listening on http://localhost:8080');

});


// Конкатенация и минификация файлов
gulp.task('uglify', function() {

    gulp.src([
    		'./app/app.js',
    		'./app/helpers/**/*.js',
			'./app/directives/**/*.js',
			'./app/filters/**/*.js',
			'./app/pages/**/*.js',
			'./app/services/**/*.js'		
		])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('app'))

        .pipe(rename('app.min.js'))
        .pipe(uglify().on('error', gutil.log))
        .pipe(gulp.dest('app'));
});

// Production сборка
gulp.task('prod', function(){
	gulp.run('minify');

})
var gulp = require('gulp');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var connect = require('gulp-connect');
var modRewrite = require('connect-modrewrite');
var map = require('map-stream');
var gutil = require('gulp-util');

var source = require('./builder/source.js');
var template = require('gulp-template');

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

gulp.task('lint', function() {
	
	gulp.src(source.js.app)
		.pipe(jshint())
		.pipe(jshint.reporter('default'));

});

// Конкатенация и минификация файлов
gulp.task('uglify', function() {

	var _source = [];

	source.js.app.forEach(function(val) {
		_source.push('./app/'+val);
	});

    gulp.src(_source)
        .pipe(concat('build.js'))
        .pipe(gulp.dest('app'))

        .pipe(rename('build.min.js'))
        .pipe(
        	uglify({ compress: false, mangle: true }) // { mangle: false }
        		.on('error', gutil.log)
        )
        .pipe(gulp.dest('app'));

});

// Генерация index.html
gulp.task('index:dev', function() {

	gulp.src('builder/index.tmpl')
		.pipe(template({
			prod: false,
			time: (new Date()).getTime(),
			source: source
		}))
		.pipe(rename('index.html'))
		.pipe(gulp.dest('app'));

});

// Генерация index.html
gulp.task('index:prod', function() {

	gulp.src('builder/index.tmpl')
		.pipe(template({
			prod: true,
			time: (new Date()).getTime(),
			source: source
		}))
		.pipe(rename('index.html'))
		.pipe(gulp.dest('app'));

});

// Production сборка
gulp.task('prod', function() {

	gulp.run('lint', 'uglify', 'index:prod');

});

// Сборка для разработки
gulp.task('dev', function() {

	gulp.run('index:dev');

});

gulp.task('uglifytest', function() {

	source.js.app.forEach(function(val, key) {
		val = 'app/'+val;
		if(key>1) {
			console.log(val);

			var p = val.split("/"),
				s = p[p.length-1].split("."),
				newName = s.slice(0,s.length-1).join('.')+'.min.'+s.slice(s.length-1),
				newPath = p.slice(0,-1).join('/');
			
			console.log(newPath + '/' + newName + "\n");

			gulp.src([val])
				.pipe(gulp.dest('builder'))
				.pipe(rename(newName))
				.pipe(
	        		uglify().on('error', gutil.log)
	        	)
	        	.pipe(gulp.dest(newPath+'/'));
	    }
	});

});
/**
 *
 *  Web Starter Kit
 *  Copyright 2014 Google Inc. All rights reserved.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License
 *
 */

'use strict';

// Include Gulp & tools we'll use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

var AUTOPREFIXER_BROWSERS = [
    'ie >= 10',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4.4',
    'bb >= 10'
];

// Lint JavaScript
gulp.task('jshint', function () {
    return gulp.src('src/AppBundle/Resources/public/javascripts/*.js')
        .pipe($.jshint(".jshintrc"))
        .pipe($.jshint.reporter('jshint-stylish'))
});

// Compile and automatically prefix stylesheets
gulp.task('main:styles', function () {
    // For best performance, don't add Sass partials to `gulp.src`
    return gulp.src([
        'src/AppBundle/Resources/public/scss/**/*.scss'
    ])
        .pipe($.sourcemaps.init())
        .pipe($.sass({
            precision: 10,
            onError: console.error.bind(console, 'Sass error:')
        }))
        .pipe($.autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('src/AppBundle/Resources/public/css'));
});

// Watch files for changes
gulp.task('watch', ['main:styles'], function () {
    gulp.watch(['src/AppBundle/Resources/views/**/*.html.twig']);
    gulp.watch(['src/AppBundle/Resources/public/scss/**/*.{scss,css}'], ['main:styles']);
    gulp.watch(['src/AppBundle/Resources/public/js/**/*.js'], ['jshint']);
});

// Build production files, the default task
gulp.task('default', ['watch'], function (cb) {
});

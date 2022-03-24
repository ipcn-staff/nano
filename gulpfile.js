const gulp = require('gulp')
const gulpDartSass = require('gulp-dart-sass')
const sassGlob = require('gulp-sass-glob-use-forward')
const plumber = require('gulp-plumber')
const autoprefixer = require('gulp-autoprefixer')
const browserSync = require('browser-sync').create()

gulp.task('default', function () {
  return gulp.src('assets/scss/style.scss').
    pipe(plumber()).
    pipe(sassGlob()).
    pipe(gulpDartSass(
      { outputStyle: 'compressed', includePaths: ['assets/scss'] })).
    pipe(autoprefixer()).
    pipe(gulp.dest('./'))
})

//ブラウザの設定

function sync(done) {
  browserSync.init({
    proxy: 'http://demo.lo/',  // Local by Flywheelのドメイン
    open: true,
    watchOptions: {
      debounceDelay: 1000,  //1秒間、タスクの再実行を抑制
    },
  })
  done()
}

function watch (done) {
  const reload = () => {
    browserSync.reload()
    done()
  }
  gulp.watch('assets/**/*.scss').on('change', gulp.series(gulp.task('default'), reload))
  gulp.watch('./**/*.php').on('change', gulp.series(reload))
  gulp.watch('./**/*.js').on('change', gulp.series(reload))
}

gulp.task('dev', gulp.series(gulp.series(sync, watch)))

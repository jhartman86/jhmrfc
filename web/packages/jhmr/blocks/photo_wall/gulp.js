module.exports = function( gulp ){

    // Get the name of the parent directory so we can use it to "namespace" tasks
    var directoryName = require('path').basename(__dirname);

    /** Return full absolute filesystem path to something in this directory */
    function _pathTo(_path){
        return __dirname + '/' + _path;
    }

    /** Prepends a task name with the parent directory for uniqueness. */
    function _taskName( taskName ){
        return directoryName + ':' + taskName;
    }

    var utils = require('gulp-util'),
        sass  = require('gulp-ruby-sass');

    /**
     * Sass compilation
     * @param _style
     * @returns {*|pipe|pipe}
     */
    function runSass( files, _style ){
        return gulp.src(files)
            .pipe(sass({compass:true, style:('compressed')}))
            .on('error', function( err ){
                utils.log(utils.colors.red(err.toString()));
                this.emit('end');
            })
            .pipe(gulp.dest(_pathTo('')));
    }

    gulp.task(_taskName('sass'), function(){ return runSass(_pathTo('**/*.scss')); });

    gulp.task(_taskName('watches'), function(){
        gulp.watch(_pathTo('**/*.scss'), {interval:1000}, [_taskName('sass')]);
    });

};
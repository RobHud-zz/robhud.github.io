// packages
const gulp = require("gulp");
const
    svgSprite = require("gulp-svg-sprite"),
    replace = require("gulp-replace"),
    cheerio = require("gulp-cheerio"),
    svgmin = require("gulp-svgmin");

// SCSS task
function svgSpriteBuild() {
    return gulp.src("./src/assets/icons/*.svg")
        .pipe(svgmin({
            js2svg: {
                pretty: true
            }
        }))
        .pipe(cheerio({
            run: function ($) {
                // $("[fill]").removeAttr("fill");
                // $("[stroke]").removeAttr("stroke");
                $("[style]").removeAttr("style");
            },
            parserOptions: {xmlMode: true}
        }))
        .pipe(replace("&gt;", ">"))
        .pipe(svgSprite({
            svg: {
                xmlDeclaration: false,
            },
            mode: {
                symbol: {
                    sprite: "../icons-sprite.svg"
                }
            }
        }))
        .pipe(gulp.dest("./catalog/view/theme/sushi/img/"));
}

// exports
module.exports = {
    build: svgSpriteBuild
};
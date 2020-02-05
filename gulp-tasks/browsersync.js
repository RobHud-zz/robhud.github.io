// packages
const browsersync = require("browser-sync").create();
const localhost = "http://sushi/";

// BrowserSync
function init(done) {
  browsersync.init({
    files: [
        "./catalog/view/theme/sushi/css/**/*",
        "./catalog/view/theme/sushi/js/**/*"
    ],
    proxy: localhost,
    open: true
  });
  done();
}

// BrowserSync Reload
function reload(done) {
  browsersync.reload();
  done();
}

// exports
module.exports = {
  init: init,
  reload: reload
};

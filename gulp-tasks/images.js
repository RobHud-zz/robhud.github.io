// packages
const fs = require("fs");
const glob = require("glob");
const path = require("path");
const sharp = require("sharp");

// specify transforms
const transforms = [
  {
    src: "./src/assets/img/stubs/*",
    dist: "./catalog/view/theme/sushi/img/stubs/_low/",
    options: {
      width: 1920,
      quality: 10
    }
  },
  {
    src: "./src/assets/img/stubs/*",
    dist: "./catalog/view/theme/sushi/img/stubs/_800/",
    options: {
      width: 800
    }
  },
  {
    src: "./src/assets/img/stubs/*",
    dist: "./catalog/view/theme/sushi/img/stubs/_400/",
    options: {
        width: 400
    }
  }
];

// resize images
function resizeImages(done) {
  transforms.forEach(function(transform) {
    let distDir = transform.dist;

    if (!fs.existsSync(distDir)) {
      fs.mkdirSync(distDir, { recursive: true });
    }

    let files = glob.sync(transform.src);

    files.forEach(function(file) {
      let filename = path.basename(file);
      sharp(file)
        .resize(transform.options)
        .toFile(`${distDir}/${filename}`)
        .catch(err => {
          console.log(err);
        });
    });
  });
  done();
}

// exports (Common JS)
module.exports = {
  resize: resizeImages
};

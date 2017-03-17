#!/usr/bin/env node

var childProcess = require('child_process');
var fs = require('fs');
var path = require('path');

var sass = require('node-sass');

childProcess.exec('mkdir -p ' + path.resolve(__dirname, '../dist/css'), (err) => {
  if (err) {
    throw err;
  }

  sass.render({
    file: path.resolve(__dirname, '../src/scss/main.scss'),
    outputStyle: (process.env.NODE_ENV === 'production') ? 'compact' : 'expanded'
  }, (err, result) => {
    if (err) {
      throw err;
    }

    fs.writeFile(path.resolve(__dirname, '../dist/css/main.css'), result.css);
  });
});

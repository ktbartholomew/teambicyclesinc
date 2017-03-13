#!/usr/bin/env node

var chokidar = require('chokidar');
var path = require('path');
var childProcess = require('child_process');

chokidar.watch(path.resolve(__dirname, '../src/'))
.on('ready', function () {
  this.on('all', (event, filePath) => {
    var copyTemplates = () => {
      process.stdout.write('running build_theme.sh...');
      childProcess.execFile(path.resolve(__dirname, './build_theme.sh'), (err, result) => {
        if (err) {
          throw err;
        }

        process.stdout.write('OK\n');
      });
    };

    if (filePath.match(/.*?\.(php|twig)/)) {
      return copyTemplates();
    }
  });
});

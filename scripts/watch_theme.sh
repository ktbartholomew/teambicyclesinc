#!/usr/bin/env node

var path = require('path');
var childProcess = require('child_process');
var chokidar = require('chokidar');

chokidar
  .watch(path.resolve(__dirname, '../src/'), {ignored: /src\/vendor/})
  .on('ready', function() {
    this.on('all', (event, filePath) => {
      var copyTemplates = () => {
        process.stdout.write('running build_templates.sh...');
        childProcess.execFile(
          path.resolve(__dirname, './build_templates.sh'),
          (err, result) => {
            if (err) {
              if (result) {
                process.stderr.write(result);
              }

              console.log(err);
              return;
            }

            process.stdout.write('OK\n');
          }
        );
      };

      var compileSass = () => {
        process.stdout.write('running build_css.sh...');
        childProcess.execFile(
          path.resolve(__dirname, './build_css.sh'),
          (err, result) => {
            if (err) {
              if (result) {
                process.stderr.write(result);
              }
              console.log(err);
              return;
            }

            process.stdout.write('OK\n');
          }
        );
      };

      var compileJs = () => {
        process.stdout.write('running webpack...');
        childProcess.exec(
          'webpack',
          {
            cwd: path.resolve(__dirname, '../')
          },
          (err, result) => {
            if (err) {
              process.stdout.write('\n');
              console.log(result);
              return;
            }

            process.stdout.write('OK\n');
          }
        );
      };

      if (filePath.match(/\.(php|twig|css|png|jpg|gif)$/)) {
        return copyTemplates();
      }

      if (filePath.match(/\.(js|jsx)$/)) {
        return compileJs();
      }

      if (filePath.match(/\.scss$/)) {
        return compileSass();
      }
    });
  });

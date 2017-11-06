const path = require('path');

var config = {
  entry: {
    eventsSingle: './src/js/entry/eventsSingle.js'
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist/js')
  }
};

module.exports = config;

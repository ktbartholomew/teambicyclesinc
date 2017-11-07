const path = require('path');
const ExtractText = require('extract-text-webpack-plugin');

var extractSass = new ExtractText({
  filename: 'main.css'
});

var sassOptions = {
  outputStyle: 'expanded'
};

var config = {
  entry: {
    'eventsSingle.js': './src/js/entry/eventsSingle.js',
    'main.css': './src/scss/main.scss'
  },
  output: {
    filename: '[name]',
    path: path.resolve(__dirname, 'dist')
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: extractSass.extract({
          use: [
            {
              loader: 'css-loader'
            },
            {
              loader: 'sass-loader',
              options: sassOptions
            }
          ]
        })
      },
      {
        test: /\.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['env']
        }
      }
    ]
  },
  plugins: [extractSass]
};

module.exports = config;

const path = require('path')

module.exports = {
  target: 'web',

  mode: 'development',

  entry: {
    index: path.join(__dirname, 'App/js/index.js'),
  },

  output: {
    path: path.resolve(__dirname, 'public/js'),
    filename: 'bundle.js',
  },

  module: {
    rules: [
      {
        test: /\.ts?$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      }
    ],
  },

    resolve: {
      extensions: ['.ts', '.js'],
    },
  };
const path = require('path');

const HtmlWebpackPlugin = require('html-webpack-plugin');

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
      },
      {
        test: /\.css$/i,
        type: 'asset/resource',
        generator: {
            filename: '[name][ext][query]'
        }
      }
    ],
  },

  resolve: {
    extensions: ['.js', '.ts'],
  }

  
    
};
const path = require('path');

const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
  target: 'web',

  mode: 'development',
  watch: true,
    
  entry: {
    index: path.join(__dirname, 'App/js/index.js'),
  },

  output: {
    path: path.resolve(__dirname, 'public/js'),
    filename: 'bundle.js',
  }
  
    
};
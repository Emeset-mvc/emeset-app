const path = require('path');

module.exports = (env, argv) => {
  const isProd = argv.mode === 'production';

  return {
    target: 'web',
    mode: isProd ? 'production' : 'development',

    devtool: isProd ? 'source-map' : 'eval-source-map',

    entry: {
      index: path.join(__dirname, 'App/js/index.js'),
    },

    output: {
      path: path.resolve(__dirname, 'public/js'),
      filename: 'bundle.js',
      clean: true,   // neteja el directori de sortida abans de cada build
    },

    module: {
      rules: [
        {
          test: /\.ts?$/,
          use: 'ts-loader',
          exclude: /node_modules/,
        },
      ],
    },

    resolve: {
      extensions: ['.ts', '.js'],
    },
  };
};

const path = require('path');

module.exports = {
  entry: {
    bundle: './src/index.js',
    'front-page': './src/front-page.js'
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist')
  },
  externals: {
    jquery: 'jQuery'
  }
}

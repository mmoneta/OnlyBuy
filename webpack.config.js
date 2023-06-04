const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

module.exports = {
  mode: 'development',
  entry: [
    './public/scss/dashboard.scss',
    './public/scss/login.scss',
    './public/scss/style.scss',
    './public/scss/variables.scss',
  ],
  output: {
    path: path.resolve(__dirname, 'public/css')
  },
  module: {
    rules: [
      // Extracts the compiled CSS from the SASS files defined in the entry
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader'
        ]
      }
    ],
  },
  plugins: [
    // Where the compiled SASS is saved to
    new MiniCssExtractPlugin({
      filename: '[name].css',
      
    })
  ],
  devServer: {
    host: '0.0.0.0',
  }
};
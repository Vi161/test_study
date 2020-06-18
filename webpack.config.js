const path = require('path')

module.exports = {
  entry: {
    main: './src/index.js'
  },
  output: {
    filename: './resource/js/[name].bundle.js',
    path: path.resolve(__dirname, './')
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          'style-loader',
          {
            loader: 'file-loader',
            options: {
              name: './css/[name].css',
            }
          },
          'sass-loader',
        ],
      },
    ],
  },
}
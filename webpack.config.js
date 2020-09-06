const path = require('path');

module.exports = {
    entry: [
        __dirname + '/assets/src/js/main.js',
        __dirname + '/assets/src/scss/index.scss'
    ],
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, './assets/theme/js'),
    },
    plugins: [

    ],
    module: {
        rules: [{
            test: /\.scss$/,
            exclude: /node_modules/,
            use: [
                {
                    loader: 'file-loader',
                    options: { outputPath: '../css/', name: 'bocor-style.min.css'}
                },
                {
                    loader: 'sass-loader'
                }

            ]
        }]
    }
};
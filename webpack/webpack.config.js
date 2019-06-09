// Webpack v4
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
module.exports = {
    entry: {main: './resources/app.js'},
    output: {
        path: path.resolve(__dirname, '../public'),
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                    },
                    {
                        loader: 'css-loader',
                        options: {importLoaders: 1},
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            config: {
                                path: __dirname + '/postcss.config.js'
                            }
                        },
                    },
                ],

            },
            {
                test: /\.svg$/,
                loader: "file-loader"
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'style.css',
        })
    ]
};
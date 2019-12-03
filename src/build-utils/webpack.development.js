const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FileManagerPlugin = require('filemanager-webpack-plugin');


module.exports = () => ({

    module: {
        rules: [
            {
                test: /\.s?css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            url: false,
                            publicPath: '../'
                        }
                    },
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(jpe?g|png|gif|ttf|eot|svg|woff)$/,
                loader: 'file-loader',
                options: {
                    name: 'images/[name].[ext]'
                }
            },
            {
                test: /\.js$/,
                use: 'babel-loader',
                exclude: '/node_modules/',
            }
        ]
    },

    plugins: [
        new webpack.LoaderOptionsPlugin({
            minimize: true
        }),

        new FileManagerPlugin({
            onStart: {
                delete: ['./build']
            },

            onEnd: [
                {
                    copy: [
                        {
                            source: './src/vendor/grapesjs/grapes.min.css',
                            destination: './assets/css/grapes.min.css'
                        },
                        {
                            source: './src/vendor/grapesjs/grapes.min.js',
                            destination: './assets/js/grapes.min.js'
                        },
                        {
                            source: './src/vendor/grapesjs/grapesjs-preset-webpage.min.js',
                            destination: './assets/js/grapesjs-preset-webpage.min.js'
                        },
                        {
                            source: './src/vendor/font-awesome/css/font-awesome.min.css',
                            destination: './assets/css/font-awesome.min.css'
                        },
                        {
                            source: './src/vendor/font-awesome/fonts',
                            destination: './assets/fonts'
                        }
                    ]
                }
            ]
        })
    ]



});
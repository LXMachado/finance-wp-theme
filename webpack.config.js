/* ==========================================================================
   Webpack Configuration for Finance Theme
   ========================================================================== */

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');

// Theme directory paths
const themeDir = __dirname;
const srcDir = path.join(themeDir, 'src');
const distDir = path.join(themeDir, 'dist');

// Determine if we're in development or production mode
const isProduction = process.env.NODE_ENV === 'production';
const mode = isProduction ? 'production' : 'development';

/* ==========================================================================
   Configuration Object
   ========================================================================== */

module.exports = {
  mode: mode,

  // Entry points
  entry: {
    main: path.join(srcDir, 'main.css'),
    script: path.join(srcDir, 'script.js'),
  },

  // Output configuration
  output: {
    path: distDir,
    filename: 'js/[name].js',
    clean: true,
    publicPath: '',
  },

  // Module resolution
  resolve: {
    extensions: ['.js', '.jsx', '.css', '.scss'],
    alias: {
      '@': srcDir,
      '~': themeDir,
    },
  },

  // Module rules
  module: {
    rules: [
      /* ==========================================================================
         CSS and SCSS Processing
         ========================================================================== */
      {
        test: /\.(css|scss)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../',
            },
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: !isProduction,
              url: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: !isProduction,
              postcssOptions: {
                plugins: [
                  require('tailwindcss')(path.join(themeDir, 'tailwind.config.js')),
                  require('autoprefixer')({
                    grid: true,
                    flexbox: true,
                    cascade: false,
                  }),
                ],
              },
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: !isProduction,
              sassOptions: {
                outputStyle: isProduction ? 'compressed' : 'expanded',
                includePaths: [srcDir],
              },
            },
          },
        ],
      },

      /* ==========================================================================
         JavaScript Processing
         ========================================================================== */
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: [
                [
                  '@babel/preset-env',
                  {
                    useBuiltIns: 'usage',
                    corejs: 3,
                    targets: {
                      browsers: ['extends @wordpress/browserslist-config'],
                    },
                  },
                ],
              ],
              cacheDirectory: true,
              sourceMaps: !isProduction,
            },
          },
        ],
      },

      /* ==========================================================================
         Asset Processing (Images, Fonts, etc.)
         ========================================================================== */
      {
        test: /\.(png|jpg|jpeg|gif|svg|woff|woff2|eot|ttf|otf)$/,
        type: 'asset',
        parser: {
          dataUrlCondition: {
            maxSize: 8 * 1024, // 8kb
          },
        },
        generator: {
          filename: 'assets/[name].[hash:8][ext]',
          publicPath: '',
        },
      },

      /* ==========================================================================
         PHP File Copy (for templates and includes)
         ========================================================================== */
      {
        test: /\.php$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: '../',
            },
          },
        ],
      },
    ],
  },

  // Plugins
  plugins: [
    /* ==========================================================================
       Mini CSS Extract Plugin
       ========================================================================== */
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
      chunkFilename: 'css/[id].css',
    }),

    /* ==========================================================================
       Webpack Manifest Plugin
       ========================================================================== */
    new WebpackManifestPlugin({
      fileName: 'manifest.json',
      publicPath: '',
      writeToFileEmit: true,
    }),
  ],

  // Optimization
  optimization: {
    minimize: isProduction,
    minimizer: [
      /* ==========================================================================
         Terser Plugin (JavaScript Minification)
         ========================================================================== */
      new TerserPlugin({
        terserOptions: {
          compress: {
            drop_console: isProduction,
            drop_debugger: isProduction,
          },
          mangle: {
            safari10: true,
          },
          format: {
            comments: !isProduction,
          },
        },
        extractComments: false,
      }),

      /* ==========================================================================
         CSS Minimizer Plugin
         ========================================================================== */
      new CssMinimizerPlugin({
        minimizerOptions: {
          preset: [
            'default',
            {
              discardComments: { removeAll: true },
            },
          ],
        },
      }),
    ],

    /* ==========================================================================
       Code Splitting
       ========================================================================== */
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendor',
          chunks: 'all',
          priority: 10,
        },
        styles: {
          name: 'styles',
          type: 'css/mini-extract',
          chunks: 'all',
          enforce: true,
        },
      },
    },

    /* ==========================================================================
       Runtime Chunk
       ========================================================================== */
    runtimeChunk: {
      name: 'runtime',
    },
  },

  // Development server (for development mode)
  devServer: {
    static: {
      directory: distDir,
    },
    compress: true,
    port: 3000,
    hot: true,
    open: false,
    watchFiles: ['src/**/*', '*.php'],
    proxy: {
      '/': {
        target: 'http://localhost:8888', // Local WordPress development URL
        changeOrigin: true,
      },
    },
  },

  // Source maps
  devtool: !isProduction ? 'source-map' : false,

  // Stats configuration
  stats: {
    colors: true,
    errorDetails: true,
    modules: false,
    entrypoints: false,
    children: false,
  },

  // Performance hints
  performance: {
    hints: isProduction ? 'warning' : false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000,
  },

  // Watch options
  watchOptions: {
    ignored: /node_modules/,
    poll: 1000,
  },

  // Externals (for WordPress globals)
  externals: {
    jquery: 'jQuery',
    $: 'jQuery',
    wp: 'wp',
    ajaxurl: 'ajaxurl',
  },
};

/* ==========================================================================
   Helper Functions
   ========================================================================== */

/**
 * Get TailwindCSS configuration path
 */
function getTailwindConfig() {
  const configPath = path.join(themeDir, 'tailwind.config.js');

  try {
    return require(configPath);
  } catch (error) {
    console.warn('TailwindCSS config not found, using default configuration');
    return {};
  }
}

/**
 * Get PostCSS configuration
 */
function getPostCSSConfig() {
  return {
    plugins: [
      require('tailwindcss')(path.join(themeDir, 'tailwind.config.js')),
      require('autoprefixer'),
    ],
  };
}

/* ==========================================================================
   Environment-specific Exports
   ========================================================================== */

if (process.env.ANALYZE) {
  const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');

  module.exports.plugins.push(
    new BundleAnalyzerPlugin({
      analyzerMode: 'static',
      reportFilename: 'webpack-report.html',
      openAnalyzer: false,
    })
  );
}
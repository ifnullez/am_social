import esbuild from "esbuild";
import { sassPlugin } from "esbuild-sass-plugin";
import postcss from "postcss";
import autoprefixer from "autoprefixer";

// is watch mode enabled ?
const watch = process.argv.includes("--watch");
// esbuild context
let ctx;

const onRebuild = {
  name: 'on-rebuild',
  setup(build) {
    build.onEnd(result => {
      console.clear();
      if (result.errors.length > 0) {
        console.log(result.errors);
      } else {
        console.log("watching...", new Date().toLocaleString());
      }
    });
  },
};

const args = {
  entryPoints: [
    { out: "styles/main.min", in: "./assets/src/styles/main.scss" },
    { out: "styles/admin.min", in: "./assets/src/styles/admin.scss" },
    { out: "scripts/main.min", in: "./assets/src/scripts/main.js" },
    { out: "scripts/admin.min", in: "./assets/src/scripts/admin.js" },
  ],
  outdir: "./assets/dist",
  bundle: true,
  metafile: true,
  treeShaking: true,
  // be careful with this parameter ( can overwrite your source files )
  allowOverwrite: false,
  loader: {
    ".ts": "ts",
    ".jsx": "js",
    ".js": "js"
  },
  plugins: [
    sassPlugin({
      async transform(source) {
        const { css } = await postcss([autoprefixer]).process(source, {
          from: undefined,
        });
        return css;
      },
    }),
    onRebuild
  ]
};

if (watch) {
  ctx = await esbuild.context(args);
  await ctx.watch();
} else {
  args.sourcemap = true;
  args.minify = true;
  ctx = await esbuild.build(args);
  console.clear();
  // await ctx.dispose();
  console.log("build successful");
}

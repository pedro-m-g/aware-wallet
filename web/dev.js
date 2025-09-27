import esbuild from 'esbuild'

async function buildAndWatch() {
  let cssCtx = await esbuild.context({
    entryPoints: ['web/css/app.css'],
    bundle: true,
    outfile: 'public/assets/styles.css'
  });

  await cssCtx.watch();

  let jsCtx = await esbuild.context({
    entryPoints: ['web/js/index.js'],
    bundle: true,
    outfile: 'public/assets/app.js'
  });

  await jsCtx.watch();
}

buildAndWatch();
console.log('Watching for changes...');

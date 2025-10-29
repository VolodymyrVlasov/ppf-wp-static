import watch from "gulp-watch";
import { deployCode } from "./deploy/deployCode.js";

import { buildPages, SRC_PATH as pagesWatchPath, TARGET_PATH as pagesBuildPath } from "./build/buldPages.js";

import { buildTheme, SRC_PATH as themeWatchPath, TARGET_PATH as themeBuildPath } from "./build/buildTheme.js";

import { buildThemeScripts, SRC_PATH as themeScriptsWatchPath, TARGET_PATH as themeScriptsBuildPath } from "./build/buildThemeScripts.js";

import { buildStyles, SRC_PATH as stylesWatchPath, TARGET_PATH as stylesBuildPath } from "./build/buildStyles.js";

import { buildAssets, SRC_PATH as assetsWatchPath, TARGET_PATH as assetsBuildPath } from "./build/buildAssets.js";

import { buildPagesScripts, SRC_PATH as pagesScriptsWatchPath, TARGET_PATH as pagesScriptsBuildPath } from "./build/buildPagesScripts.js";

/* ------------------------ helpers ------------------------ */

function toPromise(result) {
  if (!result) return Promise.resolve();
  if (typeof result.then === "function") return result; // Promise-like
  if (typeof result.on === "function") {
    // stream / EventEmitter / child process
    return new Promise((resolve, reject) => {
      result.once("finish", resolve).once("end", resolve).once("close", resolve).once("exit", resolve).once("error", reject);
    });
  }
  return Promise.resolve(result);
}

/**
 * Запускає build; якщо build не повернув false — запускає deploy.
 * makeOptions — функція, що повертає options для deployCode (щоб знімати свіжі шляхи).
 */
async function runOnce(buildFn, vars, makeOptions) {
  const buildRes = await toPromise(buildFn(vars));
  if (buildRes === false) return; // дозволяємо скіпати деплой, якщо build повернув false
  await toPromise(deployCode(makeOptions()));
}

/**
 * Створює обгортку для watch з антидребезгом: не допускає паралельних запусків,
 * якщо під час виконання прийшли нові події — зробить ще один прогін після завершення.
 */
function watchWrapper(watchPath, runner) {
  let running = false;
  let rerun = false;

  const kick = async () => {
    if (running) {
      rerun = true;
      return;
    }
    running = true;
    try {
      await runner();
    } finally {
      running = false;
      if (rerun) {
        rerun = false;
        kick(); // повтор після накопичених змін
      }
    }
  };

  // первинний запуск (щоб одразу зібрати)
  kick();

  // підписка на зміни
  return watch(watchPath, kick);
}

/* -------------------- build + deploy tasks -------------------- */

const buildAndDeployPages = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: [
      `${pagesBuildPath}**/*`, // html, css, js тощо
      `${pagesBuildPath}.htaccess`, // <-- явно додаємо dotfile
    ],
    targetPath: "/",
    basePath: pagesBuildPath,
    clearBeforeDeploy: [`${deployType}/**/*.html`],
  });

  if (isWatch) {
    watchWrapper(pagesWatchPath, () => runOnce(buildPages, vars, makeOptions));
    return;
  }
  // режим деплою — повертаємо Promise
  return runOnce(buildPages, vars, makeOptions);
};

const buildAndDeployTheme = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: [`${themeBuildPath}**/*.php`, `${themeBuildPath}screenshot.png`],
    targetPath: "/wp-content/themes/paperfox/",
    basePath: themeBuildPath,
    clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.php`],
  });

  if (isWatch) {
    watchWrapper(themeWatchPath, () => runOnce(buildTheme, vars, makeOptions));
    return;
  }
  return runOnce(buildTheme, vars, makeOptions);
};

const buildAndDeployThemeScripts = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: `${themeScriptsBuildPath}**/*`,
    targetPath: "/wp-content/themes/paperfox/js/",
    basePath: themeScriptsBuildPath,
    clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.js`],
  });

  if (isWatch) {
    watchWrapper(themeScriptsWatchPath, () => runOnce(buildThemeScripts, vars, makeOptions));
    return;
  }
  return runOnce(buildThemeScripts, vars, makeOptions);
};

const buildAndDeployStyles = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: `${stylesBuildPath}**/*.css`,
    targetPath: "/wp-content/themes/paperfox/",
    basePath: stylesBuildPath,
    clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.css`],
  });

  if (isWatch) {
    watchWrapper(stylesWatchPath, () => runOnce(buildStyles, vars, makeOptions));
    return;
  }
  return runOnce(buildStyles, vars, makeOptions);
};

const buildAndDeployAssets = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: `${assetsBuildPath}**/*`,
    targetPath: "/wp-content/themes/paperfox/static/",
    basePath: assetsBuildPath,
    clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/static/**/*`],
  });

  if (isWatch) {
    watchWrapper(assetsWatchPath, () => runOnce(buildAssets, vars, makeOptions));
    return;
  }
  return runOnce(buildAssets, vars, makeOptions);
};

const buildAndDeployPagesScripts = (deployType, vars, isWatch) => {
  const makeOptions = () => ({
    deployType,
    sourcePath: `${pagesScriptsBuildPath}**/*`,
    targetPath: "/src/",
    basePath: pagesScriptsBuildPath,
    clearBeforeDeploy: [`${deployType}/src/**/*.js`],
  });

  if (isWatch) {
    watchWrapper(pagesScriptsWatchPath, () => runOnce(buildPagesScripts, vars, makeOptions));
    return;
  }
  return runOnce(buildPagesScripts, vars, makeOptions);
};

const watchBuildDeployScripts = [
  buildAndDeployPages,
  buildAndDeployTheme,
  buildAndDeployThemeScripts,
  buildAndDeployStyles,
  buildAndDeployAssets,
  buildAndDeployPagesScripts,
];

export default watchBuildDeployScripts;

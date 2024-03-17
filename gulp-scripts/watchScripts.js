import watch from "gulp-watch";
import { DeployTypes } from "./deploy/deployTypes.js";
import { deployCode } from "./deploy/deployCode.js";
import {
  buildPages,
  SRC_PATH as pagesWatchPath,
  TARGET_PATH as pagesBuildPath,
} from "./build/buldPages.js";

import {
  buildTheme,
  SRC_PATH as themeWatchPath,
  TARGET_PATH as themeBuildPath,
} from "./build/buildTheme.js";

import {
  buildThemeScripts,
  SRC_PATH as themeScriptsWatchPath,
  TARGET_PATH as themeScriptsBuildPath,
} from "./build/buildThemeScripts.js";

import {
  buildStyles,
  SRC_PATH as stylesWatchPath,
  TARGET_PATH as stylesBuildPath,
} from "./build/buildStyles.js";

import {
  buildAssets,
  SRC_PATH as assetsWatchPath,
  TARGET_PATH as assetsBuildPath,
} from "./build/buildAssets.js";

import {
  buildPagesScripts,
  SRC_PATH as pagesScriptsWatchPath,
  TARGET_PATH as pagesScriptsBuildPath,
} from "./build/buildPagesSripts.js";

const watchPages = (deployType) => {
  watch(pagesWatchPath, () => {
    console.log(`[${new Date().toUTCString()}] ---> PAGES CHANGED, REBUILD...`);
    const options = {
      deployType: deployType,
      sourcePath: `${pagesBuildPath}**/*`,
      localPath: "/",
      basePath: pagesBuildPath,
      clearBeforeDeloy: [`${deployType}/**/*.html`],
    };
    if (buildPages()) {
      deployCode(options);
    }
  });
};

const watchTheme = (deployType) => {
  watch(themeWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${themeBuildPath}**/*.php`,
      localPath: "/wp-content/themes/paperfox/",
      basePath: themeBuildPath,
      clearBeforeDeloy: [`${deployType}/wp-content/themes/paperfox/**/*.php`],
    };
    if (buildTheme()) {
      deployCode(options);
    }
  });
};

const watchThemeScripts = (deployType) => {
  watch(themeScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME SCRIPTS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${themeScriptsBuildPath}**/*`,
      localPath: "/wp-content/themes/paperfox/js/",
      basePath: themeScriptsBuildPath,
      clearBeforeDeloy: [`${deployType}/wp-content/themes/paperfox/**/*.js`],
    };

    if (buildThemeScripts()) {
      deployCode(options);
    }
  });
};

const watchStyles = (deployType) => {
  watch(stylesWatchPath[0], () => {
    console.log(
      `[${new Date().toUTCString()}] ---> STYLES CHANGED, REBUILD...`
    );
    console.log("stylesBuildPath", stylesBuildPath);

    const options = {
      deployType: deployType,
      sourcePath: `${stylesBuildPath}**/*.css`,
      localPath: "/wp-content/themes/paperfox/",
      basePath: stylesBuildPath,
      clearBeforeDeloy: [`${deployType}/wp-content/themes/paperfox/**/*.css`],
    };

    if (buildStyles()) {
      deployCode(options);
    }
  });
};

const watchAssets = (deployType) => {
  watch(assetsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${assetsBuildPath}**/*`,
      localPath: "/wp-content/themes/paperfox/static/",
      basePath: assetsBuildPath,
      clearBeforeDeloy: [
        `${deployType}/wp-content/themes/paperfox/static/**/*`,
      ],
    };
    if (buildAssets()) {
      deployCode(options);
    }
  });
};

const watchPagesScripts = (deployType) => {
  watch(pagesScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${pagesScriptsBuildPath}**/*`,
      localPath: "/src/",
      basePath: pagesScriptsBuildPath,
      clearBeforeDeloy: [`${deployType}/src/**/*.js`],
    };
    if (buildPagesScripts()) {
      deployCode(options);
    }
  });
};

const watchScripts = [
  watchPagesScripts,
  watchAssets,
  watchStyles,
  watchThemeScripts,
  watchTheme,
  watchPages,
];
export default watchScripts;

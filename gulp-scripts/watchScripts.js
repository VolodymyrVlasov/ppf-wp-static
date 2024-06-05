import watch from "gulp-watch";
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

const watchPages = (deployType, vars) => {
  watch(pagesWatchPath, () => {
    console.log(`[${new Date().toUTCString()}] ---> PAGES CHANGED, REBUILD...`);
    const options = {
      deployType: deployType,
      sourcePath: `${pagesBuildPath}**/*`,
      targetPath: "/",
      basePath: pagesBuildPath,
      clearBeforeDeploy: [`${deployType}/**/*.html`],
    };

    if (buildPages(vars)) {
      console.log(`[${new Date().toUTCString()}] ---> REBUILDED SUCCESFULY...`);
      deployCode(options);
    }
  });
};

const watchTheme = (deployType, vars) => {
  watch(themeWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: [`${themeBuildPath}**/*.php`, `${themeBuildPath}screenshot.png`],
      targetPath: "/wp-content/themes/paperfox/",
      basePath: themeBuildPath,
      clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.php`],
    };
    if (buildTheme(vars)) {
      deployCode(options);
    }
  });
};

const watchThemeScripts = (deployType, vars) => {
  watch(themeScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME SCRIPTS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${themeScriptsBuildPath}**/*`,
      targetPath: "/wp-content/themes/paperfox/js/",
      basePath: themeScriptsBuildPath,
      clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.js`],
    };

    if (buildThemeScripts(vars)) {
      deployCode(options);
    }
  });
};

const watchStyles = (deployType, vars) => {
  watch(stylesWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> STYLES CHANGED, REBUILD...`
    );

    const options = {
      deployType: deployType,
      sourcePath: `${stylesBuildPath}**/*.css`,
      targetPath: "/wp-content/themes/paperfox/",
      basePath: stylesBuildPath,
      clearBeforeDeploy: [`${deployType}/wp-content/themes/paperfox/**/*.css`],
    };

    if (buildStyles(vars)) {
      deployCode(options);
    }
  });
};

const watchAssets = (deployType, vars) => {
  watch(assetsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${assetsBuildPath}**/*`,
      targetPath: "/wp-content/themes/paperfox/static/",
      basePath: assetsBuildPath,
      clearBeforeDeploy: [
        `${deployType}/wp-content/themes/paperfox/static/**/*`,
      ],
    };
    if (buildAssets(vars)) {
      deployCode(options);
    }
  });
};

const watchPagesScripts = (deployType, vars) => {
  watch(pagesScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: deployType,
      sourcePath: `${pagesScriptsBuildPath}**/*`,
      targetPath: "/src/",
      basePath: pagesScriptsBuildPath,
      clearBeforeDeploy: [`${deployType}/src/**/*.js`],
    };
    if (buildPagesScripts(vars)) {
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

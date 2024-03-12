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

export const watchPages = () => {
  watch(pagesWatchPath, () => {
    console.log(`[${new Date().toUTCString()}] ---> PAGES CHANGED, REBUILD...`);
    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `${pagesBuildPath}**/*`,
      localPath: "/",
      basePath: pagesBuildPath,
    };
    if (buildPages()) {
      deployCode(options);
    }
  });
};

export const watchTheme = () => {
  watch(themeWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME CHANGED, REBUILD...`
    );
    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `${themeBuildPath}**/*`,
      localPath: "/wp-content/themes/paperfox/",
      basePath: themeBuildPath,
    };
    if (buildTheme()) {
      deployCode(options);
    }
  });
};

export const watchThemeScripts = () => {
  watch(themeScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME SCRIPTS CHANGED, REBUILD...`
    );
    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `${themeScriptsBuildPath}**/*`,
      localPath: "/wp-content/themes/paperfox/js/",
      basePath: themeScriptsBuildPath,
    };

    if (buildThemeScripts()) {
      deployCode(options);
    }
  });
};

export const watchStyles = () => {
  watch(stylesWatchPath[0], () => {
    console.log(
      `[${new Date().toUTCString()}] ---> STYLES CHANGED, REBUILD...`
    );
    console.log("stylesBuildPath", stylesBuildPath);

    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `dist/paperfox/**/*.css`,
      localPath: "/wp-content/themes/paperfox/",
      basePath: "dist/paperfox/",
    };

    if (buildStyles()) {
      deployCode(options);
    }
  });
};

export const watchAssets = () => {
  watch(assetsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `${assetsBuildPath}**/*`,
      localPath: "/wp-content/themes/paperfox/static",
      basePath: assetsBuildPath,
    };
    if (buildAssets()) {
      deployCode(options);
    }
  });
};

export const watchPagesScripts = () => {
  watch(pagesScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> ASSETS CHANGED, REBUILD...`
    );
    const options = {
      deployType: DeployTypes.LOCAL_SERVER,
      sourcePath: `${pagesScriptsBuildPath}**/*`,
      localPath: "/src/",
      basePath: pagesScriptsBuildPath,
    };
    if (buildPagesScripts()) {
      deployCode(options);
    }
  });
};

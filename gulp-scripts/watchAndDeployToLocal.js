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

export const watchPages = () => {
  watch(pagesWatchPath, () => {
    console.log(`[${new Date().toUTCString()}] ---> PAGES CHANGED, REBUILD...`);
    if (buildPages()) {
      deployCode({
        deployType: DeployTypes.LOCAL_SERVER,
        sourcePath: `${pagesBuildPath}**/*`,
        localPath: "/",
        basePath: pagesBuildPath,
      });
    }
  });
};

export const watchTheme = () => {
  watch(themeWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME CHANGED, REBUILD...`
    );
    if (buildTheme()) {
      deployCode({
        deployType: DeployTypes.LOCAL_SERVER,
        sourcePath: `${themeBuildPath}**/*`,
        localPath: "/wp-content/themes/paperfox/",
        basePath: themeBuildPath,
      });
    }
  });
};

export const watchThemeScripts = () => {
  watch(themeScriptsWatchPath, () => {
    console.log(
      `[${new Date().toUTCString()}] ---> WP-THEME SCRIPTS CHANGED, REBUILD...`
    );
    if (buildThemeScripts()) {
      deployCode({
        deployType: DeployTypes.LOCAL_SERVER,
        sourcePath: `${themeScriptsBuildPath}**/*`,
        localPath: "/wp-content/themes/paperfox/js/",
        basePath: themeScriptsBuildPath,
      });
    }
  });
};

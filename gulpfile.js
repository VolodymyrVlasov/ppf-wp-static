import { DeployTypes } from "./gulp-scripts/deploy/deployTypes.js";
import watchBuildDeployScripts from "./gulp-scripts/watchScripts.js";
import { localVars } from "./const.js";
import { testRemoteVars } from "./const.js";
import { prodRemoteVars } from "./const.js";

export const watchToLocal = () => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.LOCAL_SERVER, localVars, true);
  });
};

export const watchToRemote = () => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.REMOTE_SERVER, testRemoteVars, true);
  });
};

export const deployToLocal = () => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.LOCAL_SERVER, localVars, false);
  });
};

export const deployToRemote = () => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.REMOTE_SERVER, testRemoteVars, false);
  });
};

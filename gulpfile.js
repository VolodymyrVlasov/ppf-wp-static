import { DeployTypes } from "./gulp-scripts/deploy/deployTypes.js";

import watchScripts from "./gulp-scripts/watchScripts.js";

export const watchToLocal = () => {
  watchScripts.forEach((wacthScript) => {
    wacthScript(DeployTypes.LOCAL_SERVER);
  });
};

export const watchToRemote = () => {
  watchScripts.forEach((wacthScript) => {
    wacthScript(DeployTypes.REMOTE_SERVER);
  });
};
import { DeployTypes } from "./gulp-scripts/deploy/deployTypes.js";
import watchScripts from "./gulp-scripts/watchScripts.js";
import {localVars} from "./const.js";
import {testRemoteVars} from "./const.js";
import {prodRemoteVars} from "./const.js";



export const watchToLocal = () => {
  watchScripts.forEach((wacthScript) => {
    wacthScript(DeployTypes.LOCAL_SERVER, localVars);
  });
};

export const watchToRemote = () => {
  watchScripts.forEach((wacthScript) => {
    wacthScript(DeployTypes.REMOTE_SERVER, testRemoteVars);
  });
};
// import { DeployTypes } from "./gulp-scripts/deploy/deployTypes.js";
// import watchBuildDeployScripts from "./gulp-scripts/watchScripts.js";
// import { localVars } from "./const.js";
// import { testRemoteVars } from "./const.js";
// import { prodRemoteVars } from "./const.js";

// export const watchToLocal = () => {
//   watchBuildDeployScripts.forEach((script) => {
//     script(DeployTypes.LOCAL_SERVER, localVars, true);
//   });
// };

// export const watchToRemote = () => {
//   watchBuildDeployScripts.forEach((script) => {
//     script(DeployTypes.REMOTE_SERVER, testRemoteVars, true);
//   });
// };

// export const deployToLocal = () => {
//   watchBuildDeployScripts.forEach((script) => {
//     script(DeployTypes.LOCAL_SERVER, localVars, false);
//   });
// };

// export const deployToRemote = () => {
//   watchBuildDeployScripts.forEach((script) => {
//     script(DeployTypes.REMOTE_SERVER, testRemoteVars, false);
//   });
// };


// gulpfile.js
import { DeployTypes } from "./gulp-scripts/deploy/deployTypes.js";
import watchBuildDeployScripts from "./gulp-scripts/watchScripts.js";
import { localVars, testRemoteVars, prodRemoteVars } from "./const.js";

/** ---------------- WATCH TASKS ---------------- **/

export const watchToLocal = (done) => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.LOCAL_SERVER, localVars, true);
  });
  done(); // важливо для gulp v4
};

export const watchToRemote = (done) => {
  watchBuildDeployScripts.forEach((script) => {
    script(DeployTypes.REMOTE_SERVER, testRemoteVars, true);
  });
  done();
};

/** ---------------- DEPLOY TASKS ---------------- **/

export const deployToLocal = async () => {
  const jobs = watchBuildDeployScripts.map((script) =>
    script(DeployTypes.LOCAL_SERVER, localVars, false)
  );
  await Promise.all(jobs);
};

export const deployToRemote = async () => {
  const jobs = watchBuildDeployScripts.map((script) =>
    script(DeployTypes.REMOTE_SERVER, testRemoteVars, false)
  );
  await Promise.all(jobs);
};

export const deployToProd = async () => {
  const jobs = watchBuildDeployScripts.map((script) =>
    script(DeployTypes.PROD_SERVER, prodRemoteVars, false)
  );
  await Promise.all(jobs);
};

import gulp from "gulp";
import { DeployTypes } from "./deployTypes.js";
import { ftp } from "./ftp.js";
import { deleteSync } from "del";
import fs from "fs";

const deployToLocal = ({
  sourcePath,
  localPath,
  clearBeforeDeloy,
  basePath,
}) => {
  if (!localPath) throw new Error("invalid localPath");

  clearBeforeDeloy.forEach((rmPath) => {
    fs.rm(rmPath, { recursive: true, force: true }, () => {
      console.log(
        `[${new Date().toUTCString()}] ---> DELETE FILES FROM ${rmPath}`
      );
    });
  });

  // setTimeout(() => {
  //   console.log(
  //     `[${new Date().toUTCString()}] ---> DEPLOY * FROM ${sourcePath} TO ${
  //       DeployTypes.LOCAL_SERVER + localPath
  //     }`
  //   );
  //   gulp
  //     .src(sourcePath, { base: basePath, allowEmpty: true })
  //     .pipe(gulp.dest(`${DeployTypes.LOCAL_SERVER + localPath}`));
  // }, 200);
};

export const deployCode = ({
  deployType,
  sourcePath,
  localPath,
  remoteURL,
  prodURL,
  basePath,
  clearBeforeDeloy,
}) => {
  try {
    if (!sourcePath) throw new Error("invalid sourcePath");
    switch (deployType) {
      case DeployTypes.LOCAL_SERVER:
        deployToLocal({ sourcePath, localPath, clearBeforeDeloy, basePath });
        break;
      case DeployTypes.REMOTE_SERVER:
        if (!remoteURL) throw new Error("remoteURL is invalid");
        if (clearBeforeDeloy) ftp.rmdir(clearBeforeDeloy);
        gulp
          .src(sourcePath, { base: basePath, allowEmpty: true })
          .pipe(ftp.dest(`${DeployTypes.REMOTE_SERVER + remoteURL}`));
        break;
      case DeployTypes.PROD_SERVER:
        if (!prodURL) throw new Error("prodURL is invalid");
        if (clearBeforeDeloy) ftp.rmdir(clearBeforeDeloy);
        gulp
          .src(sourcePath, { base: basePath, allowEmpty: true })
          .pipe(ftp.dest(`${DeployTypes.PROD_SERVER + prodURL}`));
        break;
      default:
    }
  } catch {
    (error) => {
      console.error(error);
    };
  }
};

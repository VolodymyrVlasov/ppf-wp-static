import gulp from "gulp";
import { DeployTypes } from "./deployTypes.js";
import { ftp } from "../ftp.js";

const deployCode = ({
  deployType,
  sourcePath,
  localPath,
  remoteURL,
  prodURL,
  basePath,
}) => {
  try {
    if (!sourcePath) throw new Error("sourcePath is invalid");

    switch (deployType) {
      case DeployTypes.LOCAL_SERVER:
        if (!localPath) throw new Error("localPath is invalid");
        gulp
          .src(sourcePath, { base: basePath, allowEmpty: true })
          .pipe(gulp.dest(`${DeployTypes.LOCAL_SERVER + localPath}`));
        break;
      case DeployTypes.REMOTE_SERVER:
        if (!remoteURL) throw new Error("remoteURL is invalid");
        gulp
          .src(sourcePath, { base: basePath, allowEmpty: true })
          .pipe(ftp.dest(`${DeployTypes.REMOTE_SERVER + remoteURL}`));
        break;
      case DeployTypes.PROD_SERVER:
        if (!prodURL) throw new Error("prodURL is invalid");
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

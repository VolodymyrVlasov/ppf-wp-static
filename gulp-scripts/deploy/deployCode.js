import gulp from "gulp";
import { DeployTypes } from "./deployTypes.js";
import { ftp } from "./ftp.js";
import { deleteSync } from "del";
import fs from "fs";

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
    if (!sourcePath) throw new Error("sourcePath is invalid");
    switch (deployType) {
      case DeployTypes.LOCAL_SERVER:
        if (!localPath) throw new Error("localPath is invalid");

        let dir =
          "/Users/volodymyrvlasov/Documents/local-server/paperfox/wp-content/themes/paperfox/test.php";
        fs.rm(dir, { recursive: true, force: true }, (err) => {
          if (err) {
            throw err;
          }
          console.log(`${dir} is deleted!`);
        });

        if (clearBeforeDeloy) {
        }
        // setTimeout(() => {
        //   console.log(
        //     `[${new Date().toUTCString()}] ---> DEPLOY * FROM ${sourcePath} TO ${
        //       DeployTypes.LOCAL_SERVER + localPath
        //     }`
        //   );
        //   gulp
        //     .src(sourcePath, { base: basePath, allowEmpty: true })
        //     .pipe(gulp.dest(`${DeployTypes.LOCAL_SERVER + localPath}`));
        // }, 2000);

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

import gulp from "gulp";
import { DeployTypes } from "./deployTypes.js";
import { ftp } from "./ftp.js";
import { deleteSync } from "del";

/** Допоміжна: очікуємо завершення stream */
function waitForStream(stream) {
  return new Promise((resolve, reject) => {
    stream
      .once("finish", resolve)
      .once("end", resolve)
      .once("close", resolve)
      .once("error", reject);
  });
}

/** Допоміжна: лог-рядок з UTC часом */
function stamp(msg) {
  console.log(`[${new Date().toUTCString()}] ${msg}`);
}

/** Локальний деплой: чистимо та копіюємо */
function deployToLocal({ sourcePath, targetPath, clearBeforeDeploy = [], basePath }) {
  if (!targetPath) throw new Error("invalid targetPath");

  // видалення локально (можна залишити sync — швидко і просто)
  for (const rmPath of clearBeforeDeploy) {
    deleteSync(rmPath, { force: true });
    stamp(`---> DELETE FILES FROM ${rmPath}`);
  }

  stamp(`---> DEPLOY * FROM ${sourcePath} TO ${DeployTypes.LOCAL_SERVER + targetPath}`);
  const stream = gulp
    .src(sourcePath, { base: basePath, allowEmpty: true })
    .pipe(gulp.dest(`${DeployTypes.LOCAL_SERVER + targetPath}`));

  return waitForStream(stream).then(() => {
    stamp(`---> DEPLOY SUCCESSFULLY`);
  });
}

/** Видалення на віддаленому ftp як Promise (підтримує масив або один шлях) */
function remoteRemove(paths) {
  if (!paths || (Array.isArray(paths) && paths.length === 0)) return Promise.resolve();
  const list = Array.isArray(paths) ? paths : [paths];

  stamp(`---> DELETE FILES FROM ${list.join(", ")}`);

  return Promise.all(
    list.map(
      (p) =>
        new Promise((resolve) => {
          // vinyl-ftp: conn.rmdir(path, cb)
          ftp.rmdir(p, (err) => {
            if (err) {
              // не падаємо деплой повністю через видалення; логнемо і підемо далі
              stamp(`---> WARN: rmdir failed for ${p}: ${err.message || err}`);
            }
            resolve();
          });
        })
    )
  ).then(() => {
    stamp(`---> REMOTE DELETE DONE`);
  });
}

/** Віддалений деплой (тест/стейдж) */
async function deployToRemote({ sourcePath, targetPath, clearBeforeDeploy = [], basePath }) {
  if (!targetPath) throw new Error("targetPath is invalid");

  await remoteRemove(clearBeforeDeploy);

  stamp(`---> DEPLOY * FROM ${sourcePath} TO ${DeployTypes.REMOTE_SERVER + targetPath}`);
  const stream = gulp
    .src(sourcePath, { base: basePath, allowEmpty: true })
    .pipe(ftp.dest(`${DeployTypes.REMOTE_SERVER + targetPath}`));

  await waitForStream(stream);
  stamp(`---> DEPLOY SUCCESSFULLY`);
}

/** Прод-деплой */
async function deployToProd({ sourcePath, prodURL, clearBeforeDeploy = [], basePath }) {
  if (!prodURL) throw new Error("prodURL is invalid");

  await remoteRemove(clearBeforeDeploy);

  stamp(`---> DEPLOY * FROM ${sourcePath} TO ${DeployTypes.PROD_SERVER + prodURL}`);
  const stream = gulp
    .src(sourcePath, { base: basePath, allowEmpty: true })
    .pipe(ftp.dest(`${DeployTypes.PROD_SERVER + prodURL}`));

  await waitForStream(stream);
  stamp(`---> DEPLOY SUCCESSFULLY`);
}

/** Публічне API: завжди повертає Promise */
export const deployCode = (opts) => {
  const {
    deployType,
    sourcePath,
    targetPath,
    prodURL,
    basePath,
    clearBeforeDeploy = [],
  } = opts || {};

  if (!sourcePath) return Promise.reject(new Error("invalid sourcePath"));

  try {
    switch (deployType) {
      case DeployTypes.LOCAL_SERVER:
        stamp(`---> DEPLOY TO LOCAL SERVER SELECTED...`);
        return deployToLocal({ sourcePath, targetPath, clearBeforeDeploy, basePath });

      case DeployTypes.REMOTE_SERVER:
        stamp(`---> DEPLOY TO REMOTE SERVER SELECTED...`);
        return deployToRemote({ sourcePath, targetPath, clearBeforeDeploy, basePath });

      case DeployTypes.PROD_SERVER:
        stamp(`---> DEPLOY TO PROD SERVER SELECTED...`);
        return deployToProd({ sourcePath, prodURL, clearBeforeDeploy, basePath });

      default:
        return Promise.reject(new Error(`Unknown deployType: ${deployType}`));
    }
  } catch (error) {
    // на випадок синхронних помилок
    return Promise.reject(error);
  }
};

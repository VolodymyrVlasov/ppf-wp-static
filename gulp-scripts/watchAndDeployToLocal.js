import watch from "gulp-watch";
import { devVar } from "../const.js";
import {
  buildPages,
  SRC_PATH as pagesWatchPath,
  TARGET_PATH as pagesBuildPath,
} from "./build/buldPages.js";

export const watchPages = () => {
  watch("dev/pages/**/*.html", () => {
    buildPages();
    console.log(`[${new Date().toUTCString()}] ---> pages was changed`);
  });
};

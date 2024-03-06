import gulp from "gulp";
import dotenv from "dotenv";
import { ftp } from "./ftp.js";

dotenv.config();

const SRC_PATH = ["paperfox/style.css", "paperfox/styles/*"];
const TARGET_PATH_LOCAL = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;
const TARGET_PATH_REMOTE = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;
const TARGET_PATH_PROD = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;

export const deployStylesToLocal = () => {
  console.log("start deploy to Local");
  gulp
    .src(SRC_PATH, { base: "paperfox", allowEmpty: true })
    .pipe(gulp.dest(TARGET_PATH_LOCAL));
};

export const deployStylesToRemote = () => {
  gulp
    .src(SRC_PATH, { base: "paperfox", allowEmpty: true })
    .pipe(ftp.dest(TARGET_PATH_REMOTE));
};

export const deployStylesToProd = () => {
  gulp
    .src(SRC_PATH, { base: "paperfox", allowEmpty: true })
    .pipe(ftp.dest(TARGET_PATH_PROD));

  console.log("end deploy to Local");
};

import gulp from "gulp";
import dotenv from "dotenv";
import { ftp } from "../ftp.js";

dotenv.config();

const SRC_PATH = ["dist/paperfox/style.css", "dist/paperfox/styles/*"];
const TARGET_PATH_LOCAL = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;
const TARGET_PATH_REMOTE = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;
const TARGET_PATH_PROD = `${process.env.LOCAL_SERVER}/wp-content/themes/paperfox/`;

export const deployStylesToLocal = () => {
  gulp
    .src(SRC_PATH, { base: "dist/paperfox", allowEmpty: true })
    .pipe(gulp.dest(TARGET_PATH_LOCAL));
};

export const deployStylesToRemote = () => {
  gulp
    .src(SRC_PATH, { base: "dist/paperfox", allowEmpty: true })
    .pipe(ftp.dest(TARGET_PATH_REMOTE));
};

export const deployStylesToProd = () => {
  gulp
    .src(SRC_PATH, { base: "dist/paperfox", allowEmpty: true })
    .pipe(ftp.dest(TARGET_PATH_PROD));
};

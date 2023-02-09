const fs = require("fs");
const html = fs.readFileSync("./dist/index.html").toLocaleString();

const baseReplace = "./";

const prefix = "public/";

const search = /(src|href)=["']([^"']+)["']/g;

const updatedHtml = html
  .replace(search, (match, p1, p2) => {
    return `${p1}="${prefix}${p2}"`;
  })
  .replace(/<base\s+href=".*">/, `<base href="${baseReplace}">`);

fs.writeFileSync("./dist/index.html", updatedHtml, { flag: "w" });

const fs = require("fs");
const html = fs.readFileSync("./dist/index.html").toLocaleString();

const prefix = "./users/liu100/productlist/public/";
const search = /<base href=["']([^"']+)["']/g;

const updatedHtml = html.replace(search, (match, p1) => {
  return `<base href="${prefix}"`;
});

fs.writeFileSync("./dist/index.html", updatedHtml, { flag: "w" });

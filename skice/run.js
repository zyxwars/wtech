import fs from "fs";
import nunjucks from "nunjucks";
import path from "path";

function buildHtml(fileName) {
    const out = nunjucks.render(fileName);
    fs.writeFileSync(path.join("./skice", fileName), out, {});
}

fs.rmSync("./skice", { recursive: true, force: true });
fs.mkdirSync("skice/components", { recursive: true });

fs.cpSync("./src/assets/", "./skice/assets/", { recursive: true });

nunjucks.configure("./src", { autoescape: true });

fs.readdirSync("./src")
    .filter((name) => name.endsWith(".html"))
    .forEach((fileName) => buildHtml(fileName));

fs.readdirSync("./src")
    // TODO: Add file types to copy here
    .filter(
        (name) =>
            name.endsWith(".css") ||
            name.endsWith(".svg") ||
            name.endsWith(".js"),
    )
    .forEach((fileName) =>
        fs.copyFileSync(
            path.join("./src", fileName),
            path.join("./skice", fileName),
        ),
    );

fs.readdirSync("./src/components")
    .filter((name) => name.endsWith(".css"))
    .forEach((fileName) =>
        fs.copyFileSync(
            path.join("./src/components", fileName),
            path.join("./skice/components", fileName),
        ),
    );

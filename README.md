# Record store

<img src="./vinyl-blank.png" width="200"/>

## Documentation

### [Dokumentácia](./docs/DOCS.md)

### [Návod na spustenie (development mode)](./docs/DOCS.md#n%C3%A1vod-na-spustenie-development-mode)

### [Credits](./docs/DOCS.md#credits)

### Building docs

```sh
# Disable implicit figures for desired image positioning
cd docs && pandoc -f markdown-implicit_figures -o Dokumentácia.pdf DOCS.md
```

### Regenerating images

> [!NOTE]
> Make sure to update credits in docs after adding new images

```sh
# Outputs vinyl and cover images to ./product-images
python3 img_gen.py
```

## Todo

### Issues

-   https://github.com/zyxwars/wtech/issues

### Requirements

-   https://github.com/kurice/wtech25
-   https://github.com/kurice/wtech25/blob/main/semestralny-projekt/README.md

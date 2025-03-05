## Submission

The submission files are located in <strong>./skice</strong>

## Development

The files here will be used as laravel blade templates

To allow for easier development parcel is used for serving and building the project and posthtml is used for simple templating

Templating is achieved by using the following plugins
https://github.com/posthtml/posthtml-include
https://github.com/posthtml/posthtml-expressions

### Setup

```
npm install
```

### Running

Start development server on localhost

```
npm run dev
```

Pages should now be accessible from http://localhost:1234
The respective sub pages are accessible by their name eg. http://localhost:1234/cart

### Building

> [!IMPORTANT]  
> Build should be run after changes to update <strong>./skice</strong>

```
npm build
```

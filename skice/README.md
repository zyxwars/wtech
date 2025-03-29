## Submission

- Page components are located under `src`
- The representation for each page is compiled into `dist`
- The wireframes are located in `wireframes`

- Some album names and authors are duplicated as a result of using [nunjucks random ](https://mozilla.github.io/nunjucks/templating.html#random) to populate the mock pages

### Credits

- Artwork

    - Album covers by id
          <ol>
          <li>https://unsplash.com/photos/a-painting-on-the-ceiling-of-a-building-1rBg5YSi00c</li>
          <li> https://unsplash.com/photos/two-stars-in-the-middle-of-a-black-sky-fsH1KjbdjE8</li>
          <li> https://unsplash.com/photos/grayscale-photo-of-woman-statue-dYogRY-vU2o</li>
          <li> https://unsplash.com/photos/photo-of-orange-flower-2FdIvx7sy3U</li>
          <li> https://unsplash.com/photos/blue-lemon-sliced-into-two-halves-5E5N49RWtbA</li>
          <li> https://unsplash.com/photos/photography-of-tree-Jrl_UQcZqOc</li>
          <li> https://unsplash.com/photos/silhouette-photo-of-person-standing-rMmibFe4czY</li>
          <li> https://unsplash.com/photos/black-white-and-red-abstract-painting-WB9TRkyrlzk</li>
          <li> https://unsplash.com/photos/gray-lion-statue-with-red-background-NWJOf03vXKQ</li>
          <li> https://unsplash.com/photos/a-person-drowns-underwater-rX12B5uX7QM</li>
          <li> https://unsplash.com/photos/a-close-up-of-a-shiny-surface-with-a-blue-sky-in-the-background-OHPdgstNFGs</li>
          </ol>

    - Hero Banner
        - https://unsplash.com/photos/angel-statue-OGSbrFW_dos

- CSS components

    - https://tailwindcss.com
    - https://daisyui.com

- Copywriting
    - ChatGPT, Lorem Ipsum

## Development

The files here will be used as laravel blade templates

To allow for easier development reusable parts of code are split into components

### Setup

Install node and run the following

```
npm install
```

### Running

```
npm run dev
```

This builds files to skice on each change. You can now open a file from <strong>./skice</strong> skice in your browser and refresh to see changes. Check run.js script for more details.

### Components and theming

https://daisyui.com

Currently using cdn for both tailwind and daisy ui.
Tailwind.config.js exists only for the tailwind extension to pick up folders.

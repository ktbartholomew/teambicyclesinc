# teambicyclesinc
WordPress Theme for teambicyclesinc.com


## Test/Develop

Requires [Docker](https://www.docker.com/) and [Node.js](https://nodejs.org/en/).

1. Build the theme by populating the `dist/` directory:

  ```
  ./scripts/build_theme.sh
  ```

1. Start MySQL and WordPress containers to serve the theme:

  ```
  ./scripts/test.sh up
  ```

1. Visit [http://localhost:8080/](http://localhost:8080/) (or the URL to the host running your Docker daemon) in your web browser.

1. Watch source files for changes and re-build the theme automatically:

  ```
  ./scripts/watch_theme.sh
  ```

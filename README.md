# Shopware 6 - Admin extension example

This App example is using the [meteor-component-library](https://github.com/shopware/meteor-component-library) and [admin-extension-sdk](https://github.com/shopware/admin-extension-sdk) from Shopware.
This app simply displays basic information about how to use the libraries and how to make a Shopware app.

## What we have in this example:

We're using Vue 2, Symfony 6.2 and Mysql to build this demo. You can use [Gitpod](https://gitpod.io/#https://github.com/mothership-gmbh/sw6-admin-extension-example) to test it.

### [Shop app communication](https://developer.shopware.com/docs/guides/plugins/apps/app-base-guide#setup)
![shop-app-communication.svg](.github%2Fassets%2Fshop-app-communication.svg)

### Demo with the [Action button](https://shopware.github.io/admin-extension-sdk/docs/guide/api-reference/ui/actionButton).
![sw-app-action-button.png](.github%2Fassets%2Fsw-app-action-button.png)

### Demo with the [Menu Item](https://shopware.github.io/admin-extension-sdk/docs/guide/api-reference/ui/menuItem).
![sw-app-menu-item.png](.github%2Fassets%2Fsw-app-menu-item.png)

### Demo with the [Tabs](https://shopware.github.io/admin-extension-sdk/docs/guide/api-reference/ui/tabs), [Notification](https://shopware.github.io/admin-extension-sdk/docs/guide/api-reference/notification), [Repository](https://shopware.github.io/admin-extension-sdk/docs/guide/api-reference/data/repository) and API connection.
![sw-app-notification-api-tabs.png](.github%2Fassets%2Fsw-app-notification-api-tabs.png)

### Demo with [Form](https://shopware.github.io/meteor-component-library/?path=/story/interaction-tests-feedback-indicator-sw-banner--visual-test-banner-neutral).
![sw-app-form.png](.github%2Fassets%2Fsw-app-form.png)

## Get It Running with Gitpod

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/mothership-gmbh/sw6-admin-extension-example)

## Get It Running with Valet
1. Clone this repository 
2. Run install the project
```shell
composer install
npm install
npm run build
```

3. Go the mysql and create a new database for the app.
4. Copy the .env.dist to .env and change the configuration, then you have to set `http://mothership-app.test` for `SHOPWARE_APP_URL`
```shell
cp .env.dist .env
```
open `.env` and update
```shell
SHOPWARE_APP_URL=http://mothership-app.test
```

5. Copy the `app/MothershipDemoApp/manifest.xml.example` to `app/MothershipDemoApp/manifest.xml` then you have to replace the `SHOPWARE_APP_URL` to http://mothership-app.test
```shell
cp app/MothershipDemoApp/manifest.xml.example app/MothershipDemoApp/manifest.xml
```

6. Run migration
```shell
php bin/console doctrine:migrations:migrate
```
7. Go to public server and link a new domain, for example: `valet link mothership-app`
8. Copy the folder `MothershipDemoApp` to `[your-shopware-path]/custom/apps/`
9. Go to the admin page Install and active the app and enjoy.

### Important files/directories description

    .
    ├── app                         
    │   ├── MothershipDemoApp           # App folder to upload to shopware
    ├── assets                          # Asset modules
    │   ├── components                  # App components
    │   │   ├── App.vue                 # Root path of the App's iframe
    │   │   ├── DemoApi.vue             # Demo to send data from the shop to the app server
    │   │   ├── DemoForm.vue            # Demo to use the meteor-component-library
    │   ├── init                        # Contains init plugins
    │   │   ├── device.helper.js        # Provides methods to get device and browser information
    │   │   └── helper.init.js          # Handling installation of plugin init
    │   ├── ui                          # Shopware extention UIs
    │   │   ├── order-detail-action.js  # To add an action button in order detail
    │   ├── utils
    │   │   ├── api                     # Related to the connect the systems by APIs
    │   │   │   ├── api.service.js      # API service to use in the extends for all of APIs
    │   │   │   └── order.service.js    # An example send order data
    │   │   ├── axios.factory.js        # Axios interceptors
    │   │   └── router.js               # Declare routers
    │   └── app.js                      # App's main JavaScript file. Where it all begins
    ├── config                          # Symfony's config folder
    ├── migrations                      # Symfony's migration folder
    ├── src
    │   ├── Controller                  # Controller folder
    │   │   ├── ApiController.php       # The API that receives the orders data is here
    │   │   ├── AppController.php       # Declare app router for the iframe
    │   │   └── AuthController.php      # App registration and confirmation
    │   ├── Entity                      # Entity folder
    │   │   └── Shop.php                # Shop enity
    │   ├── Repository                  # Repository folder
    │   │   └── ShopRepository.php      # Shop repository
    │   └── Service
    │       ├── RegisterAppService.php  # Handle app register, check signature and proof
    │       └── ShopwareAuthenticator.php # Verify the requests sent from the Shop
    │   
    ├── templates                       # Twig templates
    │   ├── base.html.twig              # Base template for the iframe
    │   └── index.html.twig             # Index template for Vue
    ├── .env.example                    # .env for the app
    ├── gitpod.Dockerfile               # Gitpod dockerfile
    ├── gitpod.yml                      # Gitpod script
    ├── package.json                    # NPM packages
    └── webpack.config.js               # Webpack to build the app

## Commands
```shell
npm run build # To build the app
npm run watch # To open watch mode
```

## License
Licensed under the MIT License
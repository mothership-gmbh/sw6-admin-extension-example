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

## License
Licensed under the MIT License
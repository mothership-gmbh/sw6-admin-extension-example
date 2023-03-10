# Shopware 6 - Admin extension example

## Run this demo with Gitpod

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/mothership-gmbh/sw6-admin-extension-example)

## Run this demo with Valet
- Clone this repository
- Run `composer install`, `npm install` and `npm run build`
- Go the mysql and create a new database for the app.
- Copy the .env.dist to .env and change the configuration, then you have to set `http://mothership-app.test` for `SHOPWARE_APP_URL`
- Copy the `app/MothershipDemoApp/manifest.xml.example` to `app/MothershipDemoApp/manifest.xml` then you have to replace the SHOPWARE_APP_URL to http://mothership-app.test
- Run migration `php bin/console doctrine:migrations:migrate`
- Go to public server and link a new domain, for example: `valet link mothership-app`
- Adjust the manifest.xml in `app/MothershipDemoApp/manifest.xml` and then the folder `MothershipDemoApp` to `[shopware-path]/custom/apps/
- Go to the admin page Install and active the app and enjoy.

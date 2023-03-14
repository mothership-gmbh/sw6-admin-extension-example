# Shopware 6 - Admin extension example

## Run this demo with Valet
- Clone this repository
- Run `composer install` and `npm install`
- Go the mysql and create a new database for the app.
- Copy the .env.dist to .env and change the configuration, you have to set the SHOPWARE_APP_URL=http://mothership-app.test
- Run migration `php bin/console doctrine:migrations:migrate`
- Go to public server and link a new domain, for example: `valet link mothership-app`
- Adjust the manifest.xml in `app/MothershipDemoApp/manifest.xml` and then compress the folder `MothershipDemoApp` to a zip file.
- Open the shopware admin extension page and upload `MothershipDemoApp.zip`
- Install and active the app and enjoy.

## Run this demo with Gitpod
- Updating

## Run this demo with Docker
- Updating
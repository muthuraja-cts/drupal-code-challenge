# Composer template for Drupal projects

The below composer command is used to install the Drupal 9 latest version

```
composer create-project drupal/recommended-project:^9 some-dir --no-interaction
```

## Installing Drush via composer 

```
composer require drush/drush
```

# The below steps are followed to complete the code challenge.

1. Created product content type and necessary fields as per requirement.
2. Enabled Layout builder and Layout discovery core modules to display image, description in two column layout.
3. Installed the PHP libraries `tecnickcom/tc-lib-barcode` to generate the QR code

```
composer require tecnickcom/tc-lib-barcode ^1.17
```

4. Composer will automatically update your composer.json file adding the external libraries

```
{
    "require": {
        "tecnickcom/tc-lib-barcode": "^1.17"
    }
}
```
5. Created a custom(sph_product) module to display QR code in a block. It is placed on the right side bar region and visibility is configured to show the block for product content type and node page.
6. The necessary functions are added to work cache properly for better performance. 
7. Try and catch is used to handle the failure scenario when 3rd API is triggered.
8. Identified the *.yml files which are needed and placed the files under sph_product/config/install folder. So the configuration changes would be applied automatically when the module is enabled.

9. Enabled custom module using drush command

```
drush en sph_product
```

`You are free to use any publicly available PHP (or otherwise) libraries to generate the QR code. You don't have to reinvent the wheel! Use something from https://packagist.org/?q=php%20qrcode&p=0`

Selected the library https://packagist.org/packages/tecnickcom/tc-lib-barcode from https://packagist.org/?q=php%20qrcode&p=0

`If your submission requires any further deployment steps, apart from the ones already listed in #3 above,`
There is no further deployment steps needed, just enabling the module, necessary configuration would be imported properlly.


`make sure to list such deployment/installation steps. (Don't do it with an email. Instead, update this README.md file with the instructions).`


1. Created a demo website using Drupal composer option in Pathenon. It provides the latest version of
drupal 9.4.5 template using composer approach.
2. Installed Drupal along with an admin account.
3. Generated ssh key in my local and applied the value under personal settings link (Panthenon). So I'm able to clone the code into my local system.
4. Installed the QR code library using composer
5. Created sph_product under the /modules/custom folder
6. Pushed the updated files (composer.json, composer.lock, sph_product) into Pathenon repository 
7. Enabled the sph_product module
8. Created Sample content

`Make the module available, along with the sample content (Unicorn Iron on patch), on a publicly available url. You may use Acquia Cloud Free Tier hosting available at https://insight.acquia.com/free/register?cs=acf-expertdevs , to upload your demo site.`

I have filled out the "Request a Demo" form. but the Acuia team may take time to provide a free account. So I have created a demo site using Panthenon.

`Your final submission is expected to contain a) Updated code of the module in this repository b) A link to the demo site c) Admin (uid=1) credentials to the demo site`

Github Repo: https://github.com/muthuraja-cts/drupal-code-challenge
Demo URL: https://dev-drupal9-sphdemo.pantheonsite.io/
User Name : admin 
Password : Welcome@123#
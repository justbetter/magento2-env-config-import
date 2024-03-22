# Magento 2 Env Config Import

This Magento 2 module makes it possible to import ENV variables into the Magento configuration

## Installation
- `composer require justbetter/magento2-env-config-import`
- `bin/magento module:enable JustBetter_EnvConfigImport`
- `bin/magento setup:upgrade`
- `bin/magento setup:di:compile`
- `bin/magento setup:static-content:deploy`

To prevent the exception `The configuration file has changed.' . ' Run the "app:config:import" or the "setup:upgrade" command to synchronize the configuration.` you can add the following configuration to the `env.php`.

```
'deployment' => [
    'blue_green' => [
        'enabled' => true
    ]
]
```

## Compatibility
The module is tested on Magento version 2.4.x

## Ideas, bugs or suggestions?
Please create a [issue](https://github.com/justbetter/magento2-env-config-import/issues) or a [pull request](https://github.com/justbetter/magento2-env-config-import/pulls).

## About us
We’re a innovative development agency from The Netherlands building awesome websites, webshops and web applications with Laravel and Magento. Check out our website [justbetter.nl](https://justbetter.nl) and our [open source projects](https://github.com/justbetter).

## License
[MIT](LICENSE)

---

<a href="https://justbetter.nl" title="JustBetter"><img src="https://raw.githubusercontent.com/justbetter/art/master/justbetter-logo.png" width="200px" alt="JustBetter logo"></a>

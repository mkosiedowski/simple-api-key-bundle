SimpleApiKey Bundle
=============

Creates a firewall for using ApiKey application authentication for Symfony2.

This bundle is highly based on [uecode/api-key-bundle](https://github.com/uecode/api-key-bundle/)

# Installation

Requires composer, install as follows

```sh
composer require mkosiedowski/simple-api-key-bundle dev-master
```

## Enable Bundle

Place in your `AppKernel.php` to enable the bundle

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new mkosiedowski\SimpleApiKeyBundle\SimpleApiKeyBundle(),
    );
}
```
#### Configuration
You can change how the API key should be delivered and the name of the parameter its sent as.  By default, this bundle looks for `apiKey` in the query string.

```yaml
simple_api_key:
    delivery: query #or header
    parameter_name: some_value # defaults to `api_key`
```

### Applications repository
Applications are stored in applicationKeys table by default.

You should register Doctrine Entities mapping with your doctrine configuration:
```yaml
doctrine:
    orm:
        entity_managers:
            default:
                mappings:
                    SimpleApiKeyBundle:
                        type: annotation
                        dir: Entity
                        is_bundle: true
```
## Change security settings

You can now add `simple_api_key: true` to any of your firewalls. 

For Example:

```yaml
security:
    firewalls:
        auth:
            pattern: ^/api/*
            simple_api_key: true
            stateless: true
```

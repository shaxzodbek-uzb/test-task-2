## Requirements:
    php: ^7.1

## Packages:
    symfony/console
    jajo/jsondb

## Installation:
```shell
    composer install
```
## Execute:
```shell
    php bin/console
    php bin/console notify <notifier> <user_id> <order_id>
    php bin/console notify email 1 O-2829
    php bin/console notify telegram 1 O-2829
    php bin/console notify sms 1 O-2829
    php bin/console notify firebase 1 O-2829
```
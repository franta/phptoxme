# Toxme implementation with php


## Requirements
* php hosting
* valid https certificate (not self signed)
* no database, only one php script and rewrite rule

## Limit
Support only new web api, no dns. This api is usable only in some clients. Now, qtox is supported, utox not.

## Setup
* edit $users to add your tox id
* upload to web hosting
* enable rewrite rules

##### Apache
> RewriteRule ^api /api/toxme.php

##### Nginx
> location /api {
>	rewrite ^/api$ /toxme.php;
>}

* test if everything is working correctly

> $ curl --data '{"action": 3,"name": "echobot" }' https://example.net/api
> {
>     "version": "Tox V3 (local)",
>     "source": 1,
>     "tox_id": "76518406F6A9F2217E8DC487CC783C25CC16A15EB36FF32E335A235342C48A39",
>     "c": 0,
>     "url": "tox:echobot@example.net",
>     "name": "echobot",
>     "regdomain": "example.net",
>     "verify": {
>         "status": 1,
>         "detail": "Good (signed by local authority)"
>     }
> }

Note: save toxme.php as api/index.php usually not working, because there is 301 redirect from /api to /api/, and qtox currently not support it

If you want full service with user registration, use [toxme from subliun](https://github.com/subliun/toxme)
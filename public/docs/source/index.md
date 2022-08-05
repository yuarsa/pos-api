---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#Masters
<!-- START_f59fbad73970b577a0174567b10ef300 -->
## /v1/master/outlets
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/outlets", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/outlets`


<!-- END_f59fbad73970b577a0174567b10ef300 -->

<!-- START_9219d73a573cd250b21033bdf05a8cc5 -->
## /v1/master/outlets/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/outlets/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/outlets/autocomplete`


<!-- END_9219d73a573cd250b21033bdf05a8cc5 -->

<!-- START_3de94d0b80e2a5fdde998ec9dbee3f86 -->
## /v1/master/outlets
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/outlets", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "out_name" => "consequuntur",
            "out_email" => "repudiandae",
            "out_phone" => "ea",
            "out_address" => "minus",
            "out_prov_code" => "molestias",
            "out_reg_code" => "cum",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "out_name": "consequuntur",
    "out_email": "repudiandae",
    "out_phone": "ea",
    "out_address": "minus",
    "out_prov_code": "molestias",
    "out_reg_code": "cum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/outlets`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    out_name | string |  required  | Deskripsi.
    out_email | string |  required  | Deskripsi.
    out_phone | string |  required  | Deskripsi.
    out_address | string |  optional  | optional Deskripsi.
    out_prov_code | string |  optional  | optional Deskripsi.
    out_reg_code | string |  optional  | optional Deskripsi.

<!-- END_3de94d0b80e2a5fdde998ec9dbee3f86 -->

<!-- START_9af5c079d2dcafb468f295afde475eb4 -->
## /v1/master/outlets/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/outlets/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "out_uuid" => "placeat",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets/1");

    let params = {
            "out_uuid": "placeat",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/outlets/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    out_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_9af5c079d2dcafb468f295afde475eb4 -->

<!-- START_be5e87ad013a46c05e5b776c9b5414f2 -->
## /v1/master/outlets/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/outlets/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "out_uuid" => "recusandae",
        ],
    'json' => [
            "out_name" => "commodi",
            "out_email" => "ratione",
            "out_phone" => "non",
            "out_address" => "ut",
            "out_prov_code" => "explicabo",
            "out_reg_code" => "sit",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets/1");

    let params = {
            "out_uuid": "recusandae",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "out_name": "commodi",
    "out_email": "ratione",
    "out_phone": "non",
    "out_address": "ut",
    "out_prov_code": "explicabo",
    "out_reg_code": "sit"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/outlets/{uuid}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    out_name | string |  required  | Deskripsi.
    out_email | string |  required  | Deskripsi.
    out_phone | string |  required  | Deskripsi.
    out_address | string |  optional  | optional Deskripsi.
    out_prov_code | string |  optional  | optional Deskripsi.
    out_reg_code | string |  optional  | optional Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    out_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_be5e87ad013a46c05e5b776c9b5414f2 -->

<!-- START_104f60b50954cad041eaa3cfa85ca001 -->
## /v1/master/outlets/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/outlets/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "out_uuid" => "natus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/outlets/1");

    let params = {
            "out_uuid": "natus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/outlets/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    out_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_104f60b50954cad041eaa3cfa85ca001 -->

<!-- START_7bf388730f97796943e22dd1c2e43043 -->
## /v1/master/customers
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/customers", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/customers`


<!-- END_7bf388730f97796943e22dd1c2e43043 -->

<!-- START_8f519877a6b30bf93c9713470c3016b2 -->
## /v1/master/customers/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/customers/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{}
```

### HTTP Request
`GET /v1/master/customers/autocomplete`


<!-- END_8f519877a6b30bf93c9713470c3016b2 -->

<!-- START_f61e2214c59a57abd93818bf847a2afd -->
## /v1/master/customers
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/customers", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "cus_name" => "veniam",
            "cus_birthday" => "esse",
            "cus_email" => "eveniet",
            "cus_phone" => "occaecati",
            "cus_address" => "vel",
            "cus_prov_code" => "suscipit",
            "cus_reg_code" => "aut",
            "cus_postal_code" => "eaque",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "cus_name": "veniam",
    "cus_birthday": "esse",
    "cus_email": "eveniet",
    "cus_phone": "occaecati",
    "cus_address": "vel",
    "cus_prov_code": "suscipit",
    "cus_reg_code": "aut",
    "cus_postal_code": "eaque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/customers`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    cus_name | string |  required  | Deskripsi.
    cus_birthday | date |  optional  | optional Deskripsi.
    cus_email | string |  optional  | optional Deskripsi.
    cus_phone | string |  required  | Deskripsi.
    cus_address | string |  optional  | optional Deskripsi.
    cus_prov_code | string |  optional  | optional Deskripsi.
    cus_reg_code | string |  optional  | optional Deskripsi.
    cus_postal_code | string |  required  | Deskripsi.

<!-- END_f61e2214c59a57abd93818bf847a2afd -->

<!-- START_da8bd7e77f46a0b7c5f78b7f42ade4ca -->
## /v1/master/customers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/customers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "cus_uuid" => "aperiam",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers/1");

    let params = {
            "cus_uuid": "aperiam",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/customers/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    cus_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_da8bd7e77f46a0b7c5f78b7f42ade4ca -->

<!-- START_5317884ee03b2994db6aa666ed9a21dd -->
## /v1/master/customers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/customers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "cus_uuid" => "perferendis",
        ],
    'json' => [
            "cus_name" => "ut",
            "cus_birthday" => "enim",
            "cus_email" => "deserunt",
            "cus_phone" => "ipsum",
            "cus_address" => "distinctio",
            "cus_prov_code" => "dolorem",
            "cus_reg_code" => "architecto",
            "cus_postal_code" => "repudiandae",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers/1");

    let params = {
            "cus_uuid": "perferendis",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "cus_name": "ut",
    "cus_birthday": "enim",
    "cus_email": "deserunt",
    "cus_phone": "ipsum",
    "cus_address": "distinctio",
    "cus_prov_code": "dolorem",
    "cus_reg_code": "architecto",
    "cus_postal_code": "repudiandae"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/customers/{uuid}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    cus_name | string |  required  | Deskripsi.
    cus_birthday | date |  optional  | optional Deskripsi.
    cus_email | string |  optional  | optional Deskripsi.
    cus_phone | string |  required  | Deskripsi.
    cus_address | string |  optional  | optional Deskripsi.
    cus_prov_code | string |  optional  | optional Deskripsi.
    cus_reg_code | string |  optional  | optional Deskripsi.
    cus_postal_code | string |  required  | Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    cus_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_5317884ee03b2994db6aa666ed9a21dd -->

<!-- START_87478c24d2055bd57832fd8c2bdefbb5 -->
## /v1/master/customers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/customers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "cus_uuid" => "quia",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/customers/1");

    let params = {
            "cus_uuid": "quia",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/customers/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    cus_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_87478c24d2055bd57832fd8c2bdefbb5 -->

<!-- START_7f41c7f8b9cedf201f80e139f0c1f18c -->
## /v1/master/suppliers
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/suppliers", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/suppliers`


<!-- END_7f41c7f8b9cedf201f80e139f0c1f18c -->

<!-- START_b5fb92500144e3f4440d42c52c7a25fa -->
## /v1/master/suppliers/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/suppliers/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{}
```

### HTTP Request
`GET /v1/master/suppliers/autocomplete`


<!-- END_b5fb92500144e3f4440d42c52c7a25fa -->

<!-- START_106d591e3b401dafc6b34a04ce6434b7 -->
## /v1/master/suppliers
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/suppliers", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "sup_name" => "iste",
            "sup_birthday" => "placeat",
            "sup_email" => "quae",
            "sup_phone" => "libero",
            "sup_address" => "ut",
            "sup_prov_code" => "aut",
            "sup_reg_code" => "natus",
            "sup_postal_code" => "eveniet",
            "sup_contact" => "eaque",
            "sup_contact_phone" => "numquam",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "sup_name": "iste",
    "sup_birthday": "placeat",
    "sup_email": "quae",
    "sup_phone": "libero",
    "sup_address": "ut",
    "sup_prov_code": "aut",
    "sup_reg_code": "natus",
    "sup_postal_code": "eveniet",
    "sup_contact": "eaque",
    "sup_contact_phone": "numquam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/suppliers`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sup_name | string |  required  | Deskripsi.
    sup_birthday | date |  optional  | optional Deskripsi.
    sup_email | string |  optional  | optional Deskripsi.
    sup_phone | string |  required  | Deskripsi.
    sup_address | string |  required  | Deskripsi.
    sup_prov_code | string |  required  | Deskripsi.
    sup_reg_code | string |  required  | Deskripsi.
    sup_postal_code | string |  required  | Deskripsi.
    sup_contact | string |  optional  | optional Deskripsi.
    sup_contact_phone | string |  optional  | optional Deskripsi.

<!-- END_106d591e3b401dafc6b34a04ce6434b7 -->

<!-- START_475d4cada22a43a56b4982a3c0a52ca1 -->
## /v1/master/suppliers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/suppliers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "sup_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers/1");

    let params = {
            "sup_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/suppliers/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    sup_uuid |  required  | UUID

<!-- END_475d4cada22a43a56b4982a3c0a52ca1 -->

<!-- START_c206fd64b2fee1f16587c03c61e1811d -->
## /v1/master/suppliers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/suppliers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "sup_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
    'json' => [
            "sup_name" => "non",
            "sup_birthday" => "et",
            "sup_email" => "fuga",
            "sup_phone" => "quidem",
            "sup_address" => "nostrum",
            "sup_prov_code" => "est",
            "sup_reg_code" => "vel",
            "sup_postal_code" => "ut",
            "sup_contact" => "tempora",
            "sup_contact_phone" => "perferendis",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers/1");

    let params = {
            "sup_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "sup_name": "non",
    "sup_birthday": "et",
    "sup_email": "fuga",
    "sup_phone": "quidem",
    "sup_address": "nostrum",
    "sup_prov_code": "est",
    "sup_reg_code": "vel",
    "sup_postal_code": "ut",
    "sup_contact": "tempora",
    "sup_contact_phone": "perferendis"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/suppliers/{uuid}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sup_name | string |  required  | Deskripsi.
    sup_birthday | date |  optional  | optional Deskripsi.
    sup_email | string |  optional  | optional Deskripsi.
    sup_phone | string |  required  | Deskripsi.
    sup_address | string |  required  | Deskripsi.
    sup_prov_code | string |  required  | Deskripsi.
    sup_reg_code | string |  required  | Deskripsi.
    sup_postal_code | string |  required  | Deskripsi.
    sup_contact | string |  optional  | optional Deskripsi.
    sup_contact_phone | string |  optional  | optional Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    sup_uuid |  required  | UUID.

<!-- END_c206fd64b2fee1f16587c03c61e1811d -->

<!-- START_732a047bdad313dcfeee453aff85d3d1 -->
## /v1/master/suppliers/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/suppliers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "sup_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/suppliers/1");

    let params = {
            "sup_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/suppliers/{uuid}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    sup_uuid |  required  | UUID.

<!-- END_732a047bdad313dcfeee453aff85d3d1 -->

<!-- START_4017b7a6dea187d4495d39ca25da48ed -->
## /v1/master/taxes
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/taxes", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/taxes");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/taxes`


<!-- END_4017b7a6dea187d4495d39ca25da48ed -->

<!-- START_40d6eca97ec7a1d8e3f159d5963a84f2 -->
## /v1/master/taxes
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/taxes", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "tax_name" => "nesciunt",
            "tax_rate" => "delectus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/taxes");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "tax_name": "nesciunt",
    "tax_rate": "delectus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/taxes`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    tax_name | string |  required  | Deskripsi.
    tax_rate | decimal |  required  | Deskripsi.

<!-- END_40d6eca97ec7a1d8e3f159d5963a84f2 -->

<!-- START_947db6c027f6f865dfb5154457a10115 -->
## /v1/master/taxes/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/taxes/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "tax_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/taxes/1");

    let params = {
            "tax_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/taxes/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    tax_uuid |  required  | UUID.

<!-- END_947db6c027f6f865dfb5154457a10115 -->

<!-- START_288f5855b83a362cd3500d53a3269f4d -->
## /v1/master/taxes/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/taxes/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "tax_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
    'json' => [
            "tax_name" => "necessitatibus",
            "tax_rate" => "inventore",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/taxes/1");

    let params = {
            "tax_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "tax_name": "necessitatibus",
    "tax_rate": "inventore"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/taxes/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    tax_name | string |  required  | Deskripsi.
    tax_rate | decimal |  required  | Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    tax_uuid |  required  | UUID.

<!-- END_288f5855b83a362cd3500d53a3269f4d -->

<!-- START_470e2c5753c39ab3f617bce8d2739c62 -->
## /v1/master/taxes/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/taxes/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "tax_uuid" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/taxes/1");

    let params = {
            "tax_uuid": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/taxes/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    tax_uuid |  required  | UUID.

<!-- END_470e2c5753c39ab3f617bce8d2739c62 -->

<!-- START_5ad2ca28ba3803db1fe081bbb64a014b -->
## /v1/master/employees
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/employees", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/employees");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/employees`


<!-- END_5ad2ca28ba3803db1fe081bbb64a014b -->

<!-- START_31538a761b6ad442c548e28c83709eba -->
## /v1/master/employees
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/employees", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "emp_out_id" => "10",
            "emp_type" => "enim",
            "emp_name" => "qui",
            "emp_email" => "illum",
            "emp_phone" => "minima",
            "emp_pin" => "ut",
            "emp_enabled" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/employees");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "emp_out_id": 10,
    "emp_type": "enim",
    "emp_name": "qui",
    "emp_email": "illum",
    "emp_phone": "minima",
    "emp_pin": "ut",
    "emp_enabled": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/employees`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    emp_out_id | integer |  required  | Deskripsi.
    emp_type | string |  required  | Deskripsi.
    emp_name | string |  required  | Deskripsi.
    emp_email | string |  required  | Deskripsi.
    emp_phone | string |  required  | Deskripsi.
    emp_pin | string |  required  | Deskripsi.
    emp_enabled | boolean |  required  | Default true.

<!-- END_31538a761b6ad442c548e28c83709eba -->

<!-- START_738df835cf2c993c3820d637c4019a69 -->
## /v1/master/employees/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/employees/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "emp_id" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/employees/1");

    let params = {
            "emp_id": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/employees/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    emp_id |  required  | UUID.

<!-- END_738df835cf2c993c3820d637c4019a69 -->

<!-- START_864e6b6f6dce8bcd87298a153679dc01 -->
## /v1/master/employees/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/employees/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "emp_id" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
    'json' => [
            "emp_out_id" => "11",
            "emp_type" => "aut",
            "emp_name" => "doloremque",
            "emp_email" => "voluptatum",
            "emp_phone" => "repudiandae",
            "emp_pin" => "nulla",
            "emp_enabled" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/employees/1");

    let params = {
            "emp_id": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "emp_out_id": 11,
    "emp_type": "aut",
    "emp_name": "doloremque",
    "emp_email": "voluptatum",
    "emp_phone": "repudiandae",
    "emp_pin": "nulla",
    "emp_enabled": true
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/employees/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    emp_out_id | integer |  required  | Deskripsi.
    emp_type | string |  required  | Deskripsi.
    emp_name | string |  required  | Deskripsi.
    emp_email | string |  required  | Deskripsi.
    emp_phone | string |  required  | Deskripsi.
    emp_pin | string |  required  | Deskripsi.
    emp_enabled | boolean |  required  | Default true.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    emp_id |  required  | UUID.

<!-- END_864e6b6f6dce8bcd87298a153679dc01 -->

<!-- START_3e43e6088a0ff4ff0520b737294ee186 -->
## /v1/master/employees/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/employees/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "emp_id" => "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/employees/1");

    let params = {
            "emp_id": "91e3c6f7-cec6-4eda-834e-48438f853ffa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/employees/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    emp_id |  required  | UUID.

<!-- END_3e43e6088a0ff4ff0520b737294ee186 -->

#POS
<!-- START_8248a04bb72e66b91ea2676a363d53a3 -->
## /v1/pos/customers/{company_id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/pos/customers/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/customers/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/pos/customers/{company_id}`


<!-- END_8248a04bb72e66b91ea2676a363d53a3 -->

<!-- START_ef9d2f463bc51c40a7030ead58ea51bc -->
## /v1/pos/customers
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/pos/customers", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "cus_comp_id" => "12",
            "cus_name" => "numquam",
            "cus_birthday" => "exercitationem",
            "cus_email" => "voluptatem",
            "cus_phone" => "enim",
            "cus_address" => "at",
            "cus_prov_code" => "eveniet",
            "cus_reg_code" => "suscipit",
            "cus_postal_code" => "dicta",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/customers");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "cus_comp_id": 12,
    "cus_name": "numquam",
    "cus_birthday": "exercitationem",
    "cus_email": "voluptatem",
    "cus_phone": "enim",
    "cus_address": "at",
    "cus_prov_code": "eveniet",
    "cus_reg_code": "suscipit",
    "cus_postal_code": "dicta"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/pos/customers`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    cus_comp_id | integer |  required  | Deskripsi.
    cus_name | string |  required  | Deskripsi.
    cus_birthday | date |  optional  | optional Deskripsi.
    cus_email | string |  optional  | optional Deskripsi.
    cus_phone | string |  required  | Deskripsi.
    cus_address | string |  optional  | optional Deskripsi.
    cus_prov_code | string |  optional  | optional Deskripsi.
    cus_reg_code | string |  optional  | optional Deskripsi.
    cus_postal_code | string |  required  | Deskripsi.

<!-- END_ef9d2f463bc51c40a7030ead58ea51bc -->

<!-- START_55f2dd2c9db2c23a6ad3439000b01b8e -->
## /v1/pos/products
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/pos/products", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/products");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/pos/products`


<!-- END_55f2dd2c9db2c23a6ad3439000b01b8e -->

#POS TRANSACTION
<!-- START_244061e130ee88703d08a904f3fd363f -->
## /v1/pos/transactions
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/pos/transactions", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/transactions");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/pos/transactions`


<!-- END_244061e130ee88703d08a904f3fd363f -->

<!-- START_144375b4b336ce915ae525b3219ee7d4 -->
## /v1/pos/transactions/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/pos/transactions/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/transactions/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/pos/transactions/{uuid}`


<!-- END_144375b4b336ce915ae525b3219ee7d4 -->

<!-- START_9170fae7905897435be37b94283ee8d2 -->
## /v1/pos/transactions/{uuid}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/pos/transactions/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/pos/transactions/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/pos/transactions/{uuid}`


<!-- END_9170fae7905897435be37b94283ee8d2 -->

#Products
<!-- START_0e8b80b747920b92452c4a7ec59c587b -->
## /v1/master/merks
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/merks", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/merks");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/merks`


<!-- END_0e8b80b747920b92452c4a7ec59c587b -->

<!-- START_0dd188f3aa7bc7a720c5249bff9388c7 -->
## /v1/master/merks
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/merks", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "prodmerk_outlet_id" => "6",
            "prodmerk_name" => "natus",
            "prodmerk_description" => "in",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/merks");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prodmerk_outlet_id": 6,
    "prodmerk_name": "natus",
    "prodmerk_description": "in"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/merks`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prodmerk_outlet_id | integer |  required  | Deskripsi.
    prodmerk_name | string |  required  | Deskripsi.
    prodmerk_description | string |  optional  | optional Deskripsi.

<!-- END_0dd188f3aa7bc7a720c5249bff9388c7 -->

<!-- START_51949564f1a1d7c7824dc1494cade532 -->
## /v1/master/merks/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/merks/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prodmerk_uuid" => "hic",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/merks/1");

    let params = {
            "prodmerk_uuid": "hic",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/merks/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodmerk_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_51949564f1a1d7c7824dc1494cade532 -->

<!-- START_bb3a33dfd70aa7ae0fec07be97e3a761 -->
## /v1/master/merks/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/merks/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prodmerk_uuid" => "nam",
        ],
    'json' => [
            "prodmerk_outlet_id" => "7",
            "prodmerk_name" => "voluptatem",
            "prodmerk_description" => "neque",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/merks/1");

    let params = {
            "prodmerk_uuid": "nam",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prodmerk_outlet_id": 7,
    "prodmerk_name": "voluptatem",
    "prodmerk_description": "neque"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/merks/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prodmerk_outlet_id | integer |  required  | Deskripsi.
    prodmerk_name | string |  required  | Deskripsi.
    prodmerk_description | string |  optional  | optional Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodmerk_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_bb3a33dfd70aa7ae0fec07be97e3a761 -->

<!-- START_363f9223e6d4cbdec28744ac3d2ea046 -->
## /v1/master/merks/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/merks/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prodmerk_uuid" => "doloribus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/merks/1");

    let params = {
            "prodmerk_uuid": "doloribus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/merks/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodmerk_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_363f9223e6d4cbdec28744ac3d2ea046 -->

<!-- START_38fdb19023e131a1050dfa23724cd749 -->
## /v1/master/categories
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/categories", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/categories");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/categories`


<!-- END_38fdb19023e131a1050dfa23724cd749 -->

<!-- START_e5ce362fe0800c51879105d572f4a8c6 -->
## /v1/master/categories
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/categories", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "prodcat_outlet_id" => "13",
            "prodcat_code" => "magni",
            "prodcat_name" => "veritatis",
            "prodcat_description" => "rerum",
            "prodcat_label" => "dolor",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/categories");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prodcat_outlet_id": 13,
    "prodcat_code": "magni",
    "prodcat_name": "veritatis",
    "prodcat_description": "rerum",
    "prodcat_label": "dolor"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/categories`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prodcat_outlet_id | integer |  required  | Deskripsi.
    prodcat_code | string |  optional  | optional Deskripsi.
    prodcat_name | string |  required  | Deskripsi.
    prodcat_description | string |  optional  | optional Deskripsi.
    prodcat_label | string |  optional  | optional Deskripsi.

<!-- END_e5ce362fe0800c51879105d572f4a8c6 -->

<!-- START_bedcb632b852c68d99503c881d6d110e -->
## /v1/master/categories/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/categories/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prodcat_uuid" => "culpa",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/categories/1");

    let params = {
            "prodcat_uuid": "culpa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/categories/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodcat_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_bedcb632b852c68d99503c881d6d110e -->

<!-- START_5fa5f97741b546d05a30b62dd813e448 -->
## /v1/master/categories/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/categories/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prodcat_uuid" => "possimus",
        ],
    'json' => [
            "prodcat_outlet_id" => "13",
            "prodcat_code" => "illum",
            "prodcat_name" => "qui",
            "prodcat_description" => "omnis",
            "prodcat_label" => "ipsam",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/categories/1");

    let params = {
            "prodcat_uuid": "possimus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prodcat_outlet_id": 13,
    "prodcat_code": "illum",
    "prodcat_name": "qui",
    "prodcat_description": "omnis",
    "prodcat_label": "ipsam"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/categories/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prodcat_outlet_id | integer |  required  | Deskripsi.
    prodcat_code | string |  optional  | optional Deskripsi.
    prodcat_name | string |  required  | Deskripsi.
    prodcat_description | string |  optional  | optional Deskripsi.
    prodcat_label | string |  optional  | optional Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodcat_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_5fa5f97741b546d05a30b62dd813e448 -->

<!-- START_399c771e0fb92039fd224e5d93451454 -->
## /v1/master/categories/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/categories/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prodcat_uuid" => "qui",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/categories/1");

    let params = {
            "prodcat_uuid": "qui",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/categories/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prodcat_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_399c771e0fb92039fd224e5d93451454 -->

<!-- START_e0702787c3d679f24e154530ced9237f -->
## /v1/master/products
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/products", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/master/products`


<!-- END_e0702787c3d679f24e154530ced9237f -->

<!-- START_694b794f999fe161944638d1c8dc481b -->
## /v1/master/products/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/products/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/products/autocomplete`


<!-- END_694b794f999fe161944638d1c8dc481b -->

<!-- START_92e0caebcee8e55d57cd9a151d78e22c -->
## /v1/master/products/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/master/products/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prod_uuid" => "hic",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products/1");

    let params = {
            "prod_uuid": "hic",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/master/products/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prod_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_92e0caebcee8e55d57cd9a151d78e22c -->

<!-- START_fa10fe0016cc5e71d8309e8601b63ea5 -->
## /v1/master/products
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/master/products", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "prod_outlet_id" => "17",
            "prod_category_id" => "13",
            "prod_merk_id" => "9",
            "prod_name" => "sunt",
            "prod_sku" => "iste",
            "prod_unit" => "sapiente",
            "prod_description" => "accusantium",
            "prod_price_sell" => "20274.169",
            "prod_price_purchase" => "751.33412",
            "prod_serial" => "eius",
            "prod_barcode" => "sed",
            "prod_stock" => "1",
            "prod_image" => "corrupti",
            "prod_is_sell" => "1",
            "prod_enabled" => "1",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prod_outlet_id": 17,
    "prod_category_id": 13,
    "prod_merk_id": 9,
    "prod_name": "sunt",
    "prod_sku": "iste",
    "prod_unit": "sapiente",
    "prod_description": "accusantium",
    "prod_price_sell": 20274.169,
    "prod_price_purchase": 751.33412,
    "prod_serial": "eius",
    "prod_barcode": "sed",
    "prod_stock": 1,
    "prod_image": "corrupti",
    "prod_is_sell": true,
    "prod_enabled": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/master/products`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prod_outlet_id | integer |  required  | Deskripsi.
    prod_category_id | integer |  required  | Deskripsi.
    prod_merk_id | integer |  required  | Deskripsi.
    prod_name | string |  required  | Deskripsi.
    prod_sku | string |  optional  | optional Deskripsi.
    prod_unit | string |  optional  | optional Deskripsi.
    prod_description | string |  optional  | optional Deskripsi.
    prod_price_sell | float |  required  | Deskripsi.
    prod_price_purchase | float |  required  | Deskripsi.
    prod_serial | string |  optional  | optional Deskripsi.
    prod_barcode | string |  optional  | optional Deskripsi.
    prod_stock | integer |  required  | Default 0.
    prod_image | file |  optional  | optional Deskripsi.
    prod_is_sell | boolean |  required  | Default true.
    prod_enabled | boolean |  required  | Default true.

<!-- END_fa10fe0016cc5e71d8309e8601b63ea5 -->

<!-- START_e786f2d4138d3c221d970fdaa8d2e2ac -->
## /v1/master/products/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/products/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prod_uuid" => "maxime",
        ],
    'json' => [
            "prod_outlet_id" => "6",
            "prod_category_id" => "1",
            "prod_merk_id" => "8",
            "prod_name" => "consequatur",
            "prod_sku" => "nostrum",
            "prod_unit" => "eos",
            "prod_description" => "reiciendis",
            "prod_price_sell" => "647.06",
            "prod_price_purchase" => "6052.854272",
            "prod_serial" => "voluptates",
            "prod_barcode" => "unde",
            "prod_stock" => "12",
            "prod_image" => "nobis",
            "prod_is_sell" => "1",
            "prod_enabled" => "",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products/1");

    let params = {
            "prod_uuid": "maxime",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prod_outlet_id": 6,
    "prod_category_id": 1,
    "prod_merk_id": 8,
    "prod_name": "consequatur",
    "prod_sku": "nostrum",
    "prod_unit": "eos",
    "prod_description": "reiciendis",
    "prod_price_sell": 647.06,
    "prod_price_purchase": 6052.854272,
    "prod_serial": "voluptates",
    "prod_barcode": "unde",
    "prod_stock": 12,
    "prod_image": "nobis",
    "prod_is_sell": true,
    "prod_enabled": false
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/products/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prod_outlet_id | integer |  required  | Deskripsi.
    prod_category_id | integer |  required  | Deskripsi.
    prod_merk_id | integer |  required  | Deskripsi.
    prod_name | string |  required  | Deskripsi.
    prod_sku | string |  optional  | optional Deskripsi.
    prod_unit | string |  optional  | optional Deskripsi.
    prod_description | string |  optional  | optional Deskripsi.
    prod_price_sell | float |  required  | Deskripsi.
    prod_price_purchase | float |  required  | Deskripsi.
    prod_serial | string |  optional  | optional Deskripsi.
    prod_barcode | string |  optional  | optional Deskripsi.
    prod_stock | integer |  required  | Default 0.
    prod_image | file |  optional  | optional Deskripsi.
    prod_is_sell | boolean |  required  | Default true.
    prod_enabled | boolean |  required  | Default true.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prod_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_e786f2d4138d3c221d970fdaa8d2e2ac -->

<!-- START_de325db061eea0abdcca08639146dba7 -->
## /v1/master/products/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/master/products/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prod_uuid" => "dolor",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products/1");

    let params = {
            "prod_uuid": "dolor",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/master/products/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prod_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_de325db061eea0abdcca08639146dba7 -->

<!-- START_32249b6575a5ccac7c9f47a6cd0df010 -->
## /v1/master/products/status/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/master/products/status/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prod_uuid" => "quidem",
        ],
    'json' => [
            "prod_enabled" => "",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/master/products/status/1");

    let params = {
            "prod_uuid": "quidem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prod_enabled": false
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/master/products/status/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prod_enabled | boolean |  required  | Default true.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prod_uuid |  required  | Example: 91e3c6f7-cec6-4eda-834e-48438f853ffa

<!-- END_32249b6575a5ccac7c9f47a6cd0df010 -->

#Purchase Order
<!-- START_4ac7ad41b878b342ef2e0f3f8ee067e2 -->
## /v1/transaction/purchases
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/transaction/purchases", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/transaction/purchases");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/transaction/purchases`


<!-- END_4ac7ad41b878b342ef2e0f3f8ee067e2 -->

<!-- START_d8788d378af15a9a6a837717a6b869f3 -->
## /v1/transaction/purchases
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/transaction/purchases", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "out_name" => "non",
            "out_email" => "unde",
            "out_phone" => "delectus",
            "out_address" => "quis",
            "out_prov_code" => "expedita",
            "out_reg_code" => "sint",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/transaction/purchases");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "out_name": "non",
    "out_email": "unde",
    "out_phone": "delectus",
    "out_address": "quis",
    "out_prov_code": "expedita",
    "out_reg_code": "sint"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/transaction/purchases`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    out_name | string |  required  | Deskripsi.
    out_email | string |  required  | Deskripsi.
    out_phone | string |  required  | Deskripsi.
    out_address | string |  optional  | optional Deskripsi.
    out_prov_code | string |  optional  | optional Deskripsi.
    out_reg_code | string |  optional  | optional Deskripsi.

<!-- END_d8788d378af15a9a6a837717a6b869f3 -->

#References
<!-- START_2361c1b6bfb2d99b31080b3dceaa947e -->
## /v1/reference/business
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/business", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/business`


<!-- END_2361c1b6bfb2d99b31080b3dceaa947e -->

<!-- START_cdf302f93f3c7ed9fc999bf18fe785fe -->
## /v1/reference/business/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/business/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/business/autocomplete`


<!-- END_cdf302f93f3c7ed9fc999bf18fe785fe -->

<!-- START_7ca2628860bcdb53bc0e2edf321062be -->
## /v1/reference/business
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/reference/business", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "ub_name" => "quam",
            "ub_description" => "deserunt",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "ub_name": "quam",
    "ub_description": "deserunt"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/reference/business`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    ub_name | string |  required  | Deskripsi.
    ub_description | string |  optional  | optional Deskripsi.

<!-- END_7ca2628860bcdb53bc0e2edf321062be -->

<!-- START_085c037bc7d16d700e02d0538df569a8 -->
## /v1/reference/business/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/business/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "ub_id" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business/1");

    let params = {
            "ub_id": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/business/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    ub_id |  optional  | integer ID Unit Bisnis.

<!-- END_085c037bc7d16d700e02d0538df569a8 -->

<!-- START_01606743ee44e21de46aa8ff1f259cfa -->
## /v1/reference/business/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/reference/business/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "ub_id" => "11",
        ],
    'json' => [
            "ub_name" => "fugiat",
            "ub_description" => "autem",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business/1");

    let params = {
            "ub_id": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "ub_name": "fugiat",
    "ub_description": "autem"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/reference/business/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    ub_name | string |  required  | Deskripsi.
    ub_description | string |  optional  | optional Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    ub_id |  required  | ID Unit Bisnis.

<!-- END_01606743ee44e21de46aa8ff1f259cfa -->

<!-- START_0013c89d7c6aee8d94ae5d047600a8d1 -->
## /v1/reference/business/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/reference/business/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "ub_id" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/business/1");

    let params = {
            "ub_id": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/reference/business/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    ub_id |  required  | ID Unit Bisnis.

<!-- END_0013c89d7c6aee8d94ae5d047600a8d1 -->

<!-- START_70a05e22d7b82ae59cae464331d5859f -->
## /v1/reference/provinces
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/provinces", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/provinces`


<!-- END_70a05e22d7b82ae59cae464331d5859f -->

<!-- START_630e5ee3d01dcd826104da1f644d05d2 -->
## /v1/reference/provinces/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/provinces/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/provinces/autocomplete`


<!-- END_630e5ee3d01dcd826104da1f644d05d2 -->

<!-- START_e9a801c746b641f4f8addd3f2b7b69f7 -->
## /v1/reference/provinces
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/reference/provinces", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "prov_code" => "molestiae",
            "prov_name" => "quam",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prov_code": "molestiae",
    "prov_name": "quam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/reference/provinces`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prov_code | string |  required  | Deskripsi.
    prov_name | string |  required  | Deskripsi.

<!-- END_e9a801c746b641f4f8addd3f2b7b69f7 -->

<!-- START_57fe412e046abb222f24c5e96dd2e1bf -->
## /v1/reference/provinces/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/provinces/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/provinces/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_57fe412e046abb222f24c5e96dd2e1bf -->

<!-- START_a77f1a662cdbd195b4008787657d15b2 -->
## /v1/reference/provinces/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/reference/provinces/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
    'json' => [
            "prov_code" => "velit",
            "prov_name" => "rerum",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prov_code": "velit",
    "prov_name": "rerum"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/reference/provinces/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prov_code | string |  required  | Deskripsi.
    prov_name | string |  required  | Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_a77f1a662cdbd195b4008787657d15b2 -->

<!-- START_cb34e22eda1e7bb990fb0f3ff23f79b8 -->
## /v1/reference/provinces/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/reference/provinces/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/provinces/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/reference/provinces/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_cb34e22eda1e7bb990fb0f3ff23f79b8 -->

<!-- START_7049d917ded7c7a2264d7dbc310b27f5 -->
## /v1/reference/regions
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/regions", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/regions`


<!-- END_7049d917ded7c7a2264d7dbc310b27f5 -->

<!-- START_7d4e84c208e53b3c54d3c7f5448db5be -->
## /v1/reference/regions
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/reference/regions", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "user_id" => "me",
        ],
    'json' => [
            "reg_code" => "est",
            "reg_prov_code" => "rerum",
            "reg_name" => "commodi",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions");

    let params = {
            "user_id": "me",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "reg_code": "est",
    "reg_prov_code": "rerum",
    "reg_name": "commodi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/reference/regions`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    reg_code | string |  required  | The title of the post.
    reg_prov_code | string |  required  | The title of the post.
    reg_name | string |  required  | The title of the post.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user_id |  required  | The id of the user.

<!-- END_7d4e84c208e53b3c54d3c7f5448db5be -->

<!-- START_ee35c2fa9a2cc4af5db2cbf115e819e4 -->
## /v1/reference/regions/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/regions/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/regions/{id}`


<!-- END_ee35c2fa9a2cc4af5db2cbf115e819e4 -->

<!-- START_ee43116a5f03a9a6177247b360d5340e -->
## /v1/reference/regions/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/reference/regions/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/reference/regions/{id}`


<!-- END_ee43116a5f03a9a6177247b360d5340e -->

<!-- START_c514d225e584ebcbaee76a0d214daf02 -->
## /v1/reference/regions/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/reference/regions/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/reference/regions/{id}`


<!-- END_c514d225e584ebcbaee76a0d214daf02 -->

<!-- START_89664d734d9e51db1534ca8eabeab8ec -->
## /v1/reference/regions/autocomplete/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/regions/autocomplete/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/regions/autocomplete/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/regions/autocomplete/{id}`


<!-- END_89664d734d9e51db1534ca8eabeab8ec -->

<!-- START_621ff5c7e4ba133637c11a360333d49d -->
## /v1/reference/payterms
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/payterms", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/payterms`


<!-- END_621ff5c7e4ba133637c11a360333d49d -->

<!-- START_3bb453cdc9da1c3d1098f05168d001a9 -->
## /v1/reference/payterms/autocomplete
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/payterms/autocomplete", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms/autocomplete");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/reference/payterms/autocomplete`


<!-- END_3bb453cdc9da1c3d1098f05168d001a9 -->

<!-- START_d3778df1e9c48709de0895776c62b200 -->
## /v1/reference/payterms
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/reference/payterms", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "prov_code" => "minus",
            "prov_name" => "sit",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prov_code": "minus",
    "prov_name": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/reference/payterms`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prov_code | string |  required  | Deskripsi.
    prov_name | string |  required  | Deskripsi.

<!-- END_d3778df1e9c48709de0895776c62b200 -->

<!-- START_c2dcf4f033c4ce6efd31f5f01d73c443 -->
## /v1/reference/payterms/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/reference/payterms/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Data found",
    "data": []
}
```

### HTTP Request
`GET /v1/reference/payterms/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_c2dcf4f033c4ce6efd31f5f01d73c443 -->

<!-- START_11b3fa0912c1055c3bd3b0618fb3a1f6 -->
## /v1/reference/payterms/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/reference/payterms/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
    'json' => [
            "prov_code" => "delectus",
            "prov_name" => "vitae",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "prov_code": "delectus",
    "prov_name": "vitae"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/reference/payterms/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    prov_code | string |  required  | Deskripsi.
    prov_name | string |  required  | Deskripsi.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_11b3fa0912c1055c3bd3b0618fb3a1f6 -->

<!-- START_95fe111ed3ea4d6ee9b4a76b085730ad -->
## /v1/reference/payterms/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/reference/payterms/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
    'query' => [
            "prov_code" => "11",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/reference/payterms/1");

    let params = {
            "prov_code": "11",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/reference/payterms/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    prov_code |  required  | kode provinsi.

<!-- END_95fe111ed3ea4d6ee9b4a76b085730ad -->

#User Management
API's for user management
<!-- START_9518d65b70d30a13b915a5a8df184fd5 -->
## /v1/auth/login
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/auth/login", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "amet",
            "password" => "sit",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/login");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "email": "amet",
    "password": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | Email User
    password | string |  required  | Password User

<!-- END_9518d65b70d30a13b915a5a8df184fd5 -->

<!-- START_047c448081bc96227c0ce6e9a8d849ff -->
## /v1/auth/register
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/auth/register", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "comp_ub_id" => "19",
            "comp_name" => "voluptas",
            "comp_email" => "maxime",
            "comp_phone" => "quod",
            "password" => "quia",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/register");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "comp_ub_id": 19,
    "comp_name": "voluptas",
    "comp_email": "maxime",
    "comp_phone": "quod",
    "password": "quia"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/auth/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    comp_ub_id | integer |  required  | Jenis Usaha
    comp_name | string |  required  | Nama Usaha/ Toko
    comp_email | string |  required  | Email Usaha/ Toko
    comp_phone | string |  required  | Telepon Usaha/ Toko
    password | string |  required  | Password User

<!-- END_047c448081bc96227c0ce6e9a8d849ff -->

<!-- START_09316901289ec170fde4e32c5cd5a262 -->
## /v1/auth/detail
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/auth/detail", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/detail");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "success",
    "data": {
        "id": 2,
        "username": null,
        "email": "anu@anune.com",
        "name": "PT ANUNE SOPO",
        "activation_token": "3fKdnvmftSiQ9d2W7ub5V5HgmeCJYZV6",
        "enabled": false,
        "type": "c",
        "value_id": 2,
        "login_at": null,
        "created_at": "2019-05-28 10:38:06",
        "updated_at": "2019-05-28 10:38:06",
        "deleted_at": null
    }
}
```

### HTTP Request
`GET /v1/auth/detail`


<!-- END_09316901289ec170fde4e32c5cd5a262 -->

<!-- START_35e001bb3a2a069220a0c734f3afdfee -->
## /v1/auth/logout
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/auth/logout", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/logout");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "User logged out successfully",
    "data": ""
}
```

### HTTP Request
`GET /v1/auth/logout`


<!-- END_35e001bb3a2a069220a0c734f3afdfee -->

#User Management
API's for user management kasir in pos
<!-- START_03fc2204b774d72b29bd37f06ff788f0 -->
## /v1/auth/login-kasir
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/auth/login-kasir", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "illum",
            "password" => "eveniet",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/login-kasir");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    "email": "illum",
    "password": "eveniet"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/auth/login-kasir`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | Email User
    password | string |  required  | Password User

<!-- END_03fc2204b774d72b29bd37f06ff788f0 -->

<!-- START_51cb0b18b3377935ead12520798a515e -->
## /v1/auth/detail-kasir
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/auth/detail-kasir", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/auth/detail-kasir");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "success",
    "data": {
        "id": 2,
        "username": null,
        "email": "anu@anune.com",
        "name": "PT ANUNE SOPO",
        "activation_token": "3fKdnvmftSiQ9d2W7ub5V5HgmeCJYZV6",
        "enabled": false,
        "type": "c",
        "value_id": 2,
        "login_at": null,
        "created_at": "2019-05-28 10:38:06",
        "updated_at": "2019-05-28 10:38:06",
        "deleted_at": null
    }
}
```

### HTTP Request
`GET /v1/auth/detail-kasir`


<!-- END_51cb0b18b3377935ead12520798a515e -->

#general
<!-- START_996d86f352db3859ecfdfed7cbc2bfe3 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/oauth/token", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/token");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/oauth/token`


<!-- END_996d86f352db3859ecfdfed7cbc2bfe3 -->

<!-- START_28935cf66c092fab26080de924730010 -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/oauth/tokens", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/tokens");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/oauth/tokens`


<!-- END_28935cf66c092fab26080de924730010 -->

<!-- START_f4ddcf957297c641d796a13b6ca8da59 -->
## Delete the given token.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/oauth/tokens/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/tokens/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/oauth/tokens/{token_id}`


<!-- END_f4ddcf957297c641d796a13b6ca8da59 -->

<!-- START_b6e6f9100f70dfac269ee3e1bee2d451 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/oauth/token/refresh", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/token/refresh");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/oauth/token/refresh`


<!-- END_b6e6f9100f70dfac269ee3e1bee2d451 -->

<!-- START_38ce9e2a78254a3b242a42ac0f810085 -->
## Get all of the clients for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/oauth/clients", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/clients");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/oauth/clients`


<!-- END_38ce9e2a78254a3b242a42ac0f810085 -->

<!-- START_127f70529ea651a3815279e91508935c -->
## Store a new client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/oauth/clients", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/clients");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/oauth/clients`


<!-- END_127f70529ea651a3815279e91508935c -->

<!-- START_741e41b173f0ee91368d0f5558cdab37 -->
## Update the given client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost//v1/oauth/clients/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/clients/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /v1/oauth/clients/{client_id}`


<!-- END_741e41b173f0ee91368d0f5558cdab37 -->

<!-- START_a1f8507923718086f5f1b5582168ae63 -->
## Delete the given client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/oauth/clients/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/clients/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/oauth/clients/{client_id}`


<!-- END_a1f8507923718086f5f1b5582168ae63 -->

<!-- START_b0068da3e6e432db7ecfde4e27cff8fe -->
## Get all of the available scopes for the application.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/oauth/scopes", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/scopes");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/oauth/scopes`


<!-- END_b0068da3e6e432db7ecfde4e27cff8fe -->

<!-- START_ce041c4ebaa0b9dced857801293b7c4e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost//v1/oauth/personal-access-tokens", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/personal-access-tokens");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /v1/oauth/personal-access-tokens`


<!-- END_ce041c4ebaa0b9dced857801293b7c4e -->

<!-- START_6da3a1e778d6b8eec4aae928c5165839 -->
## Create a new personal access token for the user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost//v1/oauth/personal-access-tokens", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/personal-access-tokens");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /v1/oauth/personal-access-tokens`


<!-- END_6da3a1e778d6b8eec4aae928c5165839 -->

<!-- START_7cb531367d40ee6ce2b4816e6d0c6b78 -->
## Delete the given token.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost//v1/oauth/personal-access-tokens/1", [
    'headers' => [
            "Authorization" => "Bearer: {token}",
            "Accept" => "application/json",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


```javascript
const url = new URL("http://localhost/v1/oauth/personal-access-tokens/1");

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /v1/oauth/personal-access-tokens/{token_id}`


<!-- END_7cb531367d40ee6ce2b4816e6d0c6b78 -->



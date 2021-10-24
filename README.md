## Install
### Run the commands in order:
<ul>
    <li>sail up -d</li>
    <li>sail artisan db:see</li>
</ul>

## Authorization

```http
POST /api/sanctum/token
```

| Parameter | Type | Enter |
| :--- | :--- | :--- |
| `email` | `string` | `admin@admin.com` |
| `password` | `string` | `admin123` |
| `token_name` | `string` | `any` |

Response: <b>Bearer Token</b><br>
#### Use the token in all api requests

## API

1. Get all views
```http
GET /api/pages/stats
```
| Parameter | Type | Description
| :--- | :--- | :--- |
| `uuids` | `string` | Uuid pages through the sign `,`
| `page` | `int` | Page number

2. Get views by uuid
```http
GET /api/pages/{uuid}/stats
```
| Parameter | Type
| :--- | :---
| `uuid` | `string`

3. Get Top-3 views by count day
```http
GET /api/pages/stats/top
```
| Parameter | Type
| :--- | :---
| `day` | `int`





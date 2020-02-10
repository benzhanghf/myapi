# myapi
Example of RESTFUL API using lavarel

## API endpoints
local testing, if setup localhost


### create a new property 
POST

http://localhost:8080/api/property

Payload JSON in post body
```
{
	"suburb": "test",
	"state": "NSW",
	"country": "AU"
}
```

### add or upate an analytic to propert
POST

http://localhost:8080/api/property/analytic

Payload JSON in post body when updating
```
{
	"id": 218,
	"property_id": 101,
	"analytic_type_id": 3,
	"value": "1235"
}
```

Payload JSON in post body when creating
```
{
	"property_id": 101,
	"analytic_type_id": 3,
	"value": "123.565657"
}
```

### Get all analytics for an inputted property
GET

http://localhost:8080/api/property/analytic/100
http://localhost:8080/api/property/analytic/{{property_id}}

Example response
```
[
    {
        "id": 100,
        "created_at": "2020-02-09 13:22:01",
        "updated_at": "2020-02-09 13:22:01",
        "property_id": 100,
        "analytic_type_id": 1,
        "value": "33"
    },
    {
        "id": 167,
        "created_at": "2020-02-09 13:22:01",
        "updated_at": "2020-02-09 13:22:01",
        "property_id": 100,
        "analytic_type_id": 2,
        "value": "577"
    },
    {
        "id": 217,
        "created_at": "2020-02-09 13:22:01",
        "updated_at": "2020-02-09 13:22:01",
        "property_id": 100,
        "analytic_type_id": 3,
        "value": "2.509769933"
    }
]
```

### Get a summary of all property analytics for an inputted suburb (min value, max value, median value, percentage properties with a value, percentage properties without a value)
GET

http://localhost:8080/api/property/report/suburb/parramatta
http://localhost:8080/api/property/report/suburb/{{suburb}}

Example response
```
{
    "suburb": "parramatta",
    "max_value": 1101,
    "min_value": 1.074558188,
    "percentage_has_value": 100,
    "percentage_no_value": 0
}
```

### Get a summary of all property analytics for an inputted state (min value, max value, median value, percentage properties with a value, percentage properties without a value)

GET

http://localhost:8080/api/property/report/state/qld
http://localhost:8080/api/property/report/state/{{state}}

Example response
```
{
    "state": "qld",
    "max_value": 758,
    "min_value": 0.7199486324,
    "percentage_has_value": 100,
    "percentage_no_value": 0
}
```

### Get a summary of all property analytics for an inputted country (min value, max value, median value, percentage properties with a value, percentage properties without a value)

GET

http://localhost:8080/api/property/report/country/australia
http://localhost:8080/api/property/report/country/{{country}}

Example response
```
{
    "suburb": "test",
    "max_value": 1235,
    "min_value": 1235,
    "percentage_has_value": 100,
    "percentage_no_value": 0
}
```
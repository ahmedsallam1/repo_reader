# Repositories Reader Service

## Background
This service is acts as a search service to get data about public repositories using search endpoint such as `github` endpoint `https://api.github.com/search/repositories`. the service also enables you search using some filters such as

* List most popular repositories sorted by `stars`.
* List top `N` repositories.
* List repositories created at `date` and onwards
* List repositories with specific `language`.

## System Design
![alt_text](repo_images/system_design.png?raw=true)

## Getting Started
* Clone the Repository
```
git clone git@github.com:ahmedsallam1/repo_reader.git
```

* Installation via Docker
```
docker-compose up -d --build
```

* Build the Application
```
docker-compose exec php composer install
```

* Testing
```
docker-compose exec php ./bin/phpunit
```

* Browsing the Search Endpoint
```
http://localhost:8000/api/repositories
```

## APIs Documentation

* Parameters
```
| Parameter  | Type   | Description                                                         | Example    | Required |
|------------|--------|---------------------------------------------------------------------|------------|----------|
| sort       | String | The field used to sort the repositories                             | stars      | No       |
| order      | String | The field used to define the direction of the sort field            | desc       | No       |
| start_date | String | The field used to get repositories created at that date and onwards | 2020-01-01 | No       |
| language   | String | The field used to get repositories with specific language           | php        | No       |
| limit      | Int    | The field used to limit repositories result                         | 15         | No       |
```

* Example
```
http://localhost:8000/api/repositories?sort=stars&order=desc&start_date=2020-01-01&language=php&limit=15
```

* Response
```
{
  "pagination": {
    "total_count": int
  },
  "data": [
      {},
      {}
  ]
}
```

## Try Out
* Swagger
```
http://localhost:8000/api/doc
```

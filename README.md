# Search App
## Requirements
- Docker

## Build
- `cp .env.example .env`
- Please create a Google API key and assign it to variable `GOOGLE_API_KEY` in .env
- Make sure port 7080 (`HTTP_PORT` in `.env` file) is not being used. If it is being used by another application you will
need to change to a different one.
- Ensure `make` is installed in your machine, it will help in running the commands
- To run the application, follow below steps:

    Build and start the container, run 
    ```
    make up
    ```
    Install dependent packages run 
    ```
    make composer-install
    ```
## Tests
- To run tests:
 
    ```
    make run-tests
    ```

## Design Considerations
Based on the requirement, this app has avoided using PHP frameworks.  Hence, few workaround have to be implemented:
- Routing is not full featured and have been implemented to cater the minimal requirements of the app. 
- Considering the minimal UI feature was required, no templating engine is used, else Twig could have been a good option.
- Even though dependency injection is used, but no DI container is used.
- No logging and monitoring is not used.
- `GuzzleHttp` is used for making http requests.
- `Dotenv` is used for retrieving environment variables
- `PHPUnit` is used writing and running test cases.


The prominent design pattern used in the app is Strategy Pattern, which is basically used to decide which search engine to use from the available search engines or if later on decided to add another search engine. App also uses bridge pattern, where SearchClient act as bridge between Controller and SearchEngine and also helps in deciding which search engine to be used.

For production ready app, we can use any of the popular frameworks like Laravel, Symfony or Zend.  Else if we want to keep the app leaner we can also consider Slim Framework. Also for production, we need to consider using logging and monitoring services like Datadog, Newrelic etc.

Personally, I would like to build this app in micro-service architecture and keep backend and frontend separate. I would prefer Symfony for backend and Vue/React for frontend.

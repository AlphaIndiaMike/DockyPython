# SearXNG Settings Recommended Changes

The following changes were made to the `settings.yml` file:

1. Changed the search method from POST to GET:
   ```yaml
   http:
     method: "GET"
    ```

1. Turned off safe search:

   ```yaml
   search:
     safe_search: 0
    ```

1. Set default autocomplete to Google:

   ```yaml
   search:
    autocomplete: google
    ```

1. Enabled HSTS (HTTP Strict Transport Security):

   ```yaml
   server:
    strict_transport_security: True
    ```

1. Configured a strict Content Security Policy:

   ```yaml
   server:
     content_security_policy: "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; frame-src 'none'; connect-src 'self'"
    ```

1. Updated the outgoing connection settings:

   ```yaml
    outgoing:
        pool_connections: 100
        pool_maxsize: 100
        max_retries: 3
        pool_timeout: 10
        max_timeout: 15
    ```

1. Set the result proxy to use Morty:

   ```yaml
   result_proxy:
    url: "http://localhost:3030/"
    key: "your_morty_key"

    ```

The `settings.yml` file example:


```yml
search:
  default_lang: en
  safe_search: 0  # Turn off safe search
  autocomplete: google  # Set default autocomplete to Google
  default_params:
    timeframe: 'day'  # Set the default time range of search results
    language: 'en'  # Set the default language of search results
    results_on_page: 20  # Set the number of results per page

server:
  secret_key: "your_secret_key"  # Replace with your own secret key
  http_protocol_version: 1.1  # Use HTTP/1.1
  bind_address: "0.0.0.0"
  port: 8080
  base_url: "http://localhost:8012/"
  strict_transport_security: True  # Enable HSTS
  content_security_policy: "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; frame-src 'none'; connect-src 'self'"
  image_proxy: True  # Enable the image proxy

outgoing:  # Use a custom outgoing connection
  pool_connections: 100
  pool_maxsize: 100
  max_retries: 3
  pool_timeout: 10
  max_timeout: 15

http:
  method: "GET"  # Change the method to GET

result_proxy:
  url: "http://localhost:3030/"
  key: "your_morty_key"  # Replace with your own Morty key

plugins:
  - name: cookie_preferences  # Enable the cookie_preferences plugin
  - name: infinite_scroll  # Enable the infinite_scroll plugin

cache:
  type: 'redis'  # Use Redis for caching
  url: 'redis://redis:6379/0'


```
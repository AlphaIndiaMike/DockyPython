#!/bin/bash

# Function to generate random keys
generate_key() {
  openssl rand -base64 33
}

# Create the required directories
mkdir -p /tmp/app2/searxng

# Check if command-line arguments are provided
if [ $# -eq 3 ]; then
  custom_domain="$1"
  secret_key="$2"
  morty_key="$3"
else
  # Prompt for custom domain, secret_key, and morty_key or generate them if no input is provided
  read -p "Enter your custom domain (e.g., https://yourdomain.com/) or press enter to use the default (http://localhost:8080/): " custom_domain
  custom_domain="${custom_domain:-http://localhost:8080/}"

  read -p "Enter a secret key for SearXNG or press enter to generate one: " secret_key
  secret_key="${secret_key:-$(generate_key)}"

  read -p "Enter a key for Morty or press enter to generate one: " morty_key
  morty_key="${morty_key:-$(generate_key)}"
fi

# Create the custom settings.yml file
cat <<EOT >/tmp/app2/searxng/settings.yml
search:
  default_lang: en
  safe_search: 0
  autocomplete: google
  default_params:
    timeframe: 'day'
    language: 'en'
    results_on_page: 20
server:
  secret_key: "$secret_key"
  http_protocol_version: 1.1
  bind_address: "0.0.0.0"
  port: 8080
  base_url: "$custom_domain"
  strict_transport_security: True
  content_security_policy: "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self' data:; frame-src 'none'; connect-src 'self'"
  image_proxy: True
outgoing:
  pool_connections: 100
  pool_maxsize: 100
  max_retries: 3
  pool_timeout: 10
  max_timeout: 15
http:
  method: "GET"
result_proxy:
  url: "http://localhost:3030/"
  key: "$morty_key"
plugins:
  - name: cookie_preferences
  - name: infinite_scroll
cache:
  type: 'redis'
  url: 'redis://redis:6379/0'
EOT

# Download the default Filtron rules file
wget https://raw.githubusercontent.com/asciimoo/filtron/master/example_rules.json -O /tmp/app2/rules.json

echo "Custom settings.yml and example_rules.json files have been created in /tmp/app2."

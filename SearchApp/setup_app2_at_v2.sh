#!/bin/bash

# Variables
SEARXNG_FOLDER="/tmp/app2"
CONFIG_FOLDER="$SEARXNG_FOLDER/searxng"
RULES_FOLDER="$SEARXNG_FOLDER"
RULES_FILE="rules.json"
DOCKER_COMPOSE_FILE="docker-compose.yml"
DOMAIN_NAME="${1:-yourdomain.com}"

# Create directories
mkdir -p "$CONFIG_FOLDER"
mkdir -p "$RULES_FOLDER"

# Generate Morty and Redis keys
MORTY_KEY=$(openssl rand -hex 32)
REDIS_PASSWORD=$(pwgen 32 1)

# Create settings.yml
cat > "$CONFIG_FOLDER/settings.yml" <<EOL
search:
  default_lang: en
  safe_search: 0
  autocomplete: google
  default_params:
    timeframe: 'day'
    language: 'en'
    results_on_page: 20
server:
  secret_key: $(openssl rand -hex 32)
  http_protocol_version: 1.1
  bind_address: "0.0.0.0"
  port: 8080
  base_url: https://$DOMAIN_NAME/
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
  key: "$MORTY_KEY"
plugins:
  - name: cookie_preferences
  - name: infinite_scroll
cache:
  type: 'redis'
  url: 'redis://redis:6379/0'
EOL

# Create rules.json
wget -O "$RULES_FOLDER/$RULES_FILE" https://raw.githubusercontent.com/asciimoo/filtron/master/example_rules.json

# Create docker-compose.yml
cat > "$DOCKER_COMPOSE_FILE" <<EOL
version: "3.8"

services:
  searxng:
    image: searxng/searxng:latest
    container_name: searxng
    restart: always
    volumes:
      - $CONFIG_FOLDER:/etc/searxng
    environment:
      - "BIND_ADDRESS=0.0.0.0"
      - "BASE_URL=https://$DOMAIN_NAME/"
      - "MORTY_URL=http://morty:3030/"
      - "MORTY_KEY=$MORTY_KEY"
    networks:
      - searxng_net
    expose:
      - "8080"

  filtron:
    image: dalf/filtron:latest
    container_name: filtron
    restart: always
    command: -listen 0.0.0.0:8012 -api 0.0.0.0:4041 -rules /etc/filtron/rules.json -target searxng:8080
    volumes:
      - $RULES_FOLDER/$RULES_FILE:/etc/filtron/rules.json
    networks:
      - searxng_net
    ports:
      - "8012:8012"

  morty:
    image: dalf/morty:latest
    container_name: morty
    restart: always
    command: -listen 0.0.0.0:3030 -timeout 6s -ipv6
    environment:
      - "MORTY_KEY=$MORTY_KEY"
    networks:
      - searxng_net
    expose:
      - "3030"

  redis:
    image: "redis:6-alpine"
    container_name: redis
    restart: always
    networks:
      - searxng_net
    command: redis-server --requirepass $REDIS_PASSWORD

networks:
  searxng_net:
    name: searxng_net
EOL

# ./setup_app2_at_v2.sh yourdomain.com
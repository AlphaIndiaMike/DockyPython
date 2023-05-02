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
  safe_search: false
  autocomplete: google
  default_lang: en
server:
  secret_key: $(openssl rand -hex 32)
  bind_address: 0.0.0.0
  port: 8080
  base_url: https://$DOMAIN_NAME/
  image_proxy: true
EOL

# Create rules.json
cat > "$RULES_FOLDER/$RULES_FILE" <<EOL
[
  {
    "name": "block user agent",
    "filters": [
      {
        "type": "user_agent",
        "expression": "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)"
      }
    ],
    "action": {
      "type": "block"
    }
  }
]
EOL

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
    expose:
      - "8012"

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

# ./setup_app2_at_custom.sh yourdomain.com

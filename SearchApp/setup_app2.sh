#!/bin/bash

# Create the required directories
mkdir -p /tmp/app2/searxng

# Download the default Filtron rules file
wget https://raw.githubusercontent.com/asciimoo/filtron/master/example_rules.json -O /tmp/app2/rules.json

# Download the default SearXNG settings.yml file
wget https://raw.githubusercontent.com/searxng/searxng/master/searx/settings.yml -O /tmp/app2/searxng/settings.yml

echo "Folder structure and necessary files have been created in /tmp/app2."

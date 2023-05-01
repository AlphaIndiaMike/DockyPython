# Stock Ticker Data Visualization with Docker Compose

This project utilizes Docker Compose to set up a multi-container environment for downloading stock ticker data, storing it in a Graphite database, and visualizing the data using Grafana. The project also includes a custom JupyterLab container for interacting with Graphite.

## Table of Contents

- [Overview](#overview)
- [File Structure](#file-structure)
- [Getting Started](#getting-started)

## Overview

The project consists of the following containers:

1. **Graphite**: A time-series database for storing stock ticker data.
2. **Grafana**: A web-based data visualization tool for creating dashboards and charts.
3. **Python**: A custom Python container that downloads stock ticker data and sends it to Graphite.
4. **JupyterLab**: A custom JupyterLab container with Graphite and Graphyte libraries pre-installed, allowing interaction with Graphite.

## File Structure

The project directory is structured as follows:

```

.
├── custom_jupyterlab
│ └── Dockerfile
├── input_mdt1
│ ├── Dockerfile
│ └── fetcher.py
├── docker-compose.yml
└── grafana
│ ├─ dashboards
│ └── dashboard.yaml
│ ├── provisioning
│ ├── dashboards
│ │ └── dashboards.yaml
│ └── datasources
│ └── datasources.yaml
└── grafana.ini

```


- `custom_jupyterlab/Dockerfile`: Defines the custom JupyterLab image with Graphite and Graphyte libraries pre-installed.
- `input_mdt1/Dockerfile`: Defines the custom Python image for downloading stock ticker data.
- `input_mdt1/fetcher.py`: Python script for downloading stock ticker data and sending it to Graphite.
- `docker-compose.yml`: Docker Compose configuration file for defining and running multi-container applications.
- `grafana/dashboards/dashboard.yaml`: Grafana dashboard configuration file.
- `grafana/provisioning/dashboards/dashboards.yaml`: Grafana dashboard provisioning configuration file.
- `grafana/provisioning/datasources/datasources.yaml`: Grafana data source provisioning configuration file.
- `grafana/grafana.ini`: Grafana configuration file.

## Getting Started

1. Clone the repository to your local machine.
2. Ensure Docker and Docker Compose are installed.
3. Navigate to the project directory and run `docker-compose up --build` to build and run the containers.
4. Access Grafana at `http://localhost:3000`, JupyterLab at `http://localhost:8888`, and RabbitMQ web console at `http://localhost:15672`. The default username and password for the RabbitMQ management console are "guest" and "guest", respectively.
FROM grafana/grafana:latest

# USER grafana

# COPY grafana.ini /etc/grafana/grafana.ini
# COPY provisioning/ /etc/grafana/provisioning/

# Install MongoDB plugin
# RUN grafana-cli plugins install grafana-mongodb-datasource

USER root
RUN grafana-cli plugins install grafana-mongodb-datasource

COPY provisioning /etc/grafana/provisioning
COPY config /etc/grafana

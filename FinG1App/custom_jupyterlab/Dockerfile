# Dockerfile
FROM jupyter/datascience-notebook:latest

# Install graphyte and graphite-api
RUN pip install graphyte graphite-api

# Create the directories for JupyterLab config and custom notebook
RUN mkdir -p /home/jovyan/.jupyter
RUN mkdir -p /home/jovyan/work
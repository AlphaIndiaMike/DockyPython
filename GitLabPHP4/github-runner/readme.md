# GitHub Self-Hosted Runner Setup

This guide will help you set up a self-hosted runner for GitHub Actions using Docker.

## Prerequisites

- Docker and Docker Compose installed on your machine.
- A GitHub account and a repository where you want to set up the runner.

## Steps

### 1. Generate a Personal Access Token on GitHub

1. Navigate to your GitHub profile settings.
2. Go to "Developer settings" > "Personal access tokens".
3. Click "Generate new token".
4. Name your token and select the following scopes:
   - `repo`
   - `read:org`
   - `write:discussion`
   - `read:discussion`
   - `read:packages`
   - `write:packages`
   - `read:workflow`
   - `write:workflow`
5. Click "Generate token" and save the generated token. You'll need this token to connect your runner to GitHub.

### 2. Set Up the Dockerized GitHub Runner

1. Create a `docker-compose.yml` file with the following content:

```yaml
version: '3'

services:
  github-runner:
    image: myoung34/github-runner:latest
    container_name: github-runner
    environment:
      - REPO_URL=https://github.com/YOUR_USERNAME/YOUR_REPO
      - RUNNER_TOKEN=YOUR_PERSONAL_ACCESS_TOKEN
      - RUNNER_NAME=my-runner
      - RUNNER_WORKDIR=/tmp/github-runner
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
```

2. Replace the placeholders:
   - `YOUR_USERNAME`: Your GitHub username.
   - `YOUR_REPO`: The name of your GitHub repository.
   - `YOUR_PERSONAL_ACCESS_TOKEN`: The token you generated in the first step.

3. Start the GitHub Runner using Docker Compose:

```bash
docker-compose up -d
```

This will start the runner and automatically register it with your GitHub repository.

### 3. Verify the Runner on GitHub

1. Go to your GitHub repository settings.
2. Navigate to "Actions" > "Runners".
3. You should see your runner listed as a self-hosted runner.

## Managing the Runner

- To stop the runner:

```bash
docker-compose down
```

- To restart the runner:

```bash
docker-compose restart
```


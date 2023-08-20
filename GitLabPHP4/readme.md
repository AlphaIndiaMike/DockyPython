## Overview

This repository contains various Docker Compose configurations to set up a GitHub runner, a local GitLab instance, and multiple sites running in individual containers sharing a MariaDB database.

## Structure

- `github-runner/`: Contains the Docker Compose file for setting up a GitHub runner. This runner is configured to release containers into Docker on the same machine.
- `local-gitlab/`: Contains the Docker Compose file to set up a local GitLab instance. This can be used as a CI/CD tool for local GitOps practices.
- `main/`: Contains the Docker Compose file to launch multiple sites (`site1`, `site2`, ... `siteN`). Each site runs in its own container but shares the same MariaDB database.

## Setup & Usage

### GitHub Runner

1. Navigate to the `github-runner/` directory.
2. Run `docker-compose up -d` to start the GitHub runner.
3. Follow the instructions in the `github-runner/README.md` (if available) to configure the runner with your GitHub account.

### Local GitLab

1. Navigate to the `local-gitlab/` directory.
2. Run `docker-compose up -d` to start the local GitLab instance.
3. Access the GitLab instance through your browser and set up your CI/CD pipelines for local GitOps.

### Main Sites

1. Navigate to the `main/` directory.
2. Run `docker-compose up -d` to start the individual site containers.
3. Each site will be accessible on its respective port, and they all share the same MariaDB database.

## License

This project is licensed under the [GNU General Public License v3 (GPLv3)](LICENSE).

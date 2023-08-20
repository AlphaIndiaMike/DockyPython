# GitLab Server and Runner for LAMP Stack CI/CD

This setup provides a way to run a GitLab server and runner on the same machine, tailored for continuous integration and deployment of LAMP stack applications.

## Scope

The primary aim is to facilitate CI/CD pipelines for LAMP stack apps using GitLab.

## How to 

1. Execute `docker-compose up`.
2. Set up the GitLab repositories.
3. Commit to `site1`, `site2`, `site..n`.
4. For each site, create a corresponding repository. GitLab will then deploy the server in the same Docker instance.

> **Note:** This setup serves as a boilerplate. Individual components can be utilized separately as per requirements.

## Lessons Learned

1. **ARM Compatibility**: There isn't an official GitLab image available for ARM architectures. A suitable alternative for ARM, based on brief research, is `yrzr/gitlab-ce-arm64v8:latest`.

2. **Permissions Issue on ARM-MAC**: Mapping the local volume `./gitlab/data:/var/opt/gitlab` leads to write access issues inside the container. This causes GitLab to crash across various versions.

---

For any additional setup instructions or related information, ensure you consult the official documentation or community forums.

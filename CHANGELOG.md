# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/jeffersongoncalves/laravel-g2/commits/main)

### Added

- Initial release.
- `G2` facade and `G2Client` fluent client for the G2 API.
- `reviews()` resource: `list()`, `get()`.
- `products()` resource: `list()`, `get()`.
- `reports()` resource: `list()`, `get()`.
- `competitors()` resource: `list()`.
- `categories()` resource: `list()`, `get()`.
- `tracking()` resource: `visitors()`.
- `G2Exception` thrown on a non-2xx API response.
- Configurable token and base URL via `config/g2.php`.

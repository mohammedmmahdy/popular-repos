# Popular Repos

Popular Repos is a backend application for discovering popular repositories on GitHub. It is built using Laravel and utilizes Laravel Sail for easy local development.

## Project Description

This application implements a backend service that interacts with the GitHub API to fetch and analyze popular repositories. It provides endpoints for users to discover trending and highly-starred repositories across various programming languages and time periods.

## Prerequisites

- Docker
- Docker Compose

## Getting Started

1. Clone the repository:
```
git clone https://github.com/yourusername/popular-repos.git
cd popular-repos
```
2. Copy the `.env.example` file to `.env`:
```
cp .env.example .env
```
3. Install dependencies using Laravel Sail:
```
./vendor/bin/sail composer install
```
4. Start the Laravel Sail environment:
```
./vendor/bin/sail up -d
```
5. Generate application key:
```
./vendor/bin/sail artisan key:generate
```
6. Run database migrations:
```
./vendor/bin/sail artisan migrate
```
## Usage

To interact with the application, use the following base URL:
```
http://localhost
```

## Running Tests

To run the test suite:
```
./vendor/bin/sail test
```


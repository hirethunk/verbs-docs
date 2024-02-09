# Verbs Docs

## Installation

First, set up the Laravel app:

```shell
composer install
npm install
npm run build
```

## Fetching docs from Verbs package

Then, fetch the latest markdown files from Verbs:

```shell
./bin/fetch-docs.sh
```

## Fetching docs from local copy of Verbs

If you're working from a local copy of Verbs, you can symlink the docs
and examples instead, with:

```shell
mkdir -p ./resources/docs/main
cd ./resources/docs/main
ln -s /path/to/verbs/docs .
ln -s /path/to/verbs/examples .
```

## Serving

Finally, just serve the docs thru artisan:

```shell
php artisan serve
```

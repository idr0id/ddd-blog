DDD Blog
========

[![Build Status](https://travis-ci.org/idr0id/ddd-blog.png)](https://travis-ci.org/idr0id/ddd-blog)

This blog written on Symfony2 framework with using TDD and DDD principles.

Installing
----------

Use Composer

	php composer.phar install

Copy app/config/parameters.sample.yml to app/config/parameters.yml and configure it

Create database schema

	php app/console doctrine:schema:create

Install assets

	php app/console assets:install --symlink

To see a real-live blog page in action, access the following page:

    http://localhost/path/to/blog/web/

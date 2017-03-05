## Baconize.it

Baconize.it is a URL "shortener" service, which instead of actually shortening URLs, turns them into tastier bacon URLs. Such as this one:
[http://baconize.it/GypsyBacon-Fatback-IrishBacon-MiddleBacon-UnsmokedBacon-SlabBacon](http://baconize.it/GypsyBacon-Fatback-IrishBacon-MiddleBacon-UnsmokedBacon-SlabBacon)

## Project files

The project is built entirely on Laravel 5, with some simple front-end Twitter Bootstrap styling. You can find information on Laravel itself on the [Laravel documentation](http://laravel.com/docs/contributions) page.

## Efficient URL shortening

The URL shortener uses a pre-defined array of "bacon names" which correspond to a hexidecimal number. When a new URL is created, a new unused random hex number is generated and stored. When a "shortened" URL is entered, rather than looking up the the full URL in a database, the words are converted to a short hexidecimal equivilant through itterating over the defined array, then the hexidecimal number is looked up in the database. This method results in significantly faster database lookups, especially as the database itself scales with use.

## Contributing

This repository is open source, and all contributions and forking is welcome!

## License

This software, and the Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

# RBAC

A Role-Based Access Control (RBAC) pakcage for Laravel.

### Installation

Install wia composer:

```
composer require sha443/rbac
```

And add the service provider in config/app.php:

```php
sha443\rbac\RBACServiceProvider::class,
```

Then register Facade class aliase:

```php
'RBAC' => sha443\rbac\RBAC::class,
```

Publish assets:

```
php artisan vendor:publish
```

## License

### GPLv2

Copyright (c) 2021 Mohamed Shahid <shahidcseku@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
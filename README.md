# Assignment


Υou have a database with this structure

rental
- name
- type = standalone_rental OR room_type OR room
- parent_rental = rental_id

booking
- parent_rental
- rental
- check_in_date
- check_out_date

We want an api without any authorization that will return the availability of rentals of type 'standalone_rental' OR 'room_type' based on two dates.

I, the consumer of the api, want to know what are the available standalone_rentals or room_types I can book for a given date range.

- Feel free to start the script with some fixtures or an sql import so we have some data.
- Don't worry about a lot of data. Even 3-4 rentals and 3-4 bookings are enough. As long as it works.
- structure of the request and response, urls are up to you. They are part of the assignment.
- you can complete this in any language you want

Some explanation on the type of rental.

standalone_rental = a house, a villa. Something you rent as a whole.
room_type = think of type of room in a hotel. "three bed" "grand suite". When you book a hotel you never book room 703. You book a "double bed room". This is the "double_bed_room"
room = this is the room 703. This is never visible to the client that wants to book

So in our case, the bookings are assigned to standalone_rentals (rental is the standalone and parent_rental can be the same) or to room (rental = room and parent_rental = room_type). 

# Installation

# MySql Database Creation
- `CREATE USER 'egor'@'localhost' IDENTIFIED BY '12345';`
- `CREATE DATABASE hosthub;`
- `GRANT ALL PRIVILEGES ON hosthub.* TO 'egor'@'localhost';`
- `FLUSH PRIVILEGES;`

# Deployment
- `git clone https://github.com/EgorBereza/HosthubApi.git`
- `composer install`
- `php artisan migrate --seed`
- `php artisan serve` 

# Run Tests
- `php artisan test`

# Swagger Api Documentation Genertion
- `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
- `php artisan l5-swagger:generate`

# Notes

1) The api was developed and tested by using Laravel Herd + Local Mysql Server (https://herd.laravel.com)

2) Swagger will be accessible at http://your-domain/api/documentation after the generation


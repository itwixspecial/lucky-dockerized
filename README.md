# imfeelinglucky-dockerized

<h3>Project deployment: </h3>

Clone from repository: <br>
``
git clone https://github.com/itwixspecial/lucky-dockerized.git
``
Change directory:<br>
``
cd lucky-dockerized
``

Create .env:<br>
``
cp src/.env.example src/.env
``

Set .env : mysql settings(set db_host "mysql")


Run: <br>
``
docker-compose up nginx -d
``

Run Migration && Generate keys:<br>
``
docker-compose run artisan migrate
docker-compose run artisan key:generate   
``


Checkout:
http://localhost:8000

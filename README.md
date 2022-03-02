# projet-23-o-travel-back

## First step:

Install:  
```composer install```

Creation of the skeleton:  
```composer create-project symfony/skeleton```

## Database creation:

We create the database otravel.
First we use:   
```composer require symfony/orm-pack```  
```composer require --dev symfony/maker-bundle```

We had a new file env.local, we select the good code line for our database:  
```mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8```  
We replace db-user and db_password and db_name by our user and password and database name.  
Here we use otravel for all.

Now, we can create the databe with the command:  
```bin/console doctrine:database:create```

We can use the command ```make:entity``` to create the table of the database one by one.  

After creating the database, we make the migration, we use the following command:  
```bin/console make:migration```  
```bin/console doctrine:migrations:migrate``` or the short version ```bin/console d:m:m```  

## Database relation:

Now, we can create the reltion for each tables.  
We use the command ```make:entity``` but this time we said that we want a ***relation***.  

After we had created the relations, we can make an other ```bin/console make:migration``` and a ```bin/console d:m:m```.  
We check in Mariadb and we see all the tables and relations created.  

## Fixtures  

Now we can procide withe the creation of the fixture to fulfil our database.  

we start by installing the orm-fixtures, with the following commands:  
```composer require --dev orm-fixtures```  
```composer require --dev doctrine/doctrine-fixtures-bundle```  

We create a truncate function to delete all data and id when we use the command ```bin/console doctrine:fixtures:load```.  

## API creation  

We begin by create an ApiController with the command: ```bin/console make controler```  

Install of Serialazer with the command: ```composer require symfony/serializer```  

We install serializer pack too, with the command: ```composer require symfony/serializer-pack```  

We can create now, the route for API.  

## NelmioCorsBundle installation  

We instal the NelmioCorsBundle to make the communication between the Front and the api in Back.  
First, we use the command: ```composer require nelmio/cors-bundle```  
Second, we check and adapt the file ```config/packages/nelmio_cors.yaml```, now we the Front can communicate with the Back.  
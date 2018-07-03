# Le Bon Coin Clone Challenge
This is for a technical test using Symfony to create a clone of leboncoin.fr in 2 hours. 

## Environment Requirements
This was built in Symfony 4 using PHP 7.1 and MySQL. Symfony 4 requires PHP 7.1 or higher. 

## Install

    git clone https://github.com/rain2o/leboncoin-clone.git
    cd leboncoin-clone
    composer install

Edit your `.env` file to have the appropriate MySQL credentials. 

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    php bin/console doctrine:fixtures:load
    yarn install
    yarn run encore production
    php bin/console server:run
    
Then browse your site at http://127.0.0.1:8000

## Notes
This come with dummy data for testing the browsing experience. 
I was about to create the form to create new Adverts but ran out of time. 

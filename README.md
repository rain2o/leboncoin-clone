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

I started with creating a simple homepage using Bootstrap. 

I then moved on to creating the entities I determined to be useful for the project - Advert, Category, and City,
with Advert having a ManyToOne relation to each Category and City. 

I created some fake data with the Fixtures feature to use for testing. 

I then created each _view_ controller and template to browse the adverts. This includes a listing of
Cities and Categories on the homepage that you can browse and the top level Deals and Requests views. 
These views are somewhat dynamic to account for either type of Advert - deal or request. 

My next step was to create the form for creating new adverts however I ran out of time. 

Admittedly I could have saved some time by documenting the code less and by copy-pasting any repeated snippets
of code instead of refactoring to be more scalable, but in my opinion this was worth the sacrifice of time. 
Or it would be in a real build of something.   

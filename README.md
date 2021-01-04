# TalentQlTest

## Documentaion

### Installation
* git clone https://github.com/haewhybabs/talentQlTest.git
* composer install
* php artisan migrate
* php artisan passport:install

### There are 7 endppoints for the API

*Registration : post request to; "servername"/api/register , with name,email,password,password_confirmation for the input post

*Login : post request to ; "servername"/api/login , with email and password for the input post


*Create Task (authentication is required) : post request to ; "servername"/api/task/create. title(required), description are for the input post

 *Update Task (authentication is required) : put request to ; "servername"/api/task/update/{task_id}. This could also work for complete task, complete(either 1 or 0) is passed to the url
 
 *View Task (authentication is required) : get request to ; "servername"/api/task/view/{task_id}.

 *Delete Task (authentication is required) : delete request to ; "servername"/api/task/delete/{task_id}. 


 *View All Task (authentication is required) : get request to ; "servername"/api/task.


***postman link:https://www.getpostman.com/collections/6fca1f9d220219a80cca***


**Author:: Ayobami Babalola**

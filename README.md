# Restful taskmanager app

The main perpose is to administer tasks via calendar. Project contains two differrent objects, api and front-end. The api and front-end render are based on Slim Framework. The front-end use the api for data manipulation. It has application error log system.

### Structure
/api -> Contain the api which initialise the data routes.  
/public -> Contain the front-end main site routes.  
/vendor -> Folder initialize by [Composer] with required libraries  
/lib -> libraries out of [Composer]
 

### Tech

The app uses a number of open source projects to work properly:

* [Slim Framework](http://www.slimframework.com/) - Minified php framework
* [Twitter Bootstrap] - Front-end web framework for html and css
* [jQuery] - JavaScript library
* [FullCalendar](http://fullcalendar.io/) - jQuery plugin for a full-sized, drag & drop event calendar.
* [X-editable](https://vitalets.github.io/x-editable/) - After core library which allows you to create editable elements on your page
* [Twig](http://twig.sensiolabs.org/) - PHP Template engine

[Twitter Bootstrap]:http://twitter.github.com/bootstrap/
[jQuery]:http://jquery.com
[Composer]:https://getcomposer.org/
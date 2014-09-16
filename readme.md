
--------
My Comments:

1) When env name = local, dbtest does not run as it is trying to use DB name "homestead". Is this because the machine name is homestead?
	A: yes. check hostname by using gethostname(); dbtest not using it because i did not edit app/config/local/database.php, which the file that is relevant when env-name = local.
	Add: machine name is homestead because     
				config.vm.hostname = "homestead"
		 is specified in homestead/scripts/homestead.rb
2) dbtest currently only runs when env name = production. Then it uses the DB name specified under app/config/database.php
	A: this makes sense now.
3) Changing APP_ENV to something else in Homestead.yaml does not seem to be affecting the actual APP_ENV being read. how?
	A: do vagrant reload --provision (this will force the .yaml file to be re-read)
		QQQ : FIGure out what the variables in Homestead.yaml are used for, and how they can be accessed?
				A: used to setup env variables
		QQQ : Precendence between php-fpm.conf and Homestead.yaml variables
				A: If Homestead.yaml sets APP_ENV and it is already set manually in php-fpm.conf, then since the one from .yaml is simply appended at the end of the .conf file, the one already there from before takes precendence
4) fastcgi_params in nginx conf files vs php-fpm.conf env var settings? which affects what?
	A: both set env vars in $_SERVER
		QQQ: if both set the same variable, which one takes precendence?
				A: the one in fastcgi_params takes precendence.

5) 'vagrant destroy' destroys the databases. How to persist databases across vagrant destroy sessions?
		QQQ: does 'vagrant reload --provision' destroy the DB?
		QQQ: does 'vagrant suspend' destroy the DB?
6) Check for difference in name vs id for form elements
	A1: HTML form elements operate on name attr not on id attr. which means .serialize (jQuery method) will only work on name attr not on id attr
7) Can you embed php in a .js or jquery file?


Ah!
1) debug settings for every env in the app.php inside folder of env name present inside app/config
2) database settings for every env in the app.php inside folder of env name present inside app/config
3) Changes to Homestead.yaml do not need one to restart vagrant vm. Because the homestead folder on your machine (the one from the git repo that has the Vagrantfile and Homestead.yaml) is mapped to /vagrant on the vm. 
	The projects folder on your machine is mapped to /home/vagrant/Sites as specified in Homestead.yaml
4) PHP5 ENV variables are set in /etc/php5/fpm/php-fpm.conf (on the homestead vagrant vm).
   homestead/scripts/homestead.rb (on your machine) will use the "variables" key from the Homestead.yaml file and use that the set env variables in the php-fpm.conf file on the vm.
   			QQQ :
   				That is what the script suggests yet changing Homestead.yaml variables and reloading the vagrant vm has not changed the ENV var settings for me :(
   			QQQ:
   				Also changing ENV var APP_NAME value manually in php-fpm.conf has not changed what is being var dumped by getenv('APP_NAME') :( Is it coming from some other place again?
   					AAA: adding var dump to bootstrap/start.php (or maybe on file change) starts showing the manually changed value of APP_ENV env var from php-fpm.conf on vagrant vm. Again $_SERVER works and $_ENV is empty
5) serve.sh writes down the nginx config files available on the vagrant vm automatically in /etc/nginx/sites-available/ and /etc/nginx/sites-enabled/ and restarts nginx and php-fpm
6) APP_ENV = 'local' is coming from all the env vars specified in $_SERVER (which works and $_ENV doesn't). $_SERVER also specifies GATEWAY_INTERFACE' => string 'CGI/1.1 
			QQQ: figure out what GATEWAY_INTERFACE' => string 'CGI/1.1 does
					A: simply a fastcgi_param specified in the fastcgi_params file
			QQQ: how to change APP_ENV in $_SERVER?
					A: 3 options (1) Homestead.yaml variables (2) php-fpm.conf (3) write a fastcgi_param (escape the quotes) in serve.sh which gets copied to the nginx/sites-available and sites-enables dirs
			QQQ: where is $_SERVER being set?
					A: who cares anymore
7) vagrant reload -> will only reload changes made to Vagrantfile. (equivalent of vagrant halt and vagrant up)
   vagrant reload --provision -> will force provisioners to re-run as well. this will reload changes to serve.sh AND Homestead.yaml
8) If blade isn't working for you, make sure the extension of your file is '.blade.php' instead of '.php'
9) CHECK: <input name="email" ...> helps on mobile by determining which symbols on the keyboard are provided to you
10) the Users::where('name','=', 'Test-Name-Input') matches 'Test-Name-Input' case insensitivally with the names in the 'name' col of Users table
11) the log file is at app/storage/logs/laravel.log


----
Todo:

1) write to DB from .php
	First pass: DONE @ 4:00pm
2) post to route from jquery
	DONE @ 3.31pm
3) load from DB and display in the view html.blade.php
	2 parts:
	Part1: load existing from DB
		DONE @ 4:57pm
	Part2: when user submits new, figure out if you want to del all and re-load entire table, or just check if saved indeed but add via jquery only (PUNT)
4) Add validation
5) Handle validation error showing and hiding
6) write form the Laravel Blade way
7) integrate .token into form
8) Make Tracking __ records functional
	1) Works when we re-load from DB and display count 
		DONE @ 5:03pm
	2) Needs to increment when the user hits the POST button in jquery

9) Do all of the above for Found-people-DB
	First pass: only Name and age storage and retrieval
		DONE @ 5:40pm
10) Make tabbed home a master layout and add sections
	Note: Master pages are usually used for reusing the layout. I'll use them for breaking a really large file into smaller manageable chunks
		FAIL: This did not work. 
11) Create migration and seed from csv file using Packalyst csv-seeder package. Also download composer Faker and way/generator
	1) Migration DONE @12:38am
	2) Manual seed from csv DONE @ 12:38am

---
Todo random later

1) Find out if there is a Laravel bootstrap theme


---
What is / Learn

1) routes.resource?
2) DB migrations
	  seeds
3) facade
4) Eloquent guarded property 


----
Todo Features

1) Avoid duplicates when people submitting names of found and missing people
2) Add 'claim' functionality to Found people display list
3) Add 'found' functionality to Find people display list (upload happy pic or something or add as 'success story')
4) Add leaderboard for most founds (will need some kind of user auth) (auth by mob num is fine)
5) Indian ARMY Updates Display
	Basic - DONE @ 1:02 am
6) Indian ARMY Updates Search
	Basic Form: 'Name' ONLY and Table: 'first-name' ONLY search (case insensitive) enabled
		DONE @ 3:48am
	DO : 1) age search
		 2) Name compared to 'first-name' AND 'last-name' (I think I'll have to use query builder for this)
7) Add 'How can I contribute' tab in nav-bar. And list names of contributors who help translate the update files commending them.

--todo
1) Deploy
2) Get domain name
3) Point deployment to domain name
4) Add google analytics


---
Timeline

Sat, Sep 13 2014 : Basic HTML, CSS, Bootstrap, jQuery skeleton up on Git
Sun, Sep 14 2014 : Vagrant vm homestead config and deployment
Mon, Sep 15 2014 : Hookup Laravel and Front-end. Hookup DB
                   Basic Indian ARMY Updates Display
                   Fixed-to-top nav bar with home and updates links working
				   Bought domain kashmirfloods2014.com

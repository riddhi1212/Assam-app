
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
8) How to create DB automatically in Laravel ? (then use same name in forge)
9) I want to call one controller method from another controller method. That is apparently against MVC principles. How do I do it instead?
10) HasMany vs BelongsToMany
11) looker_id NOT looker-id as default foreign key
12) where does var_dump(output go)


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
12) when creating a migration using php artisan migrate:make <name> --create, the auto generated file still says Schema::table instead of Schema::create. change it manually to run it properly
13) for Log::info an array is fine but an obj is not
14) HasMany returns a freaking class. SO use ->get(). i.e. User::find(1)->findPeople()->get();
	-	using Hash::make('a') and Hash::make('a') 2 times will give 2 different results
	-	Auth::attempt() will check the !!!plaintext!!! password against the !!!hashed password!!! we saved in our database
	-	The rememberToken col in Users table is used to provide "Remember Me" functionality by Auth class
	-	always say 'return Redirect::to()'
	-	Redirect::to('') can use path or name of route as argument
	-	A foreign-key id col name HAS to be specified as fillable to mass fill it.
	-	Redirect::to('url') takes URL, Redirect::route('name') takes named route.
	-	Floated elements do not add to the height of the element they reside in properly. A similar scenario is described here: css-tricks.com/the-how-and-why-of-clearing-floats

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
	2) Needs to increment when the user hits the POST button in jquery   *** TODO ***

9) Do all of the above for Found-people-DB
	First pass: only Name and age storage and retrieval
		DONE @ 5:40pm
10) Make tabbed home a master layout and add sections
	Note: Master pages are usually used for reusing the layout. I'll use them for breaking a really large file into smaller manageable chunks
		FAIL: This did not work. 
11) Create migration and seed from csv file using Packalyst csv-seeder package. Also download composer Faker and way/generator
	1) Migration DONE @12:38am
	2) Manual seed from csv DONE @ 12:38am
12) change 'looker-id' to User::lookeridcolname. So it can be referenced everywhere but changed only ONCE
	ALso figure out if this static const can be referenced from the migration and seeder

---
Todo random later

1) Find out if there is a Laravel bootstrap theme


---
What is / Learn

	-	routes.resource? B-DONE
	-	DB migrations B-DONE
	  	   seeds B-DONE
	-	facade
	-	Eloquent guarded property 
	-	route.group
			for applying filters to a bunch of routes
	-	Validator http://laravel.com/docs/validation
	-	Session::flash ?
	-	Laravel events / Model observers


----
Todo Features

1) Avoid duplicates when people submitting names of found and missing people
2) Add 'claim' functionality to Found people display list
3) Add 'found' functionality to Find people display list (upload happy pic or something or add as 'success story')
	Basic DONE
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
1) Deploy DONE
2) Get domain name DONE
3) Point deployment to domain name (know how to DO)
4) Add google analytics
5) Instrument code - Add kissmetrics or something
6) Log code w papertrail or something


---
Timeline

Sat, Sep 13 2014 : Basic HTML, CSS, Bootstrap, jQuery skeleton up on Git kafl
Sun, Sep 14 2014 : Vagrant vm homestead config and deployment
Mon, Sep 15 2014 : Hookup Laravel and Front-end. Hookup DB
                   Basic Indian ARMY Updates Display
                   Fixed-to-top nav bar with home and updates links working
				   Bought domain kashmirfloods2014.com
Tue, Sep 16 2014 : 4:50pm	-	Vagrant up working again! Phew!
				   8:50pm	-	User (Looker) and FindPeople one-to-many relationship works
				   				BUT : it currently makes a new User everytime the find-post form is submitted
				   12:32am	-	Basic Auth works and tested
				   1:32am	-	Basic Auth of find-person post-btn User done and redirect tested
				   1:59am	-	Basic dashboard with Name display and Logout and Auth protection done
				   3:13am	-	Basic find-person post-btn Auto-auth detection and html changes, fip creation,
				   				dashboard show fip list, Log In, Log Out buttons situational display tested
				   3:43am	-	Contributor->hasMany(ArmyUpdates). Migration and Seeders changed accordingly.
				   4:17am	-	Contributor->hasMany(ArmyUpdates). shows on dashboard.
				   4:35am	-	List of contributors done.
				   5:50am	-	Dashboard refactoring basic done
				   				DO : Home = Auth? Dashboard : ShowSummary
				   				DO : get('/') => Home
				   				DO : 'home' != 'fandf'. give fandf their own name.
				   6:21am	-	Dashboard refactoring pass two done
Wed, Sep 17 2014 : 9:20pm	-	basic messages and notification badge done
Thur, Sep18 2014 : 9:17am	-	Matching, msg gen and claiming (+dup claiming) done on new FIP post. Against AU and FOP DBs
				   12:21pm  -	Pagination AU page DONE


-----
Wed, Sep 17

TODO:

	-	Add validation (jquery, client)
			-	age is integer
	-	Handle validation error showing and hiding (jquery?)
	-	Do for all fields in find-people and found-people DB storage and retrieval (front, back)
	-	Search name against 
			-	firstname and lastname
			-	substr of firstname and lastname too
	-	List of all Contributors to ARMY-Updates-translation (DB show)
			-	List (DONE)
			-	Make graph by rows-contributed
	-	Make it easy for people to contribute
	-	Show Details section for every army-update-list view
	-	Pagination for army updates view
			- DONE


Importance of features

	-	Army Updates searchable
	-	Army Updates contribute in transcribing
			-	Also direct enter and submit
	-	Find people DB
	-	Summary view

---------
TODO Add SiteStats page:

	-	ARMYUPdates
			-	Num of searches run
					-	which returned results
					-	which didn't return results
			-	Num contributors
	-	Number of Matches happened
			-	Num successful
---------
Add donor pages:

	-	HelpAgeIndia
		http://www.helpageindia.org/jammu-kashmir.html
	-	GiveIndia
		http://www.giveindia.org/t-jammu-kashmir-flood-victim-relief.aspx
	-	Uday Foundation
		http://www.udayfoundationindia.org/jammu-and-kashmir-flood-relief-work/
	-	Hike
		http://get.hike.in/donate/
	-	PMRF
		Payment may be made by cheque/draft/cash in the name of "Prime Minister's National Relief Fund" and sent to the PMO in South Block, the statement said, adding as per directions on the subject, the nationalised banks will not charge any commission on preparation of drafts favouring the PMNRF.
	-	Sewa International
		http://sewainternational.org//Encyc/2014/9/10/Jammu-Kashmir-Appeal.aspx
	-	

---------
Updates:
	-	Sep 12
		<>
		In the worst-ever floods to hit the state in 109 years, over 250 people have lost their lives while more than 1.25 lakh people have been evacuated from the affected areas by the armed forces. Authorities fear that the number of dead could be higher
	- 	AAP MLAs donated 20 lac each
	-	BJP MLAs donated __ lac each





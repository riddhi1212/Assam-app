@extends('layouts/navhome')

<style>

.push-down {
	margin-top: 400px;
}

.info-bg {
	background-color: rgba(30,0,0, 0.7);
}

.upper {
	margin-top: 10px;
	background-color: rgba(30,0,0, 0.7);
}

.upper-info {
	color: white;
	padding-left: 10px;
	padding-top: 5px;
	padding-bottom: 5px;
}

.info {
	color: white;
	padding-top: 5px;
	padding-bottom: 5px;
}

.info a {
	text-decoration: none;
	color: #ff6582;
}

.info a:hover {
	text-decoration: none;
}

#background {
    width: 100%; 
    height: 100%; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
}

.stretch {
    width:100%;
    height:100%;
}

</style>

@section('content')
<div id="wrap">

	<div id="background">
	    <img src="images/bg1.jpg" class="stretch" alt="" />
	</div>
	
	<div class="row push-down">
		<div class="col-sm-8 col-sm-offset-2 info-bg">
			<div class="info">
				<h1>For those affected by the Assam and Meghalaya Floods in September 2014</h1>
				<ul>
					<li>
						<div>
							<h4>Search Indian ARMY Records of Rescued people <a href={{ route('updates') }}>here</a></h4>
							<p>The Indian ARMY is uploading names and ages of those rescued as pictures to its <span class="fa fa-twitter fa-fw fa-lg"></span>Twitter and <span class="fa fa-facebook fa-fw fa-lg"></span>Facebook accounts. <a target="_blank" href="https://www.facebook.com/Indianarmy.adgpi/photos/pb.123788044484500.-2207520000.1410784023./278003205729649/?type=3&permPage=1">Example</a></p>
							<p>This website is making these uploads <span class="fa fa-search fa-fw fa-lg"></span>Searchable by Name and Age (because pictures are not searchable) so people can find their loved ones quicker.</p>
						</div>
						<ul>
							<li>
								<div>
									<p>As you can imagine, there are a LOT of uploaded pictures and we alone CANNOT transcribe them all</p>
									<p>YOU CAN help by simply donating <span class="fa fa-clock-o fa-fw fa-lg"></span>30 minutes of your time <span class="fa fa-arrow-right fa-fw fa-lg"></span> Simply choose any one ARMY uploaded picture, type it out in <span class="fa fa-file-excel-o fa-fw fa-lg"></span>Excel and sent to us in .csv format. <a href={{ route('contributor.add.form') }}>Contribute NOW!</a>. See everyone else who has already contributed <a href={{ route('contributors') }}>here</a><span class="fa fa-thumbs-o-up fa-fw fa-lg"></span></p>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<div>
							<h4>Submit Missing Person Reports <a href={{ route('missing.person.report') }}>here</a> and Found Person Reports <a href={{ route('found.person.report') }}>here</a></h4>
							<p>Many people are commenting on the Indian ARMY Facebook Account uploaded pictures and posting info about Missing persons.</p>
							<p>This website allows people to post Missing Person Reports and Found Person Reports, and searches are automatically run and people are automatically notified when someone Finds a person they were Looking for. </p>
						</div>
						<ul>
							<li>
								<div>
									<p>Your dashboard will list your Missing Person Reports and also list all Matches (against the Army Updates Database and the Found Persons Database) per Missing Person Report.</p>
									<p>You can review all the matches, and Claim the Match that is correct, to <span class="fa fa-smile-o fa-fw fa-lg"></span>Successfully Resolve your Missing Persons Report.</p>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<div>
							<h4>All Donation Channels in one place <a href={{ route('donate') }}>here</a></h4>
							<p>This website is attempting to collect a lot of Donation Channels benefitting the victims in one place.</p>
							<p>If you want to <span class="fa fa-plus-square fa-fw fa-lg"></span>Add your Donation Channel to this website, you can add it <a href={{ route('donation.channel.add.form') }}>here</a>. In fact, if you don't already have a web-presence and are using Whatsapp messages to spread the word about your Collection Point for collecting supplies etc., you should Add your Channel here and this website will automatically make an Online Page for you. You can then send that URL to others.</p>
						</div>
					</li>
					<li>
						<div>
							<h4>See statistics collected by this website <a href={{ route('siteimpact') }}>here</a></h4>
						</div>
					</li>
					<li>
						<div>
							<h4>For any questions, you can <span class="fa fa-pencil-square-o fa-fw fa-lg"></span>Contact Me <a href={{ route('contact.me') }}>here</a></h4>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

@stop

@section('jsinclude')
        
@stop

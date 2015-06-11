
<!doctype html>
<html lang="en">
<head>
		<title>Gamasutra: Ivan Mir's Blog - Postmortem: Traps for Friends - our attempt at fair IAP multiplayer</title>
	<meta name="pagecaching" content="121" />
	<meta name="serveraddress" content="192.155.49.228" />
	<meta name="keywords" content="game development, game developer, game programming, game programmer, videogame, artificial intelligence, 3D animation, game design, 3D modeling, game business, game jobs, game directory, game development software, game technology, 3D technology, game producer, game audio, game animation, virtual reality, digital entertainment, PC game, Xbox game, game news, new game, arcade development, Nintendo development, Playstation development, Playstation 2, PS2, Dreamcast development, Game Developer magazine, Computer Game Developers Conference, Game Developers Conference, Independent Game Developers Conference, CMP Game Media Group, game industry research, online game development, digital assets, free textures, free 3D models, free shaders, Gamasutra Exchange, 3D Studio Max textures" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		
			.hide_phone > iframe {
				width: 100%;
			}
			@media only screen and (max-width:479px){
				.hide_phone > iframe {
					height: auto;
				}
			}
			.properties ul li {
				padding: 5px 28px !important;
			}
		
	</style>
	<!-- CSS -->
        
                        
                	<link rel="canonical" href="http://gamasutra.com/blogs/IvanMir/20150217/236560/Postmortem_Traps_for_Friends__our_attempt_at_fair_IAP_multiplayer.php" />
                <link rel="alternate" type="application/rss+xml" title="Gamasutra Article Feed" href="http://feeds.feedburner.com/GamasutraFeatureArticles/" />
        <link rel="alternate" type="application/rss+xml" title="Gamasutra News Feed" href="http://feeds.feedburner.com/GamasutraNews/" />
        <link rel="alternate" type="application/rss+xml" title="Gamasutra Columns Feed" href="http://feeds.feedburner.com/GamasutraColumns/" />
        <link rel="alternate" type="application/rss+xml" title="Gamasutra Jobs Feed" href="http://feeds.feedburner.com/GamasutraJobs/" />
        <link href="//twimgs.com/gamasutra/css/minified.css" rel="stylesheet" type="text/css" />
		<style>
			
				#div-gpt-ad-Ltile1 {
					margin-top: 10px;
				}
			
		</style>
        
        <meta name="node" content="228"/>
        <meta name="pagecaching" content="646"/>
                <script type="text/javascript" src="//twimgs.com/gamasutra/js/redesign_comments.js"></script>
		<script src="//code.jquery.com/jquery-1.8.2.min.js"></script>
		<script type="text/javascript"> 
        
		function checkMail(obj){
	 
		   var think_opt_out = document.getElementById('Think_Opt_Out');
	 
		   if (document.getElementById('Think_Opt_Out').checked) {
	 
				 document.getElementById('Think_Opt_In').value = 0;
		   } else {
	 
				 document.getElementById('Think_Opt_In').value = 1;
		   }
		   var firstname = document.getElementById('firstname').value;
		   if (firstname == ""){
				 alert('Please provide your first name');
				 return false;
		   }
	 
		   if (document.getElementById('lastname').value == ''){
				 alert("Please provide your lastt name");
				 return false;
		   }
	 
	 
		   var x = document.getElementById('EmailAddr').value;
	 
		   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		   if (filter.test(x)) { return true; }
		   else  { alert('Invalid Email Address detected. Please correct.'); return false; }
	 
	 
		}
		 
		</script>
        <script type="text/javascript" src="//twimgs.com/gamasutra/js/md5.js"></script>

        

        <script type="text/javascript">
        var adrand = parseInt(Math.random()*1000000000, 10);
        var adkeys = "key1+key2+key3+key4";
        </script>

        	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<script type="text/javascript">
            
		var browser			= navigator.userAgent;
		var browserRegex	= /(Android|BlackBerry|IEMobile|Nokia|iP(ad|hone|od)|Opera M(obi|ini))/;
		var isMobile		= false;
		if(browser.match(browserRegex)) {
			isMobile			= true;
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){
				window.scrollTo(0,1);
			}
		}
        
	</script>

        <!-- Start Visual Website Optimizer Asynchronous Code -->
        <script type='text/javascript'>
        
        var _vwo_code=(function(){
        var account_id=32069,
        settings_tolerance=2000,
        library_tolerance=2500,
        use_existing_jquery=false,
        // DO NOT EDIT BELOW THIS LINE
        f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
        
        </script>
        <!-- End Visual Website Optimizer Asynchronous Code -->
        
        <!-- Start: GPT Sync -->
        <script type='text/javascript'>
         
         var gptadslots=[];
         (function(){
          var useSSL = 'https:' == document.location.protocol;
          var src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
          document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
         })();
         
        </script>

        <script type="text/javascript">
              
                      googletag.pubads().setTargeting('kw',['design','production','art','smartphone-tablet']);
                                            googletag.pubads().setTargeting('aid',['236560']);
           
            
          //Adslot 1 declaration
          gptadslots[1]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[1,2]],'div-gpt-ad-skin').setTargeting('pos',['skin']).addService(googletag.pubads());

          //Adslot 2 declaration
          gptadslots[2]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[728,90]],'div-gpt-ad-top').setTargeting('pos',['top']).addService(googletag.pubads());

          //Adslot 3 declaration
          gptadslots[3]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[164,59]],'div-gpt-ad-button1').setTargeting('pos',['button1']).addService(googletag.pubads());

          //Adslot 4 declaration
          gptadslots[4]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[164,59]],'div-gpt-ad-button2').setTargeting('pos',['button2']).addService(googletag.pubads());

          //Adslot 5 declaration
          gptadslots[5]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[164,409]],'div-gpt-ad-callout').setTargeting('pos',['callout']).addService(googletag.pubads());

          //Adslot 6 declaration
          gptadslots[6]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[300,250]],'div-gpt-ad-rec1').setTargeting('pos',['rec1']).addService(googletag.pubads());

          //Adslot 7 declaration
          gptadslots[7]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[160,600]],'div-gpt-ad-sky1').setTargeting('pos',['sky1']).addService(googletag.pubads());

          //Adslot 8 declaration
          gptadslots[8]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[160,160]],'div-gpt-ad-Ltile1').setTargeting('pos',['Ltile1']).addService(googletag.pubads());

          //Adslot 9 declaration
          gptadslots[9]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[164,177]],'div-gpt-ad-custom1').setTargeting('pos',['custom1']).addService(googletag.pubads());

          //Adslot 10 declaration
          gptadslots[10]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[666,171]],'div-gpt-ad-custom2').setTargeting('pos',['custom2']).addService(googletag.pubads());

          //Adslot 11 declaration
          gptadslots[11]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[164,177]],'div-gpt-ad-custom3').setTargeting('pos',['custom3']).addService(googletag.pubads());
          
                    	gptadslots[12]= googletag.defineSlot('/2441/Gamasutra/smartphonetablet', [[4,4]],'div-gpt-ad-custom4').setTargeting('pos',['video']).addService(googletag.pubads());
          
          googletag.pubads().enableSingleRequest();
          googletag.pubads().enableSyncRendering();
          googletag.enableServices();
        </script>
        <!-- End: GPT -->
	
	<script type="text/javascript">
	
	  var _AdsNativeOpts =
	  {
	
		keywords: ['smartphonetablet']
	
	  };
	
	</script>
        
        <script src="/ckeditor/ckeditor.js"></script>
        <script src="/ckfinder/ckfinder.js"></script>
 		<script type="text/javascript">
 		
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-48094207-1']);
			_gaq.push(['_trackPageview']);
			(function()
			{ var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); }
			)();
		
		</script>
</head>
<body >
    <div class="hide-phone">
                                <!-- Beginning Sync AdSlot 1 for Ad unit Gamasutra//smartphonetablet ### size: [[1,2]]  -->
<div id='div-gpt-ad-skin'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-skin');
 </script>
</div>
<!-- End AdSlot 1 -->
            </div>

    <div class="hide-phone">
         <div class="wrapper properties">
            <div class="container">
                    <ul>
                        <li>Our Properties:</li>
                        <li class="activetab"><a href="http://www.gamasutra.com" class="active">Gamasutra</a></li>
                        <li><a href="http://www.gamecareerguide.com">GameCareerGuide</a></li>
                        <li><a href="http://www.indiegames.com">IndieGames</a></li>
                        <li><a href="http://www.gdcvault.com">GDC Vault</a></li>
                        <li><a href="http://www.gdconf.com">GDC</a></li>
                        <li><a href="http://www.igf.com">IGF</a></li>
                   </ul>
              </div>
         </div><!--end wrapper-->
    </div>
    
    <br />
     <div class="container bottom3">
     	<div class="span-7">
          	<a href="http://gamasutra.com"><img src="http://twimgs.com/gamasutra/images/gamasutra_logo.png" alt="Gamasutra: The Art &amp; Business of Making Games" width="243" height="77" border="0" /></a><img alt="spacer" src="http://twimgs.com/gamasutra/images/spacer.gif" width="27" />
		</div>
          <div class="hide-phone">
              <div class="div span-16 last leaderboard">
                     
                                                                               <!-- Beginning Sync AdSlot 2 for Ad unit Gamasutra//smartphonetablet ### size: [[728,90]]  -->
<div id='div-gpt-ad-top'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-top');
 </script>
</div>
<!-- End AdSlot 2 -->
                                           
    
              </div>
          </div>
    </div>
          
<div class="container"> 
		<div class="span-20">
                    <div class="show-phone"><!--there is another on the page for the regular size, this is phone only-->
                         <div class="span-5 last nav_search">
                              <div class="content center">
                                   <span class="nav_searchtxt">SEARCH</span>
                                   <form class="left" name="topsearchph" action="http://gamasutra.com/search/" method="GET">
          
                                               <input name="search_text" type="text" size="25" class="search" />	  
                                              <span class="nav_searchbutton"><a href="" onClick="javascript: document.topsearchph.submit(); return false;">GO</a></span>
                                   
                                   </form>
                              </div>
                         </div>
                    </div><!--end show phone-->
                    
                    <div class="show-phone"><!--sadie change-->
                        <div class="span-3">
                                  <div class="login_phone" id="login_phone">
                                       
                                   </div>
                        </div>
                    </div><!--end showphone-->
                    <div class="nav">
                	<div class="span-3 nav_jobs">
                    	<div class="content">
                              <a href="http://jobs.gamasutra.com/">GAME JOBS</a>
                          </div>
                    </div>
                    <div class="span-12 nav_links">
                         <div class="content">
                                   <a href="http://gamasutra.com/updates/">updates</a>
                                   <a href="http://gamasutra.com/blogs/">Blogs</a>
                                   <a href="http://gamasutra.com/calendar/calendar.php">events</a>
                                   <a href="http://gamasutra.com/contractors/contractor_display.php">contractors</a>
                                   <a href="http://gamasutra.com/sso/profile.php#newsletters">newsletter</a>
                                   <a href="https://store.cmpgame.com/storefront.php?loc=&skin=gamasutra_redesign">store</a>
                         </div>
                    </div>
                    <div class="hide-phone">
                        <div class="span-5 last nav_search">
                             <div class="content">
                                  <span class="nav_searchtxt">SEARCH</span>
                                  <form class="left" name="topsearch" action="http://gamasutra.com/search/" method="GET">

                                              <input name="search_text" type="text" size="10" class="search" />	  
                                             <span class="nav_searchbutton"><a href="" onClick="javascript: document.topsearch.submit(); return false;">GO</a></span>

                                    </form>
                             </div>
                        </div>
                    </div>
                    <br class="clear">
               </div><!--end nav-->
               <div class="hide-phone"> 
                    <div class="span-20 last"> 
                       <div class="topicmenu">
                            <ul>
                                <li class="activetab"><a href="http://gamasutra.com">ALL</a>
                                </li><li ><a href="http://gamasutra.com/topic/console-pc">CONSOLE/PC GAMES</a>
                                </li><li ><a href="http://gamasutra.com/topic/social-online">SOCIAL/ONLINE GAMES</a>
                                </li><li ><a href="http://gamasutra.com/topic/smartphone-tablet">SMARTPHONE/TABLET GAMES</a>
                                </li><li ><a href="http://gamasutra.com/topic/indie">INDEPENDENT GAMES</a>
                                 </li></ul>
                                                          <span class="gdmag"><a href="http://gamasutra.com/topic/game-developer"><img src="http://twimgs.com/gamasutra/images/btn_gdmag0.png" width="118px" height="33px"></a></span>
                       </div>
                   </div>
               </div>		
                    <div class="span-20 last content_bg">
                        <div class="hide-phone">
<div class="span-4">
  <div class="content_box_left">
    <div class="leftcol">
        <!--member login-->
                    <table width="166" border="0" cellspacing="0" cellpadding="0">
  <tr>   
    <td id="memberLogin" class="welcome">
    	
    </td>   
  </tr>
</table>                 <!--end memberlogin-->
        
        <!--begin social icons-->
            <!--begin social icons-->
<div  class="bottom2">
    <ul class="leftcol_social">
       <li class="facebook"><a href="http://www.facebook.com/pages/Gamasutra/31610613408" target="_blank">&nbsp;</a></li>
       <li class="twitter"><a href="http://twitter.com/gamasutra" target="_blank">&nbsp;</a></li>
       <li class="feed"><a href="http://gamasutra.com/static2/rssfeeds.html">&nbsp;</a></li>
       <li class="newsletter"><a href="/sso/profile.php#newsletters">&nbsp;</a></li>
    </ul>
</div>
<!--end social icons-->        <!--end social icons-->
        
        <!--begin page numbers-->
                <!--end page numbers-->
        
        <!--begin leftnav-->
                <div class="leftnav_categories bottom2">
   <a href="http://gamasutra.com/category/programming/"><img alt="arrow" src="http://twimgs.com/gamasutra/images/button_programming.gif"  width="24px" height="24px" /></a>
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/programming/">PROGRAMMING</a></div>

   <hr>

   <a href="http://gamasutra.com/category/art/"><img alt="spacer" src="http://twimgs.com/gamasutra/images/button_art.gif" width="24px" height="24px" /></a>
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/art/">ART</a></div>

   <hr>

   <a href="http://gamasutra.com/category/audio/"><img alt="spacer" src="http://twimgs.com/gamasutra/images/button_audio.gif" width="24px" height="24px"  /></a>         
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/audio/">AUDIO</a></div>

   <hr>

   <a href="http://gamasutra.com/category/design/"><img alt="arrow" src="http://twimgs.com/gamasutra/images/button_design.gif" width="24px" height="24px"  /></a>
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/design/">DESIGN</a></div>

   <hr>

   <a href="http://gamasutra.com/category/production/"><img alt="arrow" src="http://twimgs.com/gamasutra/images/button_production.gif" width="24px" height="24px" /></a>
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/production/">PRODUCTION</a></div>

   <hr>
   <a href="http://gamasutra.com/category/business-marketing/"><img alt="arrow" src="http://twimgs.com/gamasutra/images/button_business.gif" width="24px" height="24px"  /></a>
   <div class="leftnav_btn"><a href="http://gamasutra.com/category/business-marketing/">BIZ/MARKETING</a></div>

   <br class="clear">
</div>          <!--end leftnav-->
                  
                    <!-- Beginning Sync AdSlot 3 for Ad unit Gamasutra//smartphonetablet ### size: [[164,59]]  -->
<div id='div-gpt-ad-button1'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-button1');
 </script>
</div>
<!-- End AdSlot 3 -->
            <!-- Beginning Sync AdSlot 4 for Ad unit Gamasutra//smartphonetablet ### size: [[164,59]]  -->
<div id='div-gpt-ad-button2'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-button2');
 </script>
</div>
<!-- End AdSlot 4 -->
            <!-- Beginning Sync AdSlot 5 for Ad unit Gamasutra//smartphonetablet ### size: [[164,409]]  -->
<div id='div-gpt-ad-callout'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-callout');
 </script>
</div>
<!-- End AdSlot 5 -->
            <!-- Beginning Sync AdSlot 9 for Ad unit Gamasutra//smartphonetablet ### size: [[164,177]]  -->
<div id='div-gpt-ad-custom1'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-custom1');
 </script>
</div>
<!-- End AdSlot 9 -->
            <!-- Beginning Sync AdSlot 11 for Ad unit Gamasutra//smartphonetablet ### size: [[164,177]]  -->
<div id='div-gpt-ad-custom3'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-custom3');
 </script>
</div>
<!-- End AdSlot 11 -->
                
        <!-- begin event tickers -->
			              
        <!-- end event tickers -->
	
         <!--begin jobs-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_jobs.png" width="22px" height="20px"/><a href="http://jobs.gamasutra.com/">Latest Jobs</a></div>
<div class="leftnav bottom2">
     <a href="http://jobs.gamasutra.com/"><strong>View All</strong></a> &nbsp;&nbsp;&nbsp;
     <a href="http://feeds.feedburner.com/GamasutraJobs"><strong>RSS</strong></a>
     <hr>
     <strong>June 11, 2015</strong>
     <hr>
     <ul>    
            <li>Performance Designed Products<br />
              <a href="http://jobs.gamasutra.com/job/pm2-burbank-california-28794">PM2</a>
        </li>
        <li class="line"></li>
            <li>Gearbox Software<br />
              <a href="http://jobs.gamasutra.com/job/technical-producer-frisco-texas-28866">Technical Producer</a>
        </li>
        <li class="line"></li>
            <li>Turbine Inc.<br />
              <a href="http://jobs.gamasutra.com/job/senior-platform-services-engineer-needham-massachusetts-28694">Senior Platform Services Engineer</a>
        </li>
        <li class="line"></li>
            <li>CCP <br />
              <a href="http://jobs.gamasutra.com/job/senior-brand-manager-newcastle-england-28758">Senior Brand Manager </a>
        </li>
        <li class="line"></li>
            <li>Shiver Entertainment<br />
              <a href="http://jobs.gamasutra.com/job/executive-producer-miami-florida-28757">Executive Producer</a>
        </li>
        <li class="line"></li>
            <li>Digital Extremes<br />
              <a href="http://jobs.gamasutra.com/job/pr-manager-london-ontario-28861">PR Manager</a>
        </li>
        <li class="line"></li>
         </ul>    
</div>
         <!--end jobs-->   
           			
         <!--begin blogs-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_blogs.png" width="22px" height="20px"/><a href="http://gamasutra.com/blogs/">Latest Blogs</a></div>
<div class="leftnav bottom2">
    <a href="http://gamasutra.com/blogs/"><strong>View All</strong></a> 
    &nbsp;&nbsp;&nbsp; <a href="http://gamasutra.com/blogs/edit/"><strong>Post</strong></a>
    &nbsp;&nbsp;&nbsp; <a href="http://gamasutra.com/blogs/rss/"><strong>RSS</strong></a>
    <hr>
    <strong>June 11, 2015</strong>
    <hr>   
    <ul>
        
        <li>
            <a href="/blogs/MaryMin/20150610/245625/Six_Strategies_for_Protecting_Your_Mobile_Games_Against_Hackers_Crackers__Copycatters.php">Six Strategies for Protecting Your Mobile Games Against Hackers, Crackers & Copycatters</a>
             
                [<a title="2 comments" href="/blogs/MaryMin/20150610/245625/Six_Strategies_for_Protecting_Your_Mobile_Games_Against_Hackers_Crackers__Copycatters.php#comments">2</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="/blogs/SandeChen/20150610/245669/Reward_Me_Demotivate_Me.php">Reward Me, Demotivate Me</a>
             
                [<a title="2 comments" href="/blogs/SandeChen/20150610/245669/Reward_Me_Demotivate_Me.php#comments">2</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="/blogs/AlexandreMandryka/20150609/245499/Assassins_Creed_Flow.php">Assassin's Creed Flow</a>
             
                [<a title="1 comments" href="/blogs/AlexandreMandryka/20150609/245499/Assassins_Creed_Flow.php#comments">1</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="/blogs/AnneChristineGasc/20150609/245516/10_things_you_should_know_about__leads_and_managers.php">10 things you should know about ... leads and managers</a>
             
                [<a title="2 comments" href="/blogs/AnneChristineGasc/20150609/245516/10_things_you_should_know_about__leads_and_managers.php#comments">2</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="/blogs/JamieSmith/20150609/245527/Design_Lessons_From_The_Witcher_3.php">Design Lessons From The Witcher 3</a>
             
                [<a title="14 comments" href="/blogs/JamieSmith/20150609/245527/Design_Lessons_From_The_Witcher_3.php#comments">14</a>]
                    </li>
        <li class="line"></li>
       
    </ul>
</div>
         <!--end blogs-->
         
         <!--begin features archive-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_blogs.png" width="22px" height="20px"/><a href="http://gamasutra.com/php-bin/article_display.php">Features</a></div>
<div class="leftnav bottom2">
    <a href="http://gamasutra.com/php-bin/article_display.php"><strong>View All</strong></a> 
    &nbsp;&nbsp;&nbsp; <a href="http://feeds.feedburner.com/GamasutraFeatureArticles"><strong>RSS</strong></a>
    <hr>
    <strong>June 11, 2015</strong>
    <hr>   
    <ul>
        
        <li>
            <a href="http://gamasutra.com/view/feature/233340/postmortem_pinballrpg_hybrid_.php">Postmortem: Pinball-RPG hybrid <i>Rollers of the Realm</i></a>
                            [<a title="5 comments" href="http://gamasutra.com/view/feature/233340/postmortem_pinballrpg_hybrid_.php#comments">5</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/view/feature/233119/best_of_2014_gamasutras_top_.php">Best of 2014: Gamasutra's Top Games of the Year</a>
                            [<a title="10 comments" href="http://gamasutra.com/view/feature/233119/best_of_2014_gamasutras_top_.php#comments">10</a>]
                    </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/view/feature/231505/qa_new_aaa_studio_from_2k_games_.php">Q&A: New AAA studio from 2K Games all about players' stories</a>
                            [<a title="7 comments" href="http://gamasutra.com/view/feature/231505/qa_new_aaa_studio_from_2k_games_.php#comments">7</a>]
                    </li>
        <li class="line"></li>
       
    </ul>
</div>	         <!--end features archive-->
		 
		 <!--begin Theme Week Archive -->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_blogs.png" width="22px" height="20px"/><a href="http://gamasutra.com/specialreports">Special Reports</a></div>
<div class="leftnav bottom2">
    <ul>
        
        <li>
            <a href="http://gamasutra.com/deepdives">Game Design Deep Dives</a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/oculusconnect2014">A Peek Into the Future of VR: Oculus Connect 2014</a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/YouTube">The YouTube Effect</a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/VR">VR/Advanced Input/Output </a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/digital-publishing">Digital Publishing</a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/microconsole">Microconsole Game Development</a>
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/alternative-funding">Crowdfunding and Alternative Funding</a>
        </li>
        <li class="line"></li>
        
    </ul>
</div>
         <!--end Theme Week Archive -->
                         
         <!--begin press releases-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_blogs.png" width="22px" height="20px"/>Press Releases</div>
<div class="leftnav bottom2">
    <strong>June 11, 2015</strong>
	<hr>
	<a href="http://gamasutra.com/prnewswire.php"><strong>PR Newswire</strong></a> 
	<hr>
	<!-- PRNewswire Headline Widget Code Starts Here -->
	<style type="text/css">
	
	  #prn_overrides{margin:0 10px 10px 3px; }
	  #prn_overrides table{background-color:transparent;}
	  #prn_overrides table td{background-color:transparent;}
	  #prn_overrides td.linkcell_prn{background:url(//twimgs.com/gamasutra/images/gray_arrow2.gif) no-repeat 0px 7px;padding-left:12px;display:block;width:130px;}
	  #prn_overrides a.headlinelink_prn{font-family: Verdana, Arial, Helvetica, sans-serif; }
	
	</style>
	<div id="prn_overrides"></div>
	<script type="text/javascript" src="http://widget.prnewswire.com/widget/widget.js?&container=prn_overrides&dir=0&categories=GAMING-PURE&rude=1&preset=4&expandheight=1&width=&height=&showlogos=0&numresults=3&numwords=10&widgettitle=&hlineorbrief=hline&bold=0&link=&visitedcolor=FFFFFF&textcolor=666666&borderstyle=dotted&bordersize=1&bordercolor=AAAAAA&getwidget=0&incldate=0&morenews=0&morevids=0&inclcity=0&p=http://gamasutra.com/prnewswire.php&hlen=50&"></script>
	<!-- PRNewswire Headline Page Widget Code Ends Here -->
	<a href="http://gamasutra.com/prnewswire.php"><strong>View All</strong></a>
	<hr>
</div>
<div class="leftnav bottom2">
   <a href="http://gamasutra.com/pressreleases_index.php"><strong>Games Press</strong></a>
   <hr>
   <ul>
          
        <li>
            <a href="http://gamasutra.com/view/pressreleases/245788/DevelopBrighton_2015_Launches_The_Peoplersquos_Choice
Session.php">Develop:Brighton 2015<br />
Launches The<br />
People&rsquo;s...</a>
        </li>
        <li class="line"></li>
          
        <li>
            <a href="http://gamasutra.com/view/pressreleases/245783/Simplygon_Reduces_Polycount_of_Dying_Lightrsquos_Key_Assets
by_70_Percent.php">Simplygon Reduces<br />
Polycount of Dying<br />
Light&rsquo;s...</a>
        </li>
        <li class="line"></li>
          
        <li>
            <a href="http://gamasutra.com/view/pressreleases/245782/Simplygon_Reduces_Polycount_of_Dying_Lightrsquos_Key_Assets
by_70_Percent.php">Simplygon Reduces<br />
Polycount of Dying<br />
Light&rsquo;s...</a>
        </li>
        <li class="line"></li>
          
        <li>
            <a href="http://gamasutra.com/view/pressreleases/245767/The_Bards_Tale_Trilogy_Free_to_All_Kickstarter
Backers.php">The Bard's Tale Trilogy<br />
Free to All<br />
Kickstarter...</a>
        </li>
        <li class="line"></li>
          
        <li>
            <a href="http://gamasutra.com/view/pressreleases/245769/lsquoGladiators_Onlinersquo_On_Steamtrade_Greenlight
Promises_The_Thrill__Excitement_Of_Coliseum_Combat.php">&lsquo;Gladiators<br />
Online&rsquo; On<br />
Steam&trade;...</a>
        </li>
        <li class="line"></li>
         </ul>
   <a href="http://gamasutra.com/pressreleases_index.php"><strong>View All</strong></a> 
   &nbsp;&nbsp;&nbsp; <a href="http://gamasutra.com/pressreleases/rss/"><strong>RSS</strong></a>
</div>         <!--end press releases-->
                         
         <!--begin calendar-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_calendar.png" width="22px" height="20px"/><a href="http://gamasutra.com/calendar/calendar.php">Calendar</a></div>
<div class="leftnav bottom2">
    <a href="http://gamasutra.com/calendar/calendar.php"><strong>View All</strong></a> &nbsp;&nbsp;&nbsp; <a href="http://gamasutra.com/calendar/calendar_submit.php"><strong>Submit Event</strong></a>
    <hr>
    <ul>
        
        <li>
            <a href="http://gamasutra.com/calendar/calendar.php?event_id=1549"><strong>CGC Europe</strong></a><br />
            Frankfurt am Main, Germany<br />
            06.19.2015
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/calendar/calendar.php?event_id=1540"><strong>iGaming Super Show</strong></a><br />
            Amsterdam, Netherlands<br />
            06.23.2015
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/calendar/calendar.php?event_id=1551"><strong>Enterprise Apps World</strong></a><br />
            London, United Kingdom<br />
            06.24.2015
        </li>
        <li class="line"></li>
        
        <li>
            <a href="http://gamasutra.com/calendar/calendar.php?event_id=1552"><strong>Game QA and Localisation Europe 2015</strong></a><br />
            Barcelona, Spain<br />
            06.30.2015
        </li>
        <li class="line"></li>
        
    </ul>
</div>         <!--end calendar-->
                         
         <!--begin about-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_about.png" width="22px" height="20px"/><a href="http://gamasutra.com/contactus">About</a></div>
<div class="leftnav bottom2">
    <ul>
            <li><strong>Editor-In-Chief: </strong><br /><a href="mailto:kgraft@gamasutra.com">Kris Graft</a></li>
            <li class="line"></li>
            <li><strong>Blog Director: </strong><br /><a href="mailto:christian.nutt@ubm.com">Christian Nutt</a></li>
            <li class="line"></li>
            <li><strong>Senior Contributing Editor: </strong><br /><a href="mailto:bsheffield@gdmag.com">Brandon Sheffield</a></li>
            <li class="line"></li>
            <li><strong>News Editors: </strong><br /> <a href="mailto:alex.wawro@ubm.com">Alex Wawro</a></li>
            <li class="line"></li>
            <li><strong>Advertising/<br />Recruitment: </strong><br /><a href="mailto:jennifer.sulik@ubm.com">Jennifer Sulik</a></li>
            <li class="line"></li>
            <li><strong>Recruitment/<br />Education: </strong><br /><a href="mailto:pocco.jimenez@ubm.com">Pocco Jimenez</a></li>
    </ul>
    <hr>
    <div class="center"><a href="http://gamasutra.com/contactus">Contact Gamasutra</a></div>
    <hr>
    <div class="center"><a href="mailto:support@gamasutra.com">Report a Problem</a></div>
    <hr>
    <div class="center"><a href="mailto:news@gamasutra.com">Submit News</a></div>
    <hr>
    <div class="center"><a href="http://gamasutra.com/static2/comment_guidelines.html">Comment Guidelines</a></div>
    <hr>
    <div class="center"><a href="http://gamasutra.com/static2/blogsubmissions.html">Blogging Guidelines</a></div>
	<hr>
    <div class="center"><a href="http://gamasutra.com/static2/howwework.html">How We Work</a></div>
</div>

<div class="bottom2">
    <a href="http://www.jointhegamenetwork.com/online/gamasutra/index.html" target="_blank">
        <img src="http://twimgs.com/gamasutra/images/AdwGama_177x60_button_v1.jpg" alt="Sponsor" border="0" class="whiteTop"  width="177px" height="60px"/>
    </a>
</div>
             <!--end about-->
         
         <!--begin network-->
            <div class="header"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_about.png" width="22px" height="20px"/><a href="#">Gama Network</a></div>
<div class="leftnav_network bottom2">
    If you enjoy reading this site, you might also want to check out these UBM Tech sites:
    <hr>
    <a href="http://www.gamecareerguide.com"><!-- img src="http://www.indiegames.com/blog/gcgmini.jpg" align="left" hspace="2"/ --></a> 
    <div class="leftnav_btn"><a href="http://www.gamecareerguide.com">Game Career Guide</a></div>
    <hr>
    <a href="http://www.indiegames.com/blog"><!-- img src="http://www.indiegames.com/blog/indiemini.jpg" align="left" hspace="2"/ --></a>
    <div class="leftnav_btn"><a href="http://www.indiegames.com/blog">Indie Games</a></div>
    <br class="clear">
</div>         <!--end network-->
         
         <!--begin store-->
                     <!--end store-->
         
                
    </div><!--end leftcol-->
  </div>
</div> 
</div>  <div class="span-16 last">
    <div class="content_box_middle">
        <!-- InstanceBeginEditable name="BodyContent" --> 
        <div class="header_large">
            <span class="left"><img alt="arrow" src="http://twimgs.com/gamasutra/images/icon_blogs.png"/><a href="/blogs/">Blogs</a></span>
        </div>
        <div class="page_item"> 
                        <div class="clear">&nbsp;</div>
            <div class="item_title">Postmortem: Traps for Friends - our attempt at fair IAP multiplayer</div>
            <div>
                <span class="newsAuth">by <a href="/blogs/author/IvanMir/951453/">Ivan Mir</a> on 02/17/15 01:57:00 pm 
                                        &nbsp; <img valign="bottom" border="0" src="http://twimgs.com/gamasutra/images/featuredIcon_gamaBlog.gif" alt="Featured Blogs" />                                        <br />
                </span>
            </div>
            <div>
                <br>
                                    <span class="comment_text">
                                                    <a href="#comments">Post A Comment</a>
                                            </span>
                    <a name="twitter_share" type="button" href="http://twitter.com?status=RT @gamasutra: Postmortem: Traps for Friends - our attempt at fair IAP multiplayer http://www.gamasutra.com/blogs/IvanMir/20150217/236560/" target="_blank"><img src="http://twimgs.com/gamasutra/images/twitter.gif" alt="Share on Twitter" border="0" height="20"/></a>
                    <a name="fb_share" type="button" href="http://www.facebook.com/sharer.php?u=http://www.gamasutra.com/blogs/IvanMir/20150217/236560/Postmortem_Traps_for_Friends__our_attempt_at_fair_IAP_multiplayer.php" target="_blank"><img src="http://twimgs.com/gamasutra/images/facebook_button.png" alt="Share on Facebook" border="0"/></a> <!-- <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> -->
                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                    <g:plusone size="medium" count="false"></g:plusone>
					<span id="edit_post_link"></span>&nbsp;&nbsp;
					<a href="/blogs/rss/"><img src="http://twimgs.com/gamasutra/images/icon_rss.gif" width="15" height="15" border="0" alt="RSS" /></a>
                            </div>
            <hr>
            <div class="item_body mobile_image_transform">       
                <strong><i><small>
                    The following blog post, unless otherwise noted, was written by a member of Gamasutra’s community.<br />
                    The thoughts and opinions expressed are those of the writer and not Gamasutra or its parent company.
                </small></i></strong>
                <hr>
                <div class="clear">&nbsp;</div>
                <p>Two years ago, we decided to improve the lack of turn-based PvP on mobile. At the end of 2013, we founded ComboCats Studio to create a turn-based gaming platform where you could easily add new games and have a single account between them.</p>

<p>Traps for Friends was a &ldquo;test&rdquo; game to build the platform and see how some of the ideas would work. It&rsquo;s a game about building a castle, setting up traps, and then trying to steal the opponent&rsquo;s treasure while she is invading to steal yours. The process for defusing traps is based on rock-paper-scissors-like mechanics: the heroes have different weaknesses and immunities against different kinds of traps. At first glance, you&rsquo;re playing with pure luck. But like in a regular RPS, you can play psychological games by trying to predict which hero your opponent will choose or set up traps of one type only to cause confusion.</p>

<p>How can we make a multiplayer game fair and IAP-based at the same time? That was a tough question that I hope we solved well.</p>

<p style="text-align: center;"><a href="http://i.imgur.com/gxmf6vC.png" target="_blank"><img alt="Traps for Friends - Splash" height="400" src="http://gamasutra.com/db_area/images/blog/236560/_splash_th.png" title="" width="349" /></a></p>

<h1><strong>Art</strong></h1>

<p><strong>What we think went right</strong></p>

<p>From the beginning, we wanted to have an &ldquo;Adventure Time&rdquo; feel of a magical world that lives on its own. But we felt that it&rsquo;s not only about the visual style.</p>

<p>We analyzed the art of many other games, and what we didn&rsquo;t like in many of them was a half-broken 4th wall, where the characters are posing and looking directly in the camera. So we tried to make our heroes act more natural, as if they are just minding their own business in their world and looting castles for life. We also tried to make their personalities realistic and not exaggerated.</p>

<p style="text-align: center;"><img alt="" height="229" src="http://gamasutra.com/db_area/images/blog/236560/___lineup.png" width="640" /></p>

<p>There&rsquo;s also no assistant character at the start to help you click through the UIs for the first time. Sure, it might make the first user experience less personal, but we think this kind of forced interaction can interrupt player&rsquo;s immersion. It&rsquo;s like a store assistant suddenly asking you if you need any help while you&rsquo;re minding your own business.</p>

<p>To make the game more alive, we created small spirits to inhabit the backgrounds. These spirits sometimes appear to run and fly through, or they just peep out from screen borders to take a look at what&rsquo;s happening. The backgrounds are animated too: the flames burn, the eyes rotate, etc.</p>

<p style="text-align: center;"><a href="http://i.imgur.com/szQmgb5.png" target="_blank"><img alt="Traps for Friends - Floors" height="400" src="http://gamasutra.com/db_area/images/blog/236560/_floors_th.png" width="601" /></a></p>

<p style="color: rgb(170, 170, 170); font-style: italic; text-align: center;"><small>[Click for&nbsp;high resolution]</small></p>

<p><strong>What we think went wrong</strong></p>

<p>Because of the chosen style, animations were hand drawn frame-by-frame. That&rsquo;s fine for a small game, but not when you have 10 characters and 15 traps with different actions for each. Joint-based animations would have saved us a lot of time.</p>

<p>And maybe it&rsquo;s just me, but I underestimate the work required for UI, even with fully prototyped wireframes, every time. It was hard to build it correctly from the start; new elements and features just kept popping up, and the layout needed to be changed over and over, distracting the artists from their current tasks.</p>

<h1><strong>Game design</strong></h1>

<p><strong>What we think went right</strong></p>

<p>We didn&rsquo;t want any time locks or match limitation in any of our products. Pay-to-win, of course, was not an option either. That leaves fewer options for small multiplayer games.</p>

<p>Our monetization idea was based on a weekly top score and a &ldquo;visual ladder.&rdquo; Your activity in the game isn&rsquo;t just a row in the score table; you have a whole menu dedicated to it. Your castle stands in the neighborhood of your friend&rsquo;s castles. And if you get a huge score by paying or playing a lot, then everyone sees your awesome customized castle at the top of the world.</p>

<p>If you&rsquo;re not aiming for the world top, you still have a friend&rsquo;s top. All your opponents can see your castle, avatar, and score in the &ldquo;VS. Screen&rdquo; before each match. Your game performance gives you money to improve your castle and score to rise to the top, but neither the castle nor the score have any influence on your matches.</p>

<p>There is also a survival game mode where you&rsquo;re trying to pass as many floors as possible in an infinite castle. It&rsquo;s basically a single player infinite runner, and you can cheat in this mode by using revives. Survival mode gives you a higher score than PvP matches, and it doesn&rsquo;t affect other players.</p>

<p>This way, monetization aims for the players who want to gain visibility and status. And since the score is slowly degrading over time, you need to play or invest on a regular basis to maintain your positions.</p>

<p style="text-align: center;"><a href="http://i.imgur.com/5bTJ1Dp.png" target="_blank"><img alt="" height="400" src="http://gamasutra.com/db_area/images/blog/236560/_castles_th.png" width="543" /></a></p>

<p style="color: rgb(170, 170, 170); font-style: italic; text-align: center;"><small><span style="line-height: 20.7999992370605px; text-align: center;">[Click for high resolution]</span></small></p>

<p><strong>What we think went wrong</strong></p>

<p>Game content can&rsquo;t be extended much except for new castle and floor designs. Of course, we planned more complex games for our platform (like turn-based strategies), but investing that much time and having little space for updates isn&rsquo;t good.</p>

<h1><strong>Tech</strong></h1>

<p><strong>What we think went right</strong></p>

<p>If you&rsquo;re still not sure about using Unity for your next project, then just calculate the time required for your team to produce the functionality that is already available in many popular Asset Store and Prime31 plugins. Unity may not be the best engine by design, but it has an amazing community that has created incredible amounts of code and content that you can reuse in your games.</p>

<p>Unity has had its native 2d tools for over a year, but 2d Toolkit still rocks. It has a smart camera, great UI (we used it for very complex menus), tilemaps, and different kind of sprite tools, and it also supports atlases for different resolutions.</p>

<p style="text-align: center;"><a href="http://i.imgur.com/qtPv3cb.png" target="_blank"><img alt="Traps for Friends - UI" height="340" src="http://gamasutra.com/db_area/images/blog/236560/_ui_th.png" width="646" /></a></p>

<p style="text-align: center;"><span style="color: rgb(170, 170, 170); font-size: 10.8333330154419px; font-style: italic; line-height: 20.7999992370605px; text-align: center;">[Click for high resolution]</span></p>

<p><strong>What we think went wrong</strong></p>

<p>After reading how awesome Node.js is, we picked it for our servers. But it turned out that many Node.js packages are still unstable. For example, we lost up to a week due to Socket.IO bugs. Any other more mature solution could have saved us from these kinds of issues.</p>

<p>We hired an experienced backend programmer, but still a year-old JavaScript code base does not look good compared to other languages. It&rsquo;s hard to read through callbacks even with the use of promises. In the end, going after the hype was just not worth it.</p>

<p>The client code is good enough to extend and maintain but still too coupled for some tests. We used monkey testing, with a bot clicking and scrolling everything it finds (and it found a lot of bugs!). But next time I&rsquo;d like to try one of the MVVM frameworks for Unity.</p>

<h1><strong>But where&rsquo;s the game?</strong></h1>

<p>Unfortunately, it will probably never be released.</p>

<p>We were developing Traps for Friends in Kiev, Ukraine by a mixed team of Russians and Ukrainians during last year&rsquo;s upheaval. Then, the Russian government annexed Crimea, and the war started. This has led to colossal currency falls, so we lost our investors right before the soft launch and couldn&rsquo;t find any others. No one in Russia and Ukraine had money in the middle of the crisis, and American and European investors weren&rsquo;t too willing to fund a company from a region near an ongoing military conflict.</p>

<p>Well, we just found ourselves in the wrong place at the wrong time!</p>

<p><img alt="" height="1" src="http://i.imgur.com/HD7L6R0.png" width="1" /></p>
            </div>   
                                                <hr>
                    <div class="hide-phone">
                        <h3>Related Jobs</h3>
                                                   <div class="stories_item">
                                <div class="thumb"><a href="http://jobs.gamasutra.com/job/pm2-burbank-california-28794"><img src="http://d1506sp6x4e9z7.cloudfront.net/gamasutra/uploads/944769.jpg" alt="Performance Designed Products" width="120"></a></div>
                                <div class="title">
                                    <strong>
                                    Performance Designed Products &mdash; 
                                                                          BURBANK,
                                                                                                              California,
                                                                        United States
                                    <br />
                                    [06.10.15]
                                   </strong>
                                   <br />
                                   <a href="http://jobs.gamasutra.com/job/pm2-burbank-california-28794">PM2</a>
                                </div>
                           </div>
                                                   <div class="stories_item">
                                <div class="thumb"><a href="http://jobs.gamasutra.com/job/technical-producer-frisco-texas-28866"><img src="http://d1506sp6x4e9z7.cloudfront.net/gamasutra/uploads/784723.jpg" alt="Gearbox Software" width="120"></a></div>
                                <div class="title">
                                    <strong>
                                    Gearbox Software &mdash; 
                                                                          Frisco,
                                                                                                              Texas,
                                                                        United States
                                    <br />
                                    [06.10.15]
                                   </strong>
                                   <br />
                                   <a href="http://jobs.gamasutra.com/job/technical-producer-frisco-texas-28866">Technical Producer</a>
                                </div>
                           </div>
                                                   <div class="stories_item">
                                <div class="thumb"><a href="http://jobs.gamasutra.com/job/senior-platform-services-engineer-needham-massachusetts-28694"><img src="http://d1506sp6x4e9z7.cloudfront.net/gamasutra/uploads/scarme%40turbine.com.jpeg" alt="Turbine Inc." width="120"></a></div>
                                <div class="title">
                                    <strong>
                                    Turbine Inc. &mdash; 
                                                                          Needham,
                                                                                                              Massachusetts,
                                                                        United States
                                    <br />
                                    [06.10.15]
                                   </strong>
                                   <br />
                                   <a href="http://jobs.gamasutra.com/job/senior-platform-services-engineer-needham-massachusetts-28694">Senior Platform Services Engineer</a>
                                </div>
                           </div>
                                                   <div class="stories_item">
                                <div class="thumb"><a href="http://jobs.gamasutra.com/job/senior-brand-manager-newcastle-england-28758"><img src="http://d1506sp6x4e9z7.cloudfront.net/gamasutra/uploads/%26no_logo..jpg" alt="CCP " width="120"></a></div>
                                <div class="title">
                                    <strong>
                                    CCP  &mdash; 
                                                                          Newcastle,
                                                                                                              England,
                                                                        United Kingdom
                                    <br />
                                    [06.10.15]
                                   </strong>
                                   <br />
                                   <a href="http://jobs.gamasutra.com/job/senior-brand-manager-newcastle-england-28758">Senior Brand Manager </a>
                                </div>
                           </div>
                                            </div>
                    <br class="clear"/><br/>
                    <div class="right small">
                        <strong>[<a href="http://jobs.gamasutra.com/">View All Jobs</a>]</strong>
                    </div>
                    <br class="clear"/><br/>
                                        <hr>
                            <div id="dynamiccomments">
					<span id="cmtArticleId" style="display:none">236560</span>
					<span id="cmtStory_type" style="display:none">blog</span>
					<span id="cmtArticleUri" style="display:none">/blogs/IvanMir/20150217/236560/Postmortem_Traps_for_Friends__our_attempt_at_fair_IAP_multiplayer.php</span>
					<span id="author_id" style="display:none">951453</span>
					<span id="author_user_id" style="display:none">33873383</span>
                    <a style="font-weight: bold; font-size: 16px;" name="comments"> Loading Comments</a>
                    <br />
                    <hr noshade size="1" class="hr_comment">
                
                    <div align="center">
                         <img style="padding-top: 2px; padding-right: 5px; padding-bottom: 5px;" alt="loader image" src="/ajax-loader.gif"/>
                    </div>
       
                </div>
                    </div>  
        <!-- InstanceEndEditable -->
    </div><!--end contentbox-->
</div><!--end span-16-->

            </div>
            <br class="clear">
	</div><!--end span-21-->

        <!--begin right sidebar-->
     	<div class="hide-phone center">
               <div class="span-4 last">
                   <!--right hand ads start here-->

  
                            <!-- Beginning Sync AdSlot 7 for Ad unit Gamasutra//smartphonetablet ### size: [[160,600]]  -->
<div id='div-gpt-ad-sky1'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-sky1');
 </script>
</div>
<!-- End AdSlot 7 -->
        <!-- Beginning Sync AdSlot 8 for Ad unit Gamasutra//smartphonetablet ### size: [[160,160]]  -->
<div id='div-gpt-ad-Ltile1'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-Ltile1');
 </script>
</div>
<!-- End AdSlot 8 -->
                	<!-- Beginning Sync AdSlot 12 for Ad unit Gamasutra//smartphonetablet ### size: [[4,4]]  -->
<div id='div-gpt-ad-custom4'>
 <script type='text/javascript'>
  googletag.display('div-gpt-ad-custom4');
 </script>
</div>
<!-- End AdSlot 12 -->
              
		 
               	</div>
                 </div>
     <!--end right sidebar-->         
        </div>
     
     </div><!--end container-->
     
     <br class="clear">
<link rel="stylesheet" type="text/css" href="http://twimgs.com/informationweek/footernav/jan2015/css/superfooter_dark.css" />

<style>
div.superfooter#rightlinks ul li {
   display:list-item !important;
}
div.superfooter#rightlinks ul {
   border-bottom:0px !important;
   width:auto !important;
}
div.superfooter#footerblack {
   background-color:black !important;
}
div.superfooter#pagecenter {
   width: 998px;
   margin: 0 auto;
   position: relative;
}
</style>

<!--begin footer-->
<!-- BEGIN DARK FOOTER -->
<div align="center">
  <div class="superfooter" id="footerblack">
    <div class="superfooter" id ="pagecenter">
    <div id="top">
    <!--DARK FOOTER LEFT SIDE -->
    <div  id="left">
    <a href="http://www.ubmtechweb.com/" target="_blank"><img src="http://gamasutra.com/game_sites_superfooter_2012/images/logo_ubmtech_white_latest.png" width="88" height="111" border="0" alt="UBM Tech"></a>
    </div><!-- / DARK FOOTER LEFT SIDE -->
    <!-- DARK FOOTER rightlinks SIDE -->
    <div class="superfooter" id="rightlinks">
      <div class="list-div" id="tech-brands">
        <ul class="first-list">
          <li class="footer_title">UBM TECH BRANDS</li> 
          <li><a href="http://www.blackhat.com/us-14/" target="_blank">Black Hat</a></li>
          <li><a href="http://www.cloudconnectevent.com/" target="_blank">Cloud Connect</a></li>
          <li><a href="http://www.darkreading.com/" target="_blank">Dark Reading</a></li> 
          <li><a href="http://www.enterpriseconnect.com/" target="_blank">Enterprise Connect</a></li>
        </ul>
        <ul>
          
          <li><a href="http://www.servicemanagementfusion.com/" target="_blank">Fusion</a></li>
          <li><a href="http://www.gdconf.com/" target="_blank">GDC</a></li>
          <li><a href="http://www.gtec.ca/" target="_blank">GTEC</a></li>
          <li><a href="http://www.gamasutra.com/" target="_blank">Gamasutra</a></li>
        </ul>
        <ul>
          
          <li><a href="http://www.thinkhdi.com/" target="_blank">HDI</a></li>
          <li><a href="http://www.informationweek.com/" target="_blank">InformationWeek</a></li>
          <li><a href="http://www.interop.com" target="_blank">Interop</a></li>
        </ul>
        <ul class="last-list">
          
          <li><a href="http://www.networkcomputing.com/" target="_blank">Network Computing</a></li>
          <li><a href="http://www.nojitter.com/" target="_blank">No Jitter</a></li>
          <li><a href="http://www.towersummit.com" target="_blank">Tower & Small Cell Summit</a></li>
        </ul>
      </div>
      <div class="list-div" id="communities-served">
        <ul class="first-list">
          <li class="footer_title">COMMUNITIES SERVED</li>
          <li><a href="http://tech.ubm.com/community-brands/enterprise-it/" target="_blank">Enterprise IT</a></li>
          <li><a href="http://tech.ubm.com/community-brands/enterprise-communications/" target="_blank">Enterprise Communications</a></li>
          <li><a href="http://tech.ubm.com/community-brands/game-and-app-developers/" target="_blank">Game Development</a></li>
          <li><a href="http://tech.ubm.com/community-brands/information-security/" target="_blank">Information Security</a></li>
          <li><a href="http://tech.ubm.com/community-brands/technical-service-and-support/" target="_blank">IT Services & Support</a></li>
       </ul>
      </div>
      <div class="list-div" id="working-with-us">
        <ul class="first-list">
          <li class="footer_title">WORKING WITH US</li>
          <li><a href="http://createyournextcustomer.techweb.com/contact-us/" target="_blank">Advertising Contacts</a></li>
          <li><a href="http://events.ubm.com/?company=10" target="_blank">Event Calendar</a></li>
          <li><a href="http://createyournextcustomer.techweb.com/" target="_blank">Tech Marketing</a></li>
          <li><a href="http://createyournextcustomer.techweb.com/" target="_blank">Solutions</a></li>
          <li><a href="http://tech.ubm.com/contact-us/" target="_blank">Contact Us</a></li>
          <li><a href="http://wrightsmedia.com/sites/ubm/index.cfm" target="_blank">Licensing</a></li>
        </ul>
      </div>
    </div><!-- / DARK FOOTER rightlinks -->
  </div><!--end top-->
    <div style="clear:both;"></div><!-- // to clear the right and left evenly // -->
  <div  id="bottom">
    <ul class="blue">
      <li><a href="http://legal.us.ubm.com/terms-of-service/" target="_blank" class="blue">Terms of Service</a></li>
      <li><a href="http://legal.us.ubm.com/privacy-policy/" target="_blank" class="blue">Privacy Statement</a></li>
      <li>Copyright &#169; 2015 UBM Tech, All rights reserved</li>
    </ul>
  </div>
    </div>
  </div><!-- / END footergrey -->
</div><!-- / END align="center" -->
<!-- / END DARK FOOTER -->

<!-- Eloqua tracking code -->
<SCRIPT TYPE='text/javascript' LANGUAGE='JavaScript' SRC='//twimgs.com/gamasutra/js/elqtracking.js'></SCRIPT>
<!-- End Eloqua tracking code -->

<script type="text/javascript" src="https://ins.techweb.com/beacon/js/beacon-min.js"></script>
<script type="text/javascript">
var beacon = new UBM.Beacon({environment: 'p', apiKey: '31fa8154ead6bb6b2bcefa32b0b2bd86ef990485d4def29a6117223512da2973'});
beacon.pageview();
</script>

<script type="text/javascript" src="//twimgs.com/gamasutra/js/combined.js"></script>
<script type="text/javascript" src="//twimgs.com/gamasutra/js/nextgen.js?v1.3"></script>
<script type="text/javascript" src="//twimgs.com/gamasutra/js/checkauth.js?v1.12"></script>

<!-- SiteCatalyst code version: H.21.
Copyright 1996-2010 Adobe, Inc. All Rights Reserved
More info available at http://www.omniture.com -->
<script language="JavaScript" type="text/javascript" src="//twimgs.com/shared/omniture/h_s_code_remote.js"></script>
<script language="JavaScript" type="text/javascript"><!--
    /* You may give each page an identifying name, server, and channel on
    the next lines. */
	s.pageName="";
	s.server="";
	s.channel="";
	s.pageType="";
	s.prop1="";
	s.prop2="236560";
	s.prop3="Gamasustra | 236560 | Postmortem: Traps for Friends - our attempt at fair IAP multiplayer";
	s.prop4="Postmortem: Traps for Friends - our attempt at fair IAP multiplayer";
	s.prop5="GAMASUTRA BLOG";
	s.prop6="";
	s.prop7="Ivan Mir";
	s.prop8="userAgent";
	s.prop9="";
	s.prop10="";
	s.prop13="";
	/* Conversion Variables */
	s.campaign="";
	s.state="";
	s.zip="";
	s.events="event5";
	s.products="";
	s.purchaseID="";
	s.eVar1="";
	s.eVar2="";
	s.eVar3="";
	s.eVar4="";
	s.eVar5="";
	/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
    var s_code = s.t(); if (s_code) document.write(s_code)//--></script>
<script language="JavaScript" type="text/javascript"><!--
    if (navigator.appVersion.indexOf('MSIE') >= 0) document.write(unescape('%3C') + '\!-' + '-')
//--></script><noscript><a href="http://www.omniture.com" title="Web Analytics"><img
src="http://cmp.112.2o7.net/b/ss/cmpglobalvista/1/H.21--NS/0"
height="1" width="1" border="0" alt="" /></a></noscript><!--/DO NOT REMOVE/-->
<!-- End SiteCatalyst code version: H.21. -->          
  
<!-- Begin ADSNATIVE Code -->
<script type="text/javascript" src="http://static.adsnative.com/static/js/render.v1.js"></script>
<!-- End ADSNATIVE Code -->  
</body>
</html>                
                
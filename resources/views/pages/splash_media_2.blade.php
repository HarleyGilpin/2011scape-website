@extends('layouts.app')

@section('title', 'Splash Media 2 - 2011scape')
@section('crumb', 'Splash Media 2')

@section('content')
 
     <h1><img id="runescape" src="img/main/splash2010/runescape-worlds-most-popular-free-mmorpg.jpg" alt="RuneScape - The world's most popular free MMORPG" title=""></h1> 
     <h2> <a id="play" class="HoverImg" href="game-autocreate-true.html" onclick="try{pageTracker._trackPageview('/splash.ws/play_game/splash/play_now/')}catch(x){}; try{_pageTracker._trackPageview('/splash.ws/play_game/splash/play_now/')}catch(x){}"><img src="img/main/splash2010/play-now.jpg" alt="Play Now" title=""></a> <a id="download" class="HoverImg" href="game-autocreate-true.html" onclick="try{pageTracker._trackPageview('/splash.ws/download_game/splash/download_free/')}catch(x){}; try{_pageTracker._trackPageview('/splash.ws/download_game/splash/download_free/')}catch(x){}"><img src="img/main/splash2010/download.jpg" alt="Download Free" title=""></a> </h2> <a id="playExisting" href="game.html" onclick="try{pageTracker._trackPageview('/splash.ws/play_game/splash/existing/')}catch(x){}; try{_pageTracker._trackPageview('/splash.ws/play_game/splash/existing/')}catch(x){}">If you already have an account click here to play now.</a> 
     <div id="media"> 
      <div id="stickout"></div> 
      <div id="trailerMedia" class="mediaItem"> <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"> <param name="movie" value="img/main/splash2010/frame.swf.html"> <param name="FlashVars" value="trailerPath=img/main/splash2010/&amp;trailerType=runescape_.html"> <param name="wmode" value="opaque"> <!--[if !IE]>--> <object type="application/x-shockwave-flash" data="img/main/splash2010/frame.swf.html"> <param name="FlashVars" value="trailerPath=img/main/splash2010/&amp;trailerType=runescape_.html"> <param name="wmode" value="opaque"> <!--<![endif]--> <p>Sorry you need <a href="http://www.macromedia.com/go/getflashplayer" target="_blank">Flash Player</a> to view this trailer.</p> <!--[if !IE]>--> </object> <!--[if !IE]>--><!--<![endif]--> </object> 
      </div><!--.mediaItem[.mediaItemActive]--> 
      <div id="screenMedia" class="mediaItem mediaItemActive"> <a id="previous" class="screenControl" href="splash-media-2-amp;screen-8.html"><span>Previous screenshot...</span></a> <a id="next" class="screenControl" href="splash-media-2-amp;screen-1.html"><span>Next screenshot...</span></a> 
       <img id="screenImage" class="mediaHolder" src="img/main/splash2010/screen/1.jpg" alt=""> 
      </div> 
     </div> 
     <div id="buttons"> <a id="trailer" class="mediaButton mediaButtonLeft HoverImg" href="splash-media-1.html"><img src="img/main/splash2010/buttons.jpg" alt="Watch Trailer" title=""></a> <a id="screen" class="mediaButton mediaButtonRight HoverImg HoverImgActive" href="splash-media-2.html"><img src="img/main/splash2010/buttons.jpg" alt="View Screenshots" title=""></a> 
     </div> 
    
@endsection

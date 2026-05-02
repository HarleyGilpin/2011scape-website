@extends('layouts.app')

@section('title', 'Java Options - 2011scape')
@section('crumb', 'Java Options')

@section('content')
 
     <div id="options"> 
      <div class="sectionHeader"> 
       <div class="left"> 
        <div class="right"> 
         <h1 class="plaque"> Java Options </h1> 
        </div> 
       </div> 
      </div> 
      <div class="section"> 
       <div class="brown_background"> 
        <div class="inner_brown_background"> 
         <div id="selectForm" class="brown_box"> 
          <div class="subsectionHeader">
           Java Version
          </div> 
          <div class="inner_brown_box"> 
           <form method="get" action="submitoptions.ws">
             If you are having technical issues playing RuneScape, changing your version of Java may help. Please ensure you have read the advice in <a href="kbase/view-guid-The_game_won_t_load.html">this article</a> before changing this setting. 
            <br> 
            <br> 
            <div id="select"> <select name="plugin" id="plugin"> <option value="1">Default Java (recommended)</option> <option value="2">Force Sun Java (Internet Explorer only)</option> </select> 
            </div> 
            <input id="submit" class="submitButton" type="submit" value=""> 
            <input type="hidden" name="js" id="js" value="0"> 
            <script language="javascript"> document.getElementById("js").value="1"; </script> 
           </form> 
          </div> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <br class="clear"> 
    
@endsection

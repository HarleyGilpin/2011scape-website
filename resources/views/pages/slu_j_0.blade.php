@extends('layouts.app')

@section('title', 'Select a World - 2011scape')
@section('crumb', 'Select a World')

@section('content')
 
     <div id="worldselect"> 
      <div class="sectionHeader"> 
       <div class="left"> 
        <div class="right"> 
         <h1 class="plaque"> Select a World </h1> 
        </div> 
       </div> 
      </div> 
      <div class="section"> 
       <div class="brown_background">
        <div class="inner_brown_background"> 
         <div id="quickSelect" class="brown_box"> 
          <div class="subsectionHeader">
           Quick Select (Recommended)
          </div> 
          <div class="inner_brown_box"> 
           <div class="quickmembers" onmouseover="shim(1)" onmouseout="unshim(1)"> <a class="quickBig" href="game-m-1-amp;a-2.html" onclick="this.href+='&amp;j=1';"> <img src="img/main/serverlist/quickmembers-1.png" alt="Choose best members world for me"> <span id="shim1" class="shim">Play Now!</span> </a> 
           </div> 
           <div class="quickfree" onmouseover="shim(2)" onmouseout="unshim(2)"> <a class="quickBig" href="game-m-0-amp;a-2.html" onclick="this.href+='&amp;j=1';"> <img src="img/main/serverlist/quickfree-1.png" alt="Choose best free world for me"> <span id="shim2" class="shim">Play Now!</span> </a> 
           </div> 
           <h4>Please read the following text to understand why you are seeing this page</h4> 
           <p>You are seeing this page because we could not start RuneScape on your computer in 'signed' mode. This means that you did not (or were not able to) grant permission to RuneScape to run as it normally does. To avoid seeing this page again, please ensure that you accept the pop-up security warning that appears a few seconds after loading the game. If this pop-up does not appear, try rebooting your machine and make sure you click 'Yes' when asked if you want to trust the RuneScape applet.</p> 
           <p>Loading and running the game 'unsigned' like this takes much longer, as it must re-download all the content every time you play; you will also be unable to use RuneScape's high detail graphics mode or use the in-game world switcher without reloading the game.</p> 
           <p>To work around this, you may use this page to manually select a world and then load the game. Please be aware that loading the game from this page will <b>always</b> load the unsigned game, so you should only use this page if you really have no other option.</p> 
           <p>For further help, please read <a href="kbase/view-guid-The_game_won_t_load.html">this article</a>, which can be found in the <a href="kbase/view-guid-customer_support.html">Customer Support</a> section of our website.</p> 
           <br class="clear"> 
          </div> 
         </div> 
         <div class="brown_box"> 
          <div class="subsectionHeader">
           Advanced Select (For experienced players)
          </div> 
          <table class="slist"> 
           <tbody>
            <tr class="slistHeader"> 
             <td> <a href="?order=wMLPA"><img src="img/main/serverlist/arrow_up.png" alt="Sort ascending"></a> <a href="?order=WMLPA"><img src="img/main/serverlist/arrow_down.png" alt="Sort descending"></a> World </td> 
             <td> <a href="?order=pMLWA"><img src="img/main/serverlist/arrow_up.png" alt="Sort ascending"></a> <a href="?order=PMLWA"><img src="img/main/serverlist/arrow_down.png" alt="Sort descending"></a> Players </td> 
             <td> <a href="?order=aMLPW"><img src="img/main/serverlist/arrow_up.png" alt="Sort ascending"></a> <a href="?order=AMLPW"><img src="img/main/serverlist/arrow_down.png" alt="Sort descending"></a> Activity / Location<a href="kbase/view-guid-themed_worlds.html">?</a> </td> 
             <td> <img src="img/main/serverlist/looticon.gif" title="LootShare World" alt="LootShare World"> </td> 
             <td> <a href="?order=mLPWA"><img src="img/main/serverlist/arrow_up.png" alt="Sort ascending"></a> <a href="?order=MLPWA"><img src="img/main/serverlist/arrow_down_h.png" alt="Sort descending (selected)"></a> Type </td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world152/a2,j0,o0.html">World 152</a> </td> 
             <td>882</td> 
             <td class="a d">Falador Party Room</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world153/a2,j0,o0.html">World 153</a> </td> 
             <td>882</td> 
             <td class="a CA">Canada</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world154/a2,j0,o0.html">World 154</a> </td> 
             <td>884</td> 
             <td class="a CA">Canada</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world155/a2,j0,o0.html">World 155</a> </td> 
             <td>885</td> 
             <td class="a CA">Canada</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world108/a2,j0,o0.html">World 108</a> </td> 
             <td>681</td> 
             <td class="a AU">Australia</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world50/a2,j0,o0.html">World 50</a> </td> 
             <td>690</td> 
             <td class="a">Clan Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world118/a2,j0,o0.html">World 118</a> </td> 
             <td>677</td> 
             <td class="a SE">Sweden</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world123/a2,j0,o0.html">World 123</a> </td> 
             <td>680</td> 
             <td class="a SE">Sweden</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world113/a2,j0,o0.html">World 113</a> </td> 
             <td>522</td> 
             <td class="a d">Skill Total (1000)</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world57/a2,j0,o0.html">World 57</a> </td> 
             <td>588</td> 
             <td class="a d">Bounty World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world21/a2,j0,o0.html">World 21</a> </td> 
             <td>628</td> 
             <td class="a d">PvP World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world161/a2,j0,o0.html">World 161</a> </td> 
             <td>715</td> 
             <td class="a d">Quick Chat</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world96/a2,j0,o0.html">World 96</a> </td> 
             <td>717</td> 
             <td class="a d">Quick Chat</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world17/a2,j0,o0.html">World 17</a> </td> 
             <td>746</td> 
             <td class="a d">PvP World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world5/a2,j0,o0.html">World 5</a> </td> 
             <td>911</td> 
             <td class="a">Trade - F2P</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world29/a2,j0,o0.html">World 29</a> </td> 
             <td>911</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world73/a2,j0,o0.html">World 73</a> </td> 
             <td>913</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world13/a2,j0,o0.html">World 13</a> </td> 
             <td>916</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world4/a2,j0,o0.html">World 4</a> </td> 
             <td>917</td> 
             <td class="a">Trade - F2P</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world30/a2,j0,o0.html">World 30</a> </td> 
             <td>918</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world35/a2,j0,o0.html">World 35</a> </td> 
             <td>918</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world41/a2,j0,o0.html">World 41</a> </td> 
             <td>919</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world37/a2,j0,o0.html">World 37</a> </td> 
             <td>920</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world38/a2,j0,o0.html">World 38</a> </td> 
             <td>920</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world87/a2,j0,o0.html">World 87</a> </td> 
             <td>920</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world43/a2,j0,o0.html">World 43</a> </td> 
             <td>921</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world40/a2,j0,o0.html">World 40</a> </td> 
             <td>922</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world55/a2,j0,o0.html">World 55</a> </td> 
             <td>922</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world102/a2,j0,o0.html">World 102</a> </td> 
             <td>922</td> 
             <td class="a d">Falador Party Room</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world90/a2,j0,o0.html">World 90</a> </td> 
             <td>924</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world75/a2,j0,o0.html">World 75</a> </td> 
             <td>925</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world14/a2,j0,o0.html">World 14</a> </td> 
             <td>926</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world62/a2,j0,o0.html">World 62</a> </td> 
             <td>928</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world93/a2,j0,o0.html">World 93</a> </td> 
             <td>929</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world20/a2,j0,o0.html">World 20</a> </td> 
             <td>931</td> 
             <td class="a">Fist of Guthix</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world34/a2,j0,o0.html">World 34</a> </td> 
             <td>932</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world61/a2,j0,o0.html">World 61</a> </td> 
             <td>935</td> 
             <td class="a">Great Orb Project</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world85/a2,j0,o0.html">World 85</a> </td> 
             <td>941</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world47/a2,j0,o0.html">World 47</a> </td> 
             <td>949</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world33/a2,j0,o0.html">World 33</a> </td> 
             <td>950</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world74/a2,j0,o0.html">World 74</a> </td> 
             <td>952</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world8/a2,j0,o0.html">World 8</a> </td> 
             <td>960</td> 
             <td class="a US">United States</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world141/a2,j0,o0.html">World 141</a> </td> 
             <td>1043</td> 
             <td class="a">Clan Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world3/a2,j0,o0.html">World 3</a> </td> 
             <td>1137</td> 
             <td class="a">Trade - F2P</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world32/a2,j0,o0.html">World 32</a> </td> 
             <td>1354</td> 
             <td class="a d">Bounty World (+1 item)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world7/a2,j0,o0.html">World 7</a> </td> 
             <td>1977</td> 
             <td class="a">Dungeoneering</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> World 1 </td> 
             <td>FULL</td> 
             <td class="a">Trade - F2P</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world80/a2,j0,o0.html">World 80</a> </td> 
             <td>750</td> 
             <td class="a GB">UK</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world105/a2,j0,o0.html">World 105</a> </td> 
             <td>751</td> 
             <td class="a">Trade - F2P</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world81/a2,j0,o0.html">World 81</a> </td> 
             <td>754</td> 
             <td class="a GB">UK</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world106/a2,j0,o0.html">World 106</a> </td> 
             <td>755</td> 
             <td class="a GB">UK</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world16/a2,j0,o0.html">World 16</a> </td> 
             <td>756</td> 
             <td class="a">Running - Air Runes</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world25/a2,j0,o0.html">World 25</a> </td> 
             <td>762</td> 
             <td class="a">Fist of Guthix</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world11/a2,j0,o0.html">World 11</a> </td> 
             <td>802</td> 
             <td class="a GB">UK</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world49/a2,j0,o0.html">World 49</a> </td> 
             <td>672</td> 
             <td class="a NZ">New Zealand</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world136/a2,j0,o0.html">World 136</a> </td> 
             <td>346</td> 
             <td class="a d">Bounty World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world134/a2,j0,o0.html">World 134</a> </td> 
             <td>693</td> 
             <td class="a FI">Finland</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world135/a2,j0,o0.html">World 135</a> </td> 
             <td>681</td> 
             <td class="a BE">Belgium</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world169/a2,j0,o0.html">World 169</a> </td> 
             <td>741</td> 
             <td class="a NO">Norway</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world120/a2,j0,o0.html">World 120</a> </td> 
             <td>686</td> 
             <td class="a DK">Denmark</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world10/a2,j0,o0.html">World 10</a> </td> 
             <td>1315</td> 
             <td class="a NL">Netherlands</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world167/a2,j0,o0.html">World 167</a> </td> 
             <td>1380</td> 
             <td class="a NL">Netherlands</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world19/a2,j0,o0.html">World 19</a> </td> 
             <td>677</td> 
             <td class="a PL">Poland</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="f"> <a href="world165/a2,j0,o0.html">World 165</a> </td> 
             <td>742</td> 
             <td class="a ES">Spain</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr> 
             <td class="f"> <a href="world149/a2,j0,o0.html">World 149</a> </td> 
             <td>690</td> 
             <td class="a LT">Lithuania</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="f">Free</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world131/a2,j0,o0.html">World 131</a> </td> 
             <td>1478</td> 
             <td class="a d">Falador Party Room</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world132/a2,j0,o0.html">World 132</a> </td> 
             <td>1489</td> 
             <td class="a">Duel - Staked/Friendly</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world159/a2,j0,o0.html">World 159</a> </td> 
             <td>1492</td> 
             <td class="a d">Mobilising Armies (20)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world158/a2,j0,o0.html">World 158</a> </td> 
             <td>1496</td> 
             <td class="a">Stealing Creation</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world145/a2,j0,o0.html">World 145</a> </td> 
             <td>1500</td> 
             <td class="a">Soul Wars</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world157/a2,j0,o0.html">World 157</a> </td> 
             <td>1504</td> 
             <td class="a CA">Canada</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world112/a2,j0,o0.html">World 112</a> </td> 
             <td>1112</td> 
             <td class="a AU">Australia</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world15/a2,j0,o0.html">World 15</a> </td> 
             <td>1119</td> 
             <td class="a">Castle Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world124/a2,j0,o0.html">World 124</a> </td> 
             <td>318</td> 
             <td class="a d">Bounty World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world119/a2,j0,o0.html">World 119</a> </td> 
             <td>1120</td> 
             <td class="a SE">Sweden</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world121/a2,j0,o0.html">World 121</a> </td> 
             <td>1157</td> 
             <td class="a d">Mobilising Armies (20)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> World 117 </td> 
             <td>FULL</td> 
             <td class="a">Dungeoneering</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world86/a2,j0,o0.html">World 86</a> </td> 
             <td>475</td> 
             <td class="a d">PvP World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world72/a2,j0,o0.html">World 72</a> </td> 
             <td>650</td> 
             <td class="a d">PvP World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world26/a2,j0,o0.html">World 26</a> </td> 
             <td>675</td> 
             <td class="a d">PvP World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world65/a2,j0,o0.html">World 65</a> </td> 
             <td>1057</td> 
             <td class="a d">Bounty World (+1 item)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world114/a2,j0,o0.html">World 114</a> </td> 
             <td>1268</td> 
             <td class="a d">Skill Total (1500)</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world18/a2,j0,o0.html">World 18</a> </td> 
             <td>1372</td> 
             <td class="a d">Bounty World (+1 item)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world160/a2,j0,o0.html">World 160</a> </td> 
             <td>1474</td> 
             <td class="a d">Quick Chat</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world39/a2,j0,o0.html">World 39</a> </td> 
             <td>1525</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world129/a2,j0,o0.html">World 129</a> </td> 
             <td>1527</td> 
             <td class="a">Clan Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world48/a2,j0,o0.html">World 48</a> </td> 
             <td>1545</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world103/a2,j0,o0.html">World 103</a> </td> 
             <td>1550</td> 
             <td class="a d">Falador Party Room</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world104/a2,j0,o0.html">World 104</a> </td> 
             <td>1553</td> 
             <td class="a">Trouble Brewing</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world42/a2,j0,o0.html">World 42</a> </td> 
             <td>1565</td> 
             <td class="a">Role-Playing Server</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world66/a2,j0,o0.html">World 66</a> </td> 
             <td>1571</td> 
             <td class="a">Running - Law Runes</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world164/a2,j0,o0.html">World 164</a> </td> 
             <td>1571</td> 
             <td class="a">Stealing Creation</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world60/a2,j0,o0.html">World 60</a> </td> 
             <td>1572</td> 
             <td class="a">Great Orb Project</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world70/a2,j0,o0.html">World 70</a> </td> 
             <td>1572</td> 
             <td class="a">Runecrafting - ZMI Altar</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world100/a2,j0,o0.html">World 100</a> </td> 
             <td>1587</td> 
             <td class="a">Group Questing</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world27/a2,j0,o0.html">World 27</a> </td> 
             <td>1591</td> 
             <td class="a">Trade - Members</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world76/a2,j0,o0.html">World 76</a> </td> 
             <td>1592</td> 
             <td class="a d">Mobilising Armies (4)</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world99/a2,j0,o0.html">World 99</a> </td> 
             <td>1594</td> 
             <td class="a">Running - Law Runes</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world89/a2,j0,o0.html">World 89</a> </td> 
             <td>1605</td> 
             <td class="a d">Mobilising Armies (20)</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world130/a2,j0,o0.html">World 130</a> </td> 
             <td>1606</td> 
             <td class="a">Trade - Members</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world45/a2,j0,o0.html">World 45</a> </td> 
             <td>1620</td> 
             <td class="a">Burthorpe Games Room</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world46/a2,j0,o0.html">World 46</a> </td> 
             <td>1628</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world116/a2,j0,o0.html">World 116</a> </td> 
             <td>1633</td> 
             <td class="a">Fishing Trawler</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world78/a2,j0,o0.html">World 78</a> </td> 
             <td>1640</td> 
             <td class="a">Vinesweeper</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world98/a2,j0,o0.html">World 98</a> </td> 
             <td>1642</td> 
             <td class="a">Fist of Guthix</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world143/a2,j0,o0.html">World 143</a> </td> 
             <td>1643</td> 
             <td class="a">Soul Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world115/a2,j0,o0.html">World 115</a> </td> 
             <td>1644</td> 
             <td class="a">Pest Control</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world79/a2,j0,o0.html">World 79</a> </td> 
             <td>1645</td> 
             <td class="a">Tzhaar Fight Pits</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world97/a2,j0,o0.html">World 97</a> </td> 
             <td>1652</td> 
             <td class="a d">Mobilising Armies (20)</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world36/a2,j0,o0.html">World 36</a> </td> 
             <td>1659</td> 
             <td class="a">Running - Nature Runes</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world58/a2,j0,o0.html">World 58</a> </td> 
             <td>1663</td> 
             <td class="a">Blast Furnace</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world88/a2,j0,o0.html">World 88</a> </td> 
             <td>1677</td> 
             <td class="a">Shades of Mort'ton</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world44/a2,j0,o0.html">World 44</a> </td> 
             <td>1744</td> 
             <td class="a">Soul Wars</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world31/a2,j0,o0.html">World 31</a> </td> 
             <td>1881</td> 
             <td class="a">House Parties</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world22/a2,j0,o0.html">World 22</a> </td> 
             <td>1915</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world6/a2,j0,o0.html">World 6</a> </td> 
             <td>1979</td> 
             <td class="a">Barbarian Assault</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> World 9 </td> 
             <td>FULL</td> 
             <td class="a US">United States</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> World 77 </td> 
             <td>FULL</td> 
             <td class="a">Dungeoneering</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> World 2 </td> 
             <td>FULL</td> 
             <td class="a">Trade - Members</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world148/a2,j0,o0.html">World 148</a> </td> 
             <td>1564</td> 
             <td class="a">Tzhaar Fight Pits</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world71/a2,j0,o0.html">World 71</a> </td> 
             <td>1656</td> 
             <td class="a">Barbarian Assault</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world82/a2,j0,o0.html">World 82</a> </td> 
             <td>1753</td> 
             <td class="a">Castle Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world23/a2,j0,o0.html">World 23</a> </td> 
             <td>1763</td> 
             <td class="a GB">UK</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world83/a2,j0,o0.html">World 83</a> </td> 
             <td>1765</td> 
             <td class="a GB">UK</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world24/a2,j0,o0.html">World 24</a> </td> 
             <td>1772</td> 
             <td class="a">Castle Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world92/a2,j0,o0.html">World 92</a> </td> 
             <td>1773</td> 
             <td class="a">Fist of Guthix</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> World 84 </td> 
             <td>FULL</td> 
             <td class="a GB">UK</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world59/a2,j0,o0.html">World 59</a> </td> 
             <td>1293</td> 
             <td class="a">Castle Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world12/a2,j0,o0.html">World 12</a> </td> 
             <td>1132</td> 
             <td class="a NZ">New Zealand</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world137/a2,j0,o0.html">World 137</a> </td> 
             <td>360</td> 
             <td class="a d">Bounty World</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world151/a2,j0,o0.html">World 151</a> </td> 
             <td>1162</td> 
             <td class="a FI">Finland</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world138/a2,j0,o0.html">World 138</a> </td> 
             <td>1239</td> 
             <td class="a">Rat Pits</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world69/a2,j0,o0.html">World 69</a> </td> 
             <td>1135</td> 
             <td class="a">Pest Control</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world56/a2,j0,o0.html">World 56</a> </td> 
             <td>1174</td> 
             <td class="a BE">Belgium</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world166/a2,j0,o0.html">World 166</a> </td> 
             <td>1370</td> 
             <td class="a NO">Norway</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world68/a2,j0,o0.html">World 68</a> </td> 
             <td>1438</td> 
             <td class="a">Clan Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world67/a2,j0,o0.html">World 67</a> </td> 
             <td>1136</td> 
             <td class="a DK">Denmark</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world91/a2,j0,o0.html">World 91</a> </td> 
             <td>1247</td> 
             <td class="a">Barbarian Assault</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world52/a2,j0,o0.html">World 52</a> </td> 
             <td>1374</td> 
             <td class="a">Castle Wars</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world142/a2,j0,o0.html">World 142</a> </td> 
             <td>1375</td> 
             <td class="a NL">Netherlands</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world54/a2,j0,o0.html">World 54</a> </td> 
             <td>1378</td> 
             <td class="a d">Duel - Tournaments</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world51/a2,j0,o0.html">World 51</a> </td> 
             <td>1395</td> 
             <td class="a">Vinesweeper</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world53/a2,j0,o0.html">World 53</a> </td> 
             <td>1463</td> 
             <td class="a">Pest Control</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> World 144 </td> 
             <td>FULL</td> 
             <td class="a">Pest Control</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world156/a2,j0,o0.html">World 156</a> </td> 
             <td>1288</td> 
             <td class="a MX">Mexico</td> 
             <td><img src="img/main/serverlist/crossicon.gif" title="N" alt="N"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr class="x"> 
             <td class="m"> <a href="world28/a2,j0,o0.html">World 28</a> </td> 
             <td>1194</td> 
             <td class="a PL">Poland</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
            <tr> 
             <td class="m"> <a href="world64/a2,j0,o0.html">World 64</a> </td> 
             <td>1190</td> 
             <td class="a LT">Lithuania</td> 
             <td class="d"><img src="img/main/serverlist/tickicon.gif" title="Y" alt="Y"></td> 
             <td class="m">Members</td> 
            </tr> 
           </tbody>
          </table> 
         </div> 
        </div>
       </div> 
      </div> 
     </div> 
     <br class="clear"> 
    
@endsection

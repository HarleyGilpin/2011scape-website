<ul id="menus">
    <li class="top"><a href="/" id="home" class="tl"><span class="ts">Home</span></a></li>
    <li class="top"><a id="play" class="tl" href="/play"><span class="ts">Play Now</span></a>
        <ul>
            <li><a href="/play" id="menuPlay1" class="fly"><span>Download Launcher</span></a></li>
            <li><a href="/worldlist" class="fly"><span>Server List</span></a></li>
            <li><a href="/options" class="fly"><span>Java Options</span></a></li>
        </ul>
    </li>
    <li class="top"><a id="account" class="tl" href="/account-management"><span class="ts">Account</span></a>
        <ul>
            <li><a href="/members" class="fly"><span>Members Area</span></a></li>
            @guest<li><a href="/register" class="fly"><span>Create New Account</span></a></li>@endguest
            <li><a href="/account-management" class="fly"><span>Account Management</span></a></li>
            @auth<li><a href="/account/displayname" class="fly"><span>Change Display Name</span></a></li>@endauth
            @guest<li><a href="/recover" class="fly"><span>Recover Password</span></a></li>@endguest
        </ul>
    </li>
    <li class="top"><a id="guide" class="tl" href="/kb"><span class="ts">Game Guide</span></a>
        <ul>
            <li><a href="/kb" class="fly"><span>Knowledge Base</span></a></li>
            <li><a href="/items" class="fly"><span>Item Database</span></a></li>
            <li><a href="/rules" class="fly"><span>Rules</span></a></li>
            <li><a href="/splash" class="fly"><span>What is RuneScape?</span></a></li>
        </ul>
    </li>
    <li class="top"><a id="community" class="tl" href="/services/m=forum/"><span class="ts">Community</span></a>
        <ul>
            <li><a href="/services/m=forum/" class="fly"><span>Forums</span></a></li>
            <li><a href="/hiscores" class="fly"><span>Hiscores</span></a></li>
            <li><a href="/devblog" class="fly"><span>Dev Blog</span></a></li>
        </ul>
    </li>
    <li class="top"><a id="help" class="tl" href="/support"><span class="ts">Help</span></a>
        <ul>
            <li><a href="/support" class="fly"><span>Customer Support</span></a></li>
            <li><a href="/parents" class="fly"><span>Parents' Guide</span></a></li>
        </ul>
    </li>
    @auth
        <li class="top">
            <form method="post" action="/logout" style="display:inline;margin:0;padding:0">
                @csrf
                <button type="submit" id="login" class="tl" style="background:none;border:0;cursor:pointer;color:inherit;font:inherit"><span class="ts">Log Out</span></button>
            </form>
        </li>
    @else
        <li class="top"><a href="/login" id="login" class="tl"><span class="ts">Log In</span></a></li>
    @endauth
</ul>
<br class="clear">

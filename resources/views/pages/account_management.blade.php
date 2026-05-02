@extends('layouts.app')

@section('title', 'Account Management - 2011scape')
@section('crumb', 'Account Management')

@section('content')
 
     <div id="article"> 
      <div class="sectionHeader"> 
       <div class="left"> 
        <div class="right"> 
         <h1 class="plaque"> Account Management </h1> 
        </div> 
       </div> 
      </div> 
      <div class="section"> 
       <div class="brown_background"> 
        <div class="inner_brown_background"> 
         <div style="margin-bottom:5px" class="brown_box"> 
          <div class="subsectionHeader">
           Your Subscription
          </div> 
          <div class="inner_brown_box">
            If you haven't done so yet, why don't you subscribe to enjoy all the many benefits of a members account? You can subscribe for RuneScape alone or get a package subscription with FunOrb membership. If you already have a subscription, you can also extend or cancel it here. 
           <br>
           <br><i>To create an account, click the 'Play Now' followed by 'New User' link on the left side of the menu bar at the top of the page.</i> 
          </div> 
          <div class="listBoxSmall_left"> <a href="redirect-mod-billing_core-amp;dest-paymentoptions.html.html"> <img src="img/main/account_management/icon_startsubscription.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-billing_core-amp;dest-paymentoptions.html.html">Start/Extend Subscription</a>
           </div> 
           <div class="description">
            Create a new subscription or extend an existing one.
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-billing_core-amp;dest-paymentoptions.html.html">Subscribe</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_center"> <a href="redirect-mod-billing_core-amp;dest-userdetails.html.html"> <img src="img/main/account_management/icon_information.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-billing_core-amp;dest-userdetails.html.html">Account Information</a>
           </div> 
           <div class="description">
            View information on your current subscription.
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-billing_core-amp;dest-userdetails.html.html">View</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_right"> <a href="redirect-mod-billing_core-amp;dest-unsubscribe.html.html"> <img src="img/main/account_management/icon_cancelsubscription.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-billing_core-amp;dest-unsubscribe.html.html">Cancel Subscription</a>
           </div> 
           <div class="description">
            Cancel an existing subscription.
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-billing_core-amp;dest-unsubscribe.html.html">Cancel Subscription</a> 
           </div> 
          </div> 
          <br class="clear"> 
         </div> 
         <div style="margin-bottom:5px" class="brown_box"> 
          <div class="subsectionHeader">
           Account Settings
          </div> 
          <div class="inner_brown_box">
            We recommend that you change your password from time to time. If you have received a ban or caused an offence, you can appeal against it (see below). Also, by clicking 'Read Messages' below, you can read correspondence from Jagex. 
          </div> 
          <div class="listBox_left"> <a href="redirect-mod-password_history-amp;dest-password.html.html"> <img src="img/main/account_management/icon_changepassword.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-password_history-amp;dest-password.html.html">Change Password</a>
           </div> 
           <div class="description">
            Change your password every few months.
           </div> 
           <div class="listBoxButton_Big"> <a href="redirect-mod-password_history-amp;dest-password.html.html">Change Password</a> 
           </div> 
          </div> 
          <div class="listBox_right"> <a href="secure/m=displaynames/name.html"> <img src="img/main/account_management/icon_displayname.jpg" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="secure/m=displaynames/name.html">Change Character Name</a>
           </div> 
           <div class="description">
            Change your name shown in game.
           </div> 
           <div class="listBoxButton_Big"> <a href="secure/m=displaynames/name.html">Change Character Name</a> 
           </div> 
          </div> 
          <br class="clear"> 
          <div class="listBox_left"> <a href="redirect-mod-ticketing-amp;dest-inbox.html.html"> <img src="img/main/account_management/icon_readmessages.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-ticketing-amp;dest-inbox.html.html">Read Messages</a>
           </div> 
           <div class="description">
            Read messages sent to you by Jagex.
           </div> 
           <div class="listBoxButton_Big"> <a href="redirect-mod-ticketing-amp;dest-inbox.html.html">Read Messages</a> 
           </div> 
          </div> 
          <div class="listBox_right"> <a href="redirect-mod-offence-appeal-amp;dest-account_history.html.html"> <img src="img/main/account_management/icon_appealoffence.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-offence-appeal-amp;dest-account_history.html.html">Appeal Offence</a>
           </div> 
           <div class="description">
            Appeal an offence/ban made against you.
           </div> 
           <div class="listBoxButton_Big"> <a href="redirect-mod-offence-appeal-amp;dest-account_history.html.html">Appeal Offence</a> 
           </div> 
          </div> 
          <br class="clear"> 
         </div> 
         <div style="margin-bottom:5px" class="brown_box"> 
          <div class="subsectionHeader">
           Email Settings
          </div> 
          <div class="inner_brown_box">
            You are able to register an email address for your Jagex account, allowing you an extra way to prove ownership of your account and receive updates from us. Visit the below links to add an email address, verify your registration code and change your email preferences. 
          </div> 
          <div class="listBoxSmall_left"> <a href="redirect-mod-email-register-amp;dest-set_address.html.html"> <img src="img/main/account_management/icon_register.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-email-register-amp;dest-set_address.html.html">Email Registration</a>
           </div> 
           <div class="description">
            Add or change your account's email address. <a href="email_registration.html">Help</a>
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-email-register-amp;dest-set_address.html.html">Email Registration</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_center"> <a href="redirect-mod-email-register-amp;dest-change_settings.html.html"> <img src="img/main/account_management/icon_settings.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-email-register-amp;dest-change_settings.html.html">Email Preferences</a>
           </div> 
           <div class="description">
            View or change your email preferences. <a href="email_registration.html">Help</a>
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-email-register-amp;dest-change_settings.html.html">Email Preferences</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_right"> <a href="redirect-mod-email-register-amp;dest-enter_code.html.html"> <img src="img/main/account_management/icon_confirmation.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-email-register-amp;dest-enter_code.html.html">Enter Code</a>
           </div> 
           <div class="description">
            Submit a confirmation code. <a href="email_registration.html">Help</a>
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-email-register-amp;dest-enter_code.html.html">Enter Code</a> 
           </div> 
          </div> 
          <br class="clear"> 
         </div> 
         <div style="margin-bottom:5px" class="brown_box"> 
          <div class="subsectionHeader">
           Account Security
          </div> 
          <div class="inner_brown_box">
            We strongly recommend that you set your recovery questions as soon as possible. These can be used to recover your account if you forget the password, or if it is hijacked. If you suspect someone has got hold of your password and has changed your recovery questions, you can cancel the pending recovery questions within 14 days (and then change your password). 
          </div> 
          <div class="listBox_left"> <a href="redirect-mod-recovery_questions-amp;dest-add_recoveries.html.html"> <img src="img/main/account_management/icon_setrecovery.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-recovery_questions-amp;dest-add_recoveries.html.html">Set Recovery Questions</a>
           </div> 
           <div class="description">
            Set recovery questions that can be used to recover a lost password or stolen account.
           </div> 
           <div class="listBoxButton_Big"> <a href="redirect-mod-recovery_questions-amp;dest-add_recoveries.html.html">Set Questions</a> 
           </div> 
          </div> 
          <div class="listBox_right"> <a href="redirect-mod-recovery_questions-amp;dest-cancel_recoveries.html.html"> <img src="img/main/account_management/icon_cancelrecovery.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-recovery_questions-amp;dest-cancel_recoveries.html.html">Cancel Recovery Questions</a>
           </div> 
           <div class="description">
            Cancel pending recovery questions.
           </div> 
           <div class="listBoxButton_Big"> <a href="redirect-mod-recovery_questions-amp;dest-cancel_recoveries.html.html">Cancel Questions</a> 
           </div> 
          </div> 
          <br class="clear"> 
         </div> 
         <div class="brown_box"> 
          <div class="subsectionHeader">
           Account Recovery
          </div> 
          <div class="inner_brown_box">
            If you have forgotten your password or someone else has stolen your account, you can use the 'Recover Password' option below to recover your password. If we suspect that your account has been stolen, we may have locked it. Use the second option to recover a locked account. If you have already performed an account recovery request you can use the 'Track Recovery' option below to track its progress. 
          </div> 
          <div class="listBoxSmall_left"> <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-passwordchoice.html.html"> <img src="img/main/account_management/icon_recoverpassword.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-passwordchoice.html.html">Recover Password</a>
           </div> 
           <div class="description">
            Recover a forgotten or stolen password here.
           </div> 
           <div class="listBoxButton"> <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-passwordchoice.html.html">Recover Now</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_center"> <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-lockchoice.html.html"> <img src="img/main/account_management/icon_recoveraccount.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-lockchoice.html.html">Recover Account</a>
           </div> 
           <div class="description">
            Recover a locked account.
           </div> 
           <div class="listBoxButton"> <a href="redirect.html%3Fmod=www&amp;dest=loginapplet/loginapplet-mod-accountappeal-amp;dest-lockchoice.html.html">Recover Now</a> 
           </div> 
          </div> 
          <div class="listBoxSmall_right"> <a href="redirect-mod-accountappeal-amp;dest-trackinginput.html.html"> <img src="img/main/account_management/icon_trackrecovery.gif" alt="" class="listBoxIcon"> </a> 
           <div class="listBoxTitle">
            <a href="redirect-mod-accountappeal-amp;dest-trackinginput.html.html">Track Recovery</a>
           </div> 
           <div class="description">
            Track an account recovery.
           </div> 
           <div class="listBoxButton"> <a href="redirect-mod-accountappeal-amp;dest-trackinginput.html.html">Track Now</a> 
           </div> 
          </div> 
          <br class="clear"> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <br class="clear"> 
    
@endsection

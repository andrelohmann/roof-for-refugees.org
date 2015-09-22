<!DOCTYPE html>
<html>
    <head>
        <% base_tag %>
        <title>$Title</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        $MetaTags(false)
        
    </head>
    <body id="page-top">
        <% include CookiesWarningOverlay %>
        <nav id="top-nav" class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container-fluid"><!-- This container will center the Navbar Contents to the fluid width, by uncommenting it, the whole width will be used -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home/index">roof-for-refugees.org</a>
                </div>

                <div class="collapse navbar-collapse" id="top-navigation">
                    <% if $CurrentMember %>
                    <ul class="nav navbar-nav">
                        <li class="<% if $URLTopic == profile %>active<% end_if %>"><a href="profile/index"><%t TopMenu.PROFILE "TopMenu.PROFILE" %> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                        <li class="<% if $URLTopic == find %>active<% end_if %>"><a href="find/index"><%t TopMenu.FIND "TopMenu.FIND" %> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></a></li>
                        <li class="<% if $URLTopic == messaging %>active<% end_if %>"><a href="messaging/index"><%t TopMenu.MESSAGING "TopMenu.MESSAGING" %> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<% if $URLSegment == passwordadmin %>active<% end_if %>"><a href="passwordadmin/index"><%t PasswordMenu.CHANGEPASSWORD "PasswordMenu.CHANGEPASSWORD" %></a></li>
                    </ul>
                    <% end_if %>
                    $BootstrapNavbarModalLoginForm
                </div>
            </div>
        </nav>
        <% if not $CurrentMember %>$BootstrapNavbarModalLoginForm.Modal<% end_if %>

        $Layout
        
        <%--
            // If you like to use shariff, place the following code somewhere on your Page
            // configure following this guide: https://github.com/heiseonline/shariff#options-data-attributes
            <div class="container-fluid">
                <div class="shariff" data-backend-url="shariffbackend" data-lang="$CurrentLang" data-url="$AbsoluteURLPath" data-orientation="horizontal"></div>
            </div>
        --%>

        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">&copy; 2015</div>
                </div>
                
                <div class="collapse navbar-collapse" id="bottom-navigation">
                    <ul class="nav navbar-nav">
                        <li class="<% if $URLPath == home/terms %>active<% end_if %>"><a href="home/terms"><%t BottomMenu.TERMS "BottomMenu.TERMS" %></a></li>
                        <li class="<% if $URLPath == home/privacy %>active<% end_if %>"><a href="home/privacy"><%t BottomMenu.PRIVACY "BottomMenu.PRIVACY" %></a></li>
                        <li class="<% if $URLPath == home/contact %>active<% end_if %>"><a href="home/contact"><%t BottomMenu.CONTACT "BottomMenu.CONTACT" %></a></li>
                        <li class="<% if $URLPath == home/imprint %>active<% end_if %>"><a href="home/imprint"><%t BottomMenu.IMPRINT "BottomMenu.IMPRINT" %></a></li>
                    </ul>
                    $BootstrapNavbarLanguageForm
                </div>
            </div>
        </nav>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <% base_tag %>
        <title>roof-for-refugees.org</title>
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
                    <a class="navbar-brand" href="home/index">RfR</a>
                </div>

                <div class="collapse navbar-collapse" id="top-navigation">
                    <% if $CurrentMember %>
                    <ul class="nav navbar-nav">
                        <li class="<% if $URLTopic == profile %>active<% end_if %>"><a href="profile/index"><%t TopMenu.PROFILE "TopMenu.PROFILE" %> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                        <li class="<% if $URLTopic == find %>active<% end_if %>"><a href="find/index"><%t TopMenu.FIND "TopMenu.FIND" %> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></a></li>
                        <li class="<% if $URLTopic == contacts %>active<% end_if %>"><a href="contacts/index"><%t TopMenu.CONTACTS "TopMenu.CONTACTS" %> <span class="fa fa-users" aria-hidden="true"></span>$CurrentMember.OpenConfirmationsBadge</a></li>
                        <li class="<% if $URLTopic == messaging %>active<% end_if %>"><a href="message/index"><%t TopMenu.MESSAGING "TopMenu.MESSAGING" %> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>$CurrentMember.NewMessagesBadge</a></li>
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

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="<% if $URLPath == home/terms %>active<% end_if %>"><a href="home/terms"><%t BottomMenu.TERMS "BottomMenu.TERMS" %></a></li>
                            <li class="<% if $URLPath == home/privacy %>active<% end_if %>"><a href="home/privacy"><%t BottomMenu.PRIVACY "BottomMenu.PRIVACY" %></a></li>
                            <li class="<% if $URLPath == home/imprint %>active<% end_if %>"><a href="home/imprint"><%t BottomMenu.IMPRINT "BottomMenu.IMPRINT" %></a></li>
                        </ul>
                    </div>

                    <div class="col-sm-4">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="<% if $URLPath == home/contact %>active<% end_if %>"><a href="home/contact"><%t BottomMenu.CONTACT "BottomMenu.CONTACT" %></a></li>
                            <li class="<% if $URLPath == home/help %>active<% end_if %>"><a href="home/help"><%t BottomMenu.HELP "BottomMenu.HELP" %></a></li>
                            <li class="<% if $URLPath == home/sponsors %>active<% end_if %>"><a href="home/sponsors"><%t BottomMenu.SPONSORS "BottomMenu.SPONSORS" %></a></li>
                        </ul>
                    </div>

                    <div class="col-sm-4">
                        $BootstrapNavbarLanguageForm
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="text-center">&copy; 2015</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
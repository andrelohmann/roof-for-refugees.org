<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>$Title</h1>
            <% if $CurrentMember.SignupComplete %>
                $CurrentMember.Avatar.SetWidth(200)<br />
                $CurrentMember.Nickname<br />
                $CurrentMember.About<br />
                $CurrentMember.LocationAddress<br />
                $CurrentMember.Location.Nice(200)<br />
                <%t HostelProfile.ADULTS "HostelProfile.ADULTS" %>: $CurrentMember.AdultsSum<br />
                <%t HostelProfile.CHILDREN "HostelProfile.CHILDREN" %>: $CurrentMember.ChildrenSum<br />
                <% if $CurrentMember.Baby %><%t HostelProfile.BABY "HostelProfile.BABY" %><br /><% end_if %>
                <% if $CurrentMember.Active %><%t HostelProfile.ACTIVE "HostelProfile.ACTIVE" %><br /><% end_if %>
                <%t HostelProfile.OCCUPIEDSTATUS "HostelProfile.OCCUPIEDSTATUS" %>: <% if $CurrentMember.Occupied %><%t HostelProfile.OCCUPIED "HostelProfile.OCCUPIED" %> <a class="btn btn-success btn-sm" href="profile/occupiedtoggle"><%t HostelProfile.FREE "HostelProfile.FREE" %></a><% else %><%t HostelProfile.FREE "HostelProfile.FREE" %> <a class="btn btn-danger btn-sm" href="profile/occupiedtoggle"><%t HostelProfile.OCCUPIED "HostelProfile.OCCUPIED" %></a><% end_if %><br />
                <button class="btn btn-primary" type="button"  data-toggle="collapse" data-target="#collapseEditForm" aria-expanded="<% if $Form.hasErrors %>true<% else %>false<% end_if %>" aria-controls="collapseEditForm">
                    <%t HostelProfile.EDITRPROFILEBUTTON "HostelProfile.EDITRPROFILEBUTTON" %>
                </button>
                <div class="collapse<% if $Form.hasErrors %> in<% end_if %>" id="collapseEditForm">
                    <br />
                    <div class="well">
                        $Form
                    </div>
                </div>
            <% else %>
                <%t HostelProfile.FILLYOURPROFILE "HostelProfile.FILLYOURPROFILE" %>
                $Form
            <% end_if %>
        </div>
    </div>            
</div>

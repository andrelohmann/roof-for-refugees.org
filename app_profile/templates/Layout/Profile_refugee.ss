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
                <%t RefugeeProfile.ADULTS "RefugeeProfile.ADULTS" %>: $CurrentMember.AdultsSum<br />
                <%t RefugeeProfile.CHILDREN "RefugeeProfile.CHILDREN" %>: $CurrentMember.ChildrenSum<br />
                <% if $CurrentMember.Baby %><%t RefugeeProfile.BABY "RefugeeProfile.BABY" %><br /><% end_if %>
                <% if $CurrentMember.Active %><%t RefugeeProfile.ACTIVE "RefugeeProfile.ACTIVE" %><br /><% end_if %>
                <button class="btn btn-primary" type="button"  data-toggle="collapse" data-target="#collapseEditForm" aria-expanded="<% if $Form.hasErrors %>true<% else %>false<% end_if %>" aria-controls="collapseEditForm">
                    <%t RefugeeProfile.EDITRPROFILEBUTTON "RefugeeProfile.EDITRPROFILEBUTTON" %>
                </button>
                <div class="collapse<% if $Form.hasErrors %> in<% end_if %>" id="collapseEditForm">
                    <br />
                    <div class="well">
                        $Form
                    </div>
                </div>
            <% else %>
                <%t RefugeeProfile.FILLYOURPROFILE "RefugeeProfile.FILLYOURPROFILE" %>
                $Form
            <% end_if %>
        </div>
    </div>            
</div>

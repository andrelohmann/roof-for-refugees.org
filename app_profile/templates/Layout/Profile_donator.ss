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
                <button class="btn btn-primary" type="button"  data-toggle="collapse" data-target="#collapseEditForm" aria-expanded="<% if $Form.hasErrors %>true<% else %>false<% end_if %>" aria-controls="collapseEditForm">
                    <%t DonatorProfile.EDITRPROFILEBUTTON "DonatorProfile.EDITRPROFILEBUTTON" %>
                </button>
                <div class="collapse<% if $Form.hasErrors %> in<% end_if %>" id="collapseEditForm">
                    <br />
                    <div class="well">
                        $Form
                    </div>
                </div>
            <% else %>
                <%t DonatorProfile.FILLYOURPROFILE "DonatorProfile.FILLYOURPROFILE" %>
                $Form
            <% end_if %>
        </div>
    </div>            
</div>

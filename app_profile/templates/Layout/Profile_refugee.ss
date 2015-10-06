<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <% if $CurrentMember.SignupComplete %>
                <div class="row">
                    <div class="col-sm-3">
                        <% if $CurrentMember.Avatar %>
                            <p>$CurrentMember.Avatar.SetWidth(200).TagWithClass(img-responsive)<br />$CurrentMember.ID</p>
                        <% end_if %>
                        <p>$CurrentMember.Nickname</p>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="2"><%t RefugeeProfile.TYPE "RefugeeProfile.TYPE" %> <span class="glyphicon glyphicon-road" aria-hidden="true"></span></th>
                                </tr>
                                <tr>
                                    <th><%t RefugeeProfile.LOCATED "RefugeeProfile.LOCATED" %></th>
                                    <td>$CurrentMember.LocationAddress <a href="#" data-toggle="tooltip" title="" data-original-title="<%t Member.ONLYDISTANCEVISIBLE "Member.ONLYDISTANCEVISIBLE" %>"><i class="glyphicon glyphicon-question-sign"></i></a></td>
                                </tr>
                                <tr>
                                    <th><%t RefugeeProfile.ADULTS "RefugeeProfile.ADULTS" %></th>
                                    <td>$CurrentMember.AdultsSum</td>
                                </tr>
                                <tr>
                                    <th><%t RefugeeProfile.CHILDREN "RefugeeProfile.CHILDREN" %></th>
                                    <td>$CurrentMember.ChildrenSum</td>
                                </tr>
                                <tr>
                                    <th><%t RefugeeProfile.BABY "RefugeeProfile.BABY" %></th>
                                    <td><% if $CurrentMember.Baby %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                </tr>
                                <tr>
                                    <th><%t Member.ACTIVE "Member.ACTIVE" %></th>
                                    <td><% if $CurrentMember.Active %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                </tr>
                                <tr>
                                    <th colspan="2"><%t RefugeeProfile.ABOUT "RefugeeProfile.ABOUT" %>
                                </tr>
                                <tr>
                                    <td colspan="2">$CurrentMember.About</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-3">
                        <% if $CurrentMember.PaginatedMessageQueue %>
                        <% loop $CurrentMember.PaginatedMessageQueue %>
                            <% include QueueMessage ID=$ID, Type=$Type, Sender=$Sender %>
                        <% end_loop %>
                        <% if $CurrentMember.PaginatedMessageQueue.MoreThanOnePage %>
                            <br />
                            <ul class="pagination">
                                <% if $CurrentMember.PaginatedMessageQueue.NotFirstPage %>
                                <li><a class="prev" href="$CurrentMember.PaginatedMessageQueue.PrevLink">&lt;</a></li>
                                <% end_if %>
                                <% if $CurrentMember.PaginatedMessageQueue.NotLastPage %>
                                <li><a class="next" href="$CurrentMember.PaginatedMessageQueue.NextLink">&gt;</a></li>
                                <% end_if %>
                            </ul>
                        <% end_if %>
                        <% end_if %>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p><button class="btn btn-primary" type="button"  data-toggle="collapse" data-target="#collapseEditForm" aria-expanded="<% if $Form.hasErrors %>true<% else %>false<% end_if %>" aria-controls="collapseEditForm">
                            <%t Member.EDITRPROFILEBUTTON "Member.EDITRPROFILEBUTTON" %>
                        </button></p>
                        <div class="collapse<% if $Form.hasErrors %> in<% end_if %>" id="collapseEditForm">
                            <br />
                            <div class="well">
                                $Form
                            </div>
                        </div>
                    </div>
                </div>
            <% else %>
                <div class="row">
                    <div class="col-xs-12">
                        <%t Member.FILLYOURPROFILE "Member.FILLYOURPROFILE" %>
                        <br />
                        <div class="well">
                            $Form
                        </div>
                    </div>
                </div>
            <% end_if %>
        </div>
    </div>            
</div>

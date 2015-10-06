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
                                    <th colspan="2"><%t HostelProfile.TYPE "HostelProfile.TYPE" %> <span class="glyphicon glyphicon-home" aria-hidden="true"></span></th>
                                </tr>
                                <tr>
                                    <th><%t HostelProfile.LOCATED "HostelProfile.LOCATED" %></th>
                                    <td>$CurrentMember.LocationAddress <a href="#" data-toggle="tooltip" title="" data-original-title="<%t Member.ONLYDISTANCEVISIBLE "Member.ONLYDISTANCEVISIBLE" %>"><i class="glyphicon glyphicon-question-sign"></i></a></td>
                                </tr>
                                <tr>
                                    <th><%t HostelProfile.ADULTS "HostelProfile.ADULTS" %></th>
                                    <td>$CurrentMember.AdultsSum</td>
                                </tr>
                                <tr>
                                    <th><%t HostelProfile.CHILDREN "HostelProfile.CHILDREN" %></th>
                                    <td>$CurrentMember.ChildrenSum</td>
                                </tr>
                                <tr>
                                    <th><%t HostelProfile.BABY "HostelProfile.BABY" %></th>
                                    <td><% if $CurrentMember.Baby %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                </tr>
                                <tr>
                                    <th><%t HostelProfile.OCCUPIEDSTATUS "HostelProfile.OCCUPIEDSTATUS" %></th>
                                    <td><% if $CurrentMember.Occupied %><%t HostelProfile.OCCUPIED "HostelProfile.OCCUPIED" %> <a class="btn btn-success btn-sm" href="profile/occupiedtoggle"><%t HostelProfile.FREE "HostelProfile.FREE" %></a><% else %><%t HostelProfile.FREE "HostelProfile.FREE" %> <a class="btn btn-danger btn-sm" href="profile/occupiedtoggle"><%t HostelProfile.OCCUPIED "HostelProfile.OCCUPIED" %></a><% end_if %></td>
                                </tr>
                                <tr>
                                    <th><%t Member.ACTIVE "Member.ACTIVE" %></th>
                                    <td><% if $CurrentMember.Active %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                </tr>
                                <tr>
                                    <th colspan="2"><%t HostelProfile.ABOUT "HostelProfile.ABOUT" %>
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

<% if $Type == 'refugee' %>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th><%t Member.NICKNAME "Member.NICKNAME" %>:</th>
                                                <td>$Nickname <span class="$TypeIcon" aria-hidden="true"></span></td>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><%t Refugee.GROUPMEMBERS "Refugee.GROUPMEMBERS" %>:</th>
                                            </tr>
                                            <tr>
                                                <th><%t Refugee.ADULTS "Refugee.ADULTS" %>:</th>
                                                <td>$Adults</td>
                                            </tr>
                                            <tr>
                                                <th><%t Refugee.CHILDREN "Refugee.CHILDREN" %>:</th>
                                                <td>$Adults</td>
                                            </tr>
                                            <tr>
                                                <th><%t Refugee.BABY "Refugee.BABY" %>:</th>
                                                <td><% if $Baby %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#About-$ID"><%t RefugeeList.ABOUTBUTTON "RefugeeList.ABOUTBUTTON" %></button></p>
                                    <!-- Modal -->
                                    <div class="modal fade" id="About-$ID" tabindex="-1" role="dialog" aria-labelledby="About-{$ID}-Label">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    $About
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<% else_if $Type == 'hostel' %>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th><%t Member.NICKNAME "Member.NICKNAME" %>:</th>
                                                <td>$Nickname <span class="$TypeIcon" aria-hidden="true"></span></td>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><%t Hostel.ROOMFOR "Hostel.ROOMFOR" %>:</th>
                                            </tr>
                                            <tr>
                                                <th><%t Hostel.ADULTS "Hostel.ADULTS" %>:</th>
                                                <td>$Adults</td>
                                            </tr>
                                            <tr>
                                                <th><%t Hostel.CHILDREN "Hostel.CHILDREN" %>:</th>
                                                <td>$Adults</td>
                                            </tr>
                                            <tr>
                                                <th><%t Hostel.BABY "Hostel.BABY" %>:</th>
                                                <td><% if $Baby %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% else %><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><% end_if %></td>
                                            </tr>
                                            <tr>
                                                <th><%t Hostel.AVAILABILITY "Hostel.AVAILABILITY" %>:</th>
                                                <td><% if $Occupied %><span class="label label-danger"><span class="glyphicon glyphicon-ban-circle"></span><%t Hostel.OCCUPIED "Hostel.OCCUPIED" %></span><% else %><span class="label label-success"><span class="glyphicon glyphicon-ok-circle"></span><%t Hostel.FREE "Hostel.FREE" %></span><% end_if %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#About-$ID"><%t HostelList.ABOUTBUTTON "HostelList.ABOUTBUTTON" %></button></p>
                                    <!-- Modal -->
                                    <div class="modal fade" id="About-$ID" tabindex="-1" role="dialog" aria-labelledby="About-{$ID}-Label">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    $About
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<% else_if $Type == 'donator' %>
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th><%t Member.NICKNAME "Member.NICKNAME" %>:</th>
                                                <td>$Nickname <span class="$TypeIcon" aria-hidden="true"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#About-$ID"><%t DonatorList.ABOUTBUTTON "DonatorList.ABOUTBUTTON" %></button></p>
                                    <!-- Modal -->
                                    <div class="modal fade" id="About-$ID" tabindex="-1" role="dialog" aria-labelledby="About-{$ID}-Label">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    $About
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<% end_if %>
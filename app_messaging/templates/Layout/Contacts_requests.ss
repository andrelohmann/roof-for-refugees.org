<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <% if $Contacts %>
            <table class="table table-striped">
                <tbody>
                    <% loop $Contacts %>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-3">
                                    <% include ListMemberImage %>
                                </div>
                                <div class="col-sm-6">
                                    <% include ListMember %>
                                </div>
                                <div class="col-sm-3">
                                    <p>
                                        <a href="contacts/confirm/$ID" class="btn btn-default btn-success btn-block"><%t Contacts.CONFIRMCONTACT "Contacts.CONFIRMCONTACT" %></a>
                                        <a href="contacts/decline/$ID" class="btn btn-default btn-danger btn-block" onclick="javascript:return confirm('<%t Contacts.DECLINECONTACTCONFIRM "Contacts.DECLINECONTACTCONFIRM" %>');"><%t Contacts.DECLINECONTACT "Contacts.DECLINECONTACT" %></a>
                                    </p>    
                                </div>
                            </div>
                        </td>
                    </tr>
                    <% end_loop %>
                </tbody>
            </table>
            <% if $Contacts.MoreThanOnePage %>
            <br />
            <ul class="pagination">
                <% if $Contacts.NotFirstPage %>
                <li><a class="prev" href="$Contacts.PrevLink">&lt;</a></li>
                <% end_if %>
                <% loop $Contacts.PaginationSummary %>
                    <% if $CurrentBool %>
                    <li class="active"><a href="#">$PageNum</a></li>
                    <% else %>
                    <% if $Link %>
                    <li><a href="$Link">$PageNum</a></li>
                    <% else %>
                    <li><a href="#">...</a></li>
                    <% end_if %>
                    <% end_if %>
                <% end_loop %>
                <% if $Contacts.NotLastPage %>
                <li><a class="next" href="$Contacts.NextLink">&gt;</a></li>
                <% end_if %>
            </ul>
            <% end_if %>
            <% end_if %>
        </div>
    </div>
</div>

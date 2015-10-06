<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                $SearchForm
            </div>

            <% if $Members %>
            <table class="table table-striped">
                <tbody>
                    <% loop $Members %>
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
                                        <% if $Friend %>
                                        <a href="message/chat/$ID" class="btn btn-default btn-primary btn-block"><%t Message.CHAT "Message.CHAT" %></a>
                                        <% else %>
                                        <a href="contacts/request/$ID" class="btn btn-default btn-success btn-block"><%t Contacts.REQUESTCONTACT "Contacts.REQUESTCONTACT" %></a>
                                        <% end_if %>
                                    </p>    
                                </div>
                            </div>
                        </td>
                    </tr>
                    <% end_loop %>
                </tbody>
            </table>
            <% if $Members.MoreThanOnePage %>
            <br />
            <ul class="pagination">
                <% if $Members.NotFirstPage %>
                <li><a class="prev" href="$Members.PrevLink">&lt;</a></li>
                <% end_if %>
                <% loop $Members.PaginationSummary %>
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
                <% if $Members.NotLastPage %>
                <li><a class="next" href="$Members.NextLink">&gt;</a></li>
                <% end_if %>
            </ul>
            <% end_if %>
            <% end_if %>
        </div>
    </div>
</div>

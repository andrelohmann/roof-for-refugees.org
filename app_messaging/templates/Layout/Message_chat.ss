<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>$ChatPartner</p>
            <div class="well">
                $MessageForm
            </div>
            <% if $Chat %>
            <ul class="list-unstyled">
                <% loop $Chat %>
                <% if $SenderID == $CurrentMember.ID %>
                <li class="info">
                    <div class="row">
                        <div class="col-xs-3">$Sender.Avatar.SetWidth(50).setAttribute(class, img-rounded)<br />$Created.Nice</div>
                        <div class="col-xs-9">
                            <div class="well">
                                $Text
                            </div>
                        </div>
                    </div>
                <li>
                <% else %>
                <li class="success">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="well">
                                $Text
                            </div>
                        </div>
                        <div class="col-xs-3">$Sender.Avatar.SetWidth(50).setAttribute(class, img-rounded)<br />$Created.Nice</div>
                    </div>
                <li>
                <% end_if %>
                <% end_loop %>
            </ul>  
            <% if $Chat.MoreThanOnePage %>
            <br />
            <ul class="pagination">
                <% if $Chat.NotFirstPage %>
                <li><a class="prev" href="$Chat.PrevLink">&lt;</a></li>
                <% end_if %>
                <% loop $Chat.PaginationSummary %>
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
                <% if $Chat.NotLastPage %>
                <li><a class="next" href="$Chat.NextLink">&gt;</a></li>
                <% end_if %>
            </ul>
            <% end_if %>
            <% else %>
            <p><%t Message.NOMESSAGES "Message.NOMESSAGES" %></p>
            <% end_if %>
        </div>
    </div>
</div>

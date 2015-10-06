<% if $Type == 'friendship_requested' %>
    <% include QueueMessage_friendship_requested %>
<% else_if $Type == 'friendship_confirmed' %>
    <% include QueueMessage_friendship_confirmed %>
<% else_if $Type == 'friendship_declined' %>
    <% include QueueMessage_friendship_declined %>
<% else_if $Type == 'friendship_droped' %>
    <% include QueueMessage_friendship_droped %>
<% end_if %>
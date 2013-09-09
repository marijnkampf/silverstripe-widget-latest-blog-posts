<ul class="latestnews">
<% control LatestPosts %>
	<li>
		<div class="latestpost"><a href="$Link" rel="lightbox" title="$Title">$Title</a>
		<div class="date"><% if isEvent %>Date: $EventDateRange<% else %>Posted: $Date.Nice<% end_if %></div></div>
	</li>
<% end_control %>
</ul>

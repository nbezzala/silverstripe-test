<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
        <div id="BrowserPoll">
            <h2>Browser Poll</h2>
            <% if $BrowserPollForm %>
                $BrowserPollForm
            <% else %>
                <ul>
                    <% loop BrowserPollResults %>
                        <li>
                            <div class="Browser">$Browser : $Percentage % :
$Count votes</div>
                            <div class="bar" style="width:$Percentage%">&nbsp;</div>
                        </li>
                    <% end_loop %>
                </ul>
            <% end_if %>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Browser</th>
                    <th>Reason</th>
                    <th>Time Submitted</th>
                </tr>
                <% loop BrowserPollResults %>

                <% end_loop %>
            </table>
        </div>
		<div class="content">$Content</div>
	</article>
		$Form
		$PageComments
</div>

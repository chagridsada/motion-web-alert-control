    <!-- Tray -->
    <div id="tray">
        <ul>
            <li id="tray-active"><a href="./">:: MAIN :: </a></li> <!-- Active page -->
	    <li><a href="Realtime Monitor" onclick="load_page('view/layout.php') ; return false">Realtime Monitor</a></li>
            <li><a href="View Recorded" onclick="load_page('view/recorded.php') ; return false">View Recorded</a></li>
            <li><a href="Setting" onclick="load_page('view/setting_alert.php') ; return false">Setting</a></li>
            <li><a href="Download" onclick="return false">Download</a></li>
            <li><a href="Purchese" onclick="return false">Purchase</a></li>
            <li><a href="Contact" onclick="return false">Contact</a></li>
        </ul>
        <!-- Search -->
        <div id="search" class="box">
            <form  onsubmit="return false">
                <div class="box">
                    <div id="search-input"><span class="noscreen">Search:</span><input type="text" size="30" name="" value="Search" /></div>
                    <div id="search-submit"><input type="image" src="css/design/search-submit.gif" value="OK" /></div>
                </div>
            </form>
        </div> <!-- /search -->
    <hr class="noscreen" />
    </div> <!-- /tray -->

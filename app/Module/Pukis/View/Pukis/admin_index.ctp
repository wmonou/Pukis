<div class="menu">
	<!-- Menu -->
	<aside class="sidebar">
    <nav class="sidebar-nav">
      <ul id="menu">
        <li class="active">
          <a href="#">
            <span class="sidebar-nav-item-icon fa fa-github fa-lg"></span>
            <span class="sidebar-nav-item">Dashboard</span>
            <span class="fa arrow"></span>
          </a>
          <ul>
            <li>
              <a href="https://github.com/wmonou/pukis">
                <span class="sidebar-nav-item-icon fa fa-code-fork"></span>
                Fork
              </a>
            </li>
            <li>
              <a href="https://github.com/wmonou/pukis">
                <span class="sidebar-nav-item-icon fa fa-star"></span>
                Star
              </a>
            </li>
            <li>
              <a href="https://github.com/wmonou/pukis/issues">
                <span class="sidebar-nav-item-icon fa fa-exclamation-triangle"></span>
                Issues
              </a>
            </li>
          </ul>
        </li>
          <li>
              <a href="#">Menu 0 <span class="fa arrow"></span></a>
              <ul>
                  <li><a href="#">item 0.1</a></li>
                  <li><a href="#">item 0.2</a></li>
                  <li><a href="http://onokumus.com">onokumus</a></li>
                  <li><a href="#">item 0.4</a></li>
              </ul>
          </li>
          <li>
              <a href="#">Menu 1 <span class="glyphicon arrow"></span></a>
              <ul>
                  <li><a href="#">item 1.1</a></li>
                  <li><a href="#">item 1.2</a></li>
                  <li>
                      <a href="#">Menu 1.3 <span class="fa plus-times"></span></a>
                      <ul>
                          <li><a href="#">item 1.3.1</a></li>
                          <li><a href="#">item 1.3.2</a></li>
                          <li><a href="#">item 1.3.3</a></li>
                          <li><a href="#">item 1.3.4</a></li>
                      </ul>
                  </li>
                  <li><a href="#">item 1.4</a></li>
                  <li>
                      <a href="#">Menu 1.5 <span class="fa plus-minus"></span></a>
                      <ul>
                          <li><a href="#">item 1.5.1</a></li>
                          <li><a href="#">item 1.5.2</a></li>
                          <li><a href="#">item 1.5.3</a></li>
                          <li><a href="#">item 1.5.4</a></li>
                      </ul>
                  </li>
              </ul>
          </li>
          <li>
              <a href="#">Menu 2 <span class="glyphicon arrow"></span></a>
              <ul>
                  <li><a href="#">item 2.1</a></li>
                  <li><a href="#">item 2.2</a></li>
                  <li><a href="#">item 2.3</a></li>
                  <li><a href="#">item 2.4</a></li>
              </ul>
          </li>
      </ul>
     </nav>
  </aside>
</div>

<div class="frame">
	<div class="flash"></div>
	<div class="body"></div>
</div>




<script type="text/javascript">
$(document).ready(function() {

	$(function () {
	    $('.sidebar').metisMenu();
	});

	$('#menu>a').click(function(e){
		e.preventDefault();
		var request = new PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest(this);
		request.ajaxLinkRequest(); 		
	});	
	
});
</script>
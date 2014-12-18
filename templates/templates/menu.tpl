<div class="container">


    <div class="row">
      <div class="col-sm-12">
        <h2>MAP Survey Administration</h2>
      </div>
     
    </div>
 



  
 
  <!-- Static navbar -->
  <div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          {*{if $opt == "home"}*}
            <li class="active"><a href="index.php?opt=home">Home</a></li>
          {*{else}*}
           {* <li><a href="index.php?opt=home"">Home</a></li>*}
          {*{/if}*}
          
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="false">Companies <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">

              {*{if $opt == "comp_add"}*}
                <li><a href='index.php?opt=comp_add'>Add</a></li>
              {*{else}*}
               {* <li><a href='index.php?opt=comp_add'>Add</a></li>*}
             {* {/if}*}
                                                                      
            </ul>
          </li>
        
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="false">Reports <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="index.php?opt=comp_graph">Graphs</a></li>
             <li><a href="#">User</a></li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </div>
  
</div> <!-- /container --> 

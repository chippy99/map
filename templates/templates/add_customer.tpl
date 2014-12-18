{include file="header.tpl" title="Meta-LUCID Survey - Add Customer"}
{include file="menu.tpl"}

<div class="container">

  <h2>Adding Customer</h2>
  <div class="panel panel-default">
    <div class="panel-body">
   
      <form class="form-horizontal" role="form" method="post" action="index.php">
      
        <div class="form-group">
          <label for="comp_name" class= "col-sm-3 control-label">Company Name</label>
          <div class="col-sm-9">
            <input type="text" name="company_name" class="form-control" id="comp_name" placeholder="Company Name">
          </div>
        </div><!-- form-group-->
      
        <div class="form-group">
          <label for="inputEmail" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
          </div>
        </div><!-- form-group -->

        <div class="form-group">
          <label for="inputContact" class="col-sm-3 control-label">Contact Name</label>
          <div class="col-sm-9">
            <input type="text" name="contact_name" class="form-control" id="inputContact" placeholder="Contact Name">
          </div>
        </div><!-- form-group -->
        
        <div class="form-group">
          <label for="inputImed" class="col-sm-3 control-label">Email result</label>
          <div class="col-sm-1">
            <input type="checkbox" name="imed_reply" class="form-control" id="inputImed" checked value="yes" >
          </div>
        </div><!-- form-group -->
        
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-default" name="Submit" value="add_customer">Save</button>&nbsp;
            <button type="submit" class="btn btn-default" name="Cancel" value="cancel">Close</button>
          </div>
        </div>

      </form>
    </div><!-- panel-body -->
  </div><!-- panel -->
</div>

{include file="footer.tpl"}
   
   

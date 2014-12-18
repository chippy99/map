{include file="header.tpl" title="Meta-LUCID Survey - Add Customer"}
{include file="menu.tpl"}

<div class="container">

  <h2>Edit Customer</h2>
  <div class="panel panel-default">
    <div class="panel-body">
   
      <form class="form-horizontal" role="form" method="post" action="index.php">
      
        <div class="form-group">
          <label for="comp_name" class= "col-sm-3 control-label">Company Name</label>
          <div class="col-sm-9">
            <input type="text" value="{$cust_data.name}" name="company_name" class="form-control" id="comp_name">
          </div>
        </div><!-- form-group-->
      
        <div class="form-group">
          <label for="inputEmail" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
            <input type="email" value="{$cust_data.email}" name="email" class="form-control" id="inputEmail">
          </div>
        </div><!-- form-group -->

        <div class="form-group">
          <label for="inputContact" class="col-sm-3 control-label">Contact Name</label>
          <div class="col-sm-9">
            <input type="text" value="{$cust_data.contact}" name="contact_name" class="form-control" id="inputContact">
          </div>
        </div><!-- form-group -->

        <div class="form-group">
          <label for="inputPassword" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input type="text" value="{$cust_data.password}" name="password" class="form-control" id="inputPassword">
          </div>
        </div><!-- form-group -->
        
        <div class="form-group">
          <label for="inputImed" class="col-sm-3 control-label">Email result</label>
          <div class="col-sm-1">
          {if $cust_data.imed_reply == true}
            <input type="checkbox" name="imed_reply" class="form-control" id="inputImed" checked value="yes" >
            {else}
            <input type="checkbox" name="imed_reply" class="form-control" id="inputImed" value="yes" >
            {/if}
          </div>
        </div><!-- form-group -->
        
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
             <button type="submit" class="btn btn-default" name="Submit" value="edit_customer">Save</button>&nbsp;
            <button type="submit" class="btn btn-default" name="Cancel" value="cancel">Close</button>
          </div>
        </div>

        <input type="hidden" name="id" value="{$cust_data.id}">
      </form>
    </div><!-- panel-body -->
  </div><!-- panel -->
</div>

{include file="footer.tpl"}

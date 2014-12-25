{include file="header.tpl" title="Meta-LUCID Survey - Add Customer"}
{include file="menu.tpl"}

<div class="container">

  <h2>Edit User</h2>
  <div class="panel panel-default">
    <div class="panel-body">
   
      <form class="form-horizontal" role="form" method="post" action="index.php">
      
        <div class="form-group">
          <label for="first_name" class= "col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
            <input type="text" value="{$user_data.first_name}" name="first_name" class="form-control" id="first_name">
          </div>
        </div><!-- form-group-->
      
        <div class="form-group">
          <label for="last_name" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input type="text" value="{$user_data.last_name}" name="last_name" class="form-control" id="last_name">
          </div>
        </div><!-- form-group -->

        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
            <input type="email" value="{$user_data.email}" name="email" class="form-control" id="email">
          </div>
        </div><!-- form-group -->

                
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
			<button type="submit" class="btn btn-default" name="Submit" value="edit_user">Save</button>&nbsp;
            <button type="submit" class="btn btn-default" name="Cancel" value="cancel">Close</button>
          </div>
        </div>



        <input type="hidden" name="org_id" value="{$user_data.org_id}">
		<input type="hidden" name="person_id" value="{$user_data.id}">


      </form>
    </div><!-- panel-body -->
  </div><!-- panel -->
</div>

{include file="footer.tpl"}

{include file="header.tpl" title="MetaLucid MAP Survey - Login"}

  <div class="container">
    <h1>MetaLucid MAP Sign In</h1>
    <h3>Please enter your customer id to proceed to the MAP questionaire</h3><br/><br/>
<form class="form-horizontal" role="form" method="post" action="index.php">
 
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Customer ID</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="inputPassword" placeholder="Customer ID" name="c_id">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>


{include file="footer.tpl"}

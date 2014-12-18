{include file="header.tpl" title="Meta-LUCID MAP Survey"}
<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <h1>Thank You {$name} the MAP survey has been completed</h1>

      {if $emailed == 1}
        <h3>You will be emailed your survey results shortly</h3>
      {else}
        <h3>Your results have been stored</h3>
      {/if}

    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <br/><br/><br/><br/>
      <img class="center-block" src="http://map.meta-lucid.com/images/ml_exp.jpg">
    </div>
  </div>
</div>
{include file="footer.tpl"}

{include file="header.tpl" title="Meta-LUCID Survey - Graphs"}
{include file="menu.tpl"}
<div class="container">
  <div class="row">
    <br/><br/><br/><br/>
    <div class="col-sm-3">
      <h4 class="text-right">Select a Customer:</h4>
    </div>
    <div class="col-sm-6">
      <table class='table'>
      
        {foreach key=k item=i from=$cust}  
          <tr>
            <td>{$i.name}</td>
            <td> <input type="button" class="btn btn-default" onClick="parent.location='index.php?opt=show_bar_graph&id={$i.id}'" value="Bar Graph"></td>
          </tr>

        {/foreach}
      </table>
    </div>
    <div class="col-sm-3">
    </div>
    
  </div>
  <div class="row">
    <br/><br/>
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
      <div class="col-sm-6">
        <input id="but1" style="display:none;" type="button" class="btn btn-default pull-right" onClick="parent.location='index.php?opt=show_bar_graph&id={$i.id}'" value="Bar Graph">
      </div>
       <div class="col-sm-6">
         <input id="but2" style="display:none;" type="button" class="btn btn-default pull-left" onClick="parent.location='index.php?opt=show_pie_chart&id={$i.id}'" value="Pie Chart">
       </div>
      
    </div>


</div>

</div>


{include file="footer.tpl"}

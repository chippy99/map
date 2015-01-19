{include file="header.tpl" title="Meta-LUCID Survey - Admin"}
{include file="menu.tpl"}





 <form class="form-horizontal" role="form" method="post" action="index.php">
<div class="container">
      <div class="table-responsive">

        <table class="borderless">
          <thead>
            <tr>
              <th class="text-center title-row col-xs-4">Company</th>
              <th class="text-center title-row col-xs-4">Contact</th>
              <th class="text-center title-row col-xs-1">Users</th>
              <!--<th class="text-center title-row col-xs-1">Replies</th>-->
              <th class="col-xs-1"></th>
              <th class="col-xs-1"></th>
              
            </tr>
          </thead>

         
            {foreach key=k item=i from=$cust}
              <tr>
                <td class='cell-bordered'><a href="index.php?opt=comp_list&id={$i.id}">{$i.name}</a></td>
                <td class='cell-bordered'>{$i.contact}</td>
                <td class='cell-bordered text-center'><a href="index.php?opt=user_list&id={$i.id}">{$i.person_count}</a></td>
                <!--<td class='cell-bordered text-center'></td>-->
                <td class='cell-bordered text-center'><input type= "button" class="btn btn-default" onClick="parent.location='index.php?opt=edit_cust&id={$i.id}'" value="Edit"></td>
				{if $i.person_count == 0}
				<td class='cell-bordered text-center'><input type ="button" class="btn btn-default" onclick="confirmDelete('index.php?opt=del_cust&id={$i.id}','{$i.name}')" value="Delete"></button></td>
				{else}
				<td class='cell-bordered text-center'><input type ="button" class="btn btn-default" disabled value="Delete"></button></td>
				{/if}

              </tr>

            {/foreach}
          
        </table>
      
  </div>
</div>
 </form>

<script type='text/javascript'>
function confirmDelete(delUrl, name) {
  if (confirm("Are you sure you want to delete " + name + ", all data for this customer will be permanently deleted")) {
   document.location = delUrl;
  }
}
</script>
{include file="footer.tpl"}

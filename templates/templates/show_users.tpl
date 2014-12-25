{include file="header.tpl" title="Meta-LUCID Survey - Show Users"}
{include file="menu.tpl"}

<div class="container">
      <div class="table-responsive">
        <h2>Users registered to {$cust_name}</h2>
        <table class="borderless">
          <thead>
            <tr>
              <th class="text-center title-row col-xs-5">Name</th>
              <th class="text-center title-row col-xs-4">Email</th>
              <th class="text-center title-row col-xs-1">Replies</th>
              <th class="col-xs-1"></th>
              <th class="col-xs-1"></th>
              
            </tr>
          </thead>

          {foreach key=k item=i from=$user_data}

            <tr>

              <td class='cell-bordered'><a href="index.php?opt=results_list&id={$i.id}">{$i.first_name} {$i.last_name}</a></td>

              <td class='cell-bordered'>{$i.email}</td>

              <td class='cell-bordered text-center'>{$i.score_count}</td>
               

              <td class='cell-bordered text-center'><input type= "button" class="btn btn-default" onClick="parent.location='index.php?opt=edit_user&user_id={$i.id}'" value="Edit"></td>

              <td class='cell-bordered text-center'><input type ="button" class="btn btn-default" onclick="confirmDelete('index.php?opt=del_user&id={$i.id}&c_id={$cust_id}','{$i.first_name} {$i.last_name}')" value="Delete"></button></td>

            </tr>


          {/foreach}

        </table>
      </div>
</div>
<script type='text/javascript'>
function confirmDelete(delUrl, name) {
  if (confirm("Are you sure you want to delete " + name + ", all data for this person will be permanently deleted")) {
   document.location = delUrl;
  }
}
</script>

{include file="footer.tpl"}

{include file="header.tpl" title="Meta-LUCID MAP Survey"}
{include file="menu.tpl" title="Meta-LUCID MAP Survey"}
<div class="container">

  <form name="surveyform" class="form-horizontal" role="form" action="index.php" method="post" id="surveyForm">
    <div class="row">
      <div class="col-sm-4">
        <img width="105" height="89"src="http://map.meta-lucid.com/images/ML_Logo.jpg"></img>
      </div>
      <div class="col-sm-8">
        <h1>Meta-LUCID MAP Survey</h1>
      </div>
      </div>
      <br/>
    <div class="form-group">
      <label for="c_org" class="control-label col-xs-2">Organisation:</label>
      
      <div class="col-xs-4">
        <input type="text"  class="form-control" id="corg" name="c_org" readonly value="{$company_data.name}"/>
      </div>
     
      <label for="cemail" class="control-label col-xs-2">Email:</label>
      <div class="col-xs-4">
        <input type="email"  class="form-control" id="cemail" name="c_email" readonly value="{$user_data.email}"/>
      </div>  
    </div>
   
    <div class="form-group">
      <label for="fname" class="control-label col-xs-2">First Name:</label>
      <div class="col-xs-4">
        <input type="text"  class="form-control" name="c_fname" id="fname" readonly value="{$user_data.first_name}"/>
      </div>

      <label for="sname" class="control-label col-xs-2">Surname:</label>
      <div class="col-xs-4">
        <input type="text"  class="form-control" name="c_sname" id="cname" readonly value="{$user_data.last_name}"/>
      </div>
    
    </div>


 
           
<div class="table-responsive">
   <table class='borderless qTable'>
     <thead>
       <tr>
         <th class="title-row-nb col-xs-6" colspan="2">&nbsp;</th>
		{foreach $answers as $a}
         <th class="text-center title-row col-xs-1">{$a}</th>
		{/foreach}
       </tr>
     </thead>
     <tbody>

       {foreach $questions as $q}
         {assign "an" value="q`$q@iteration`"}
         {assign "ans" value = "`$data.$an`"}
      
       <tr><td class='text-center cell-bordered'>{$q@iteration}</td>
         <td class="cell-bordered">{$q}</td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[0]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-1' value='1' {if $ans == 1} checked {else} disabled {/if} /></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[1]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-2' value='2'  {if $ans == 2} checked {else} disabled{/if} /></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[2]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-3' value='3'  {if $ans == 3} checked {else} disabled{/if} /></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[3]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-4' value='4' {if $ans == 4} checked {else} disabled{/if} /></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[4]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-5' value='5' {if $ans == 5} checked {else} disabled{/if} /></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[5]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-6' value='6' {if $ans == 6} checked {else} disabled{/if} /></td>
       </tr>

     {/foreach}
     </tbody>
   </table>
</div>

<!-- Button -->

   <br/><br/>
   <div class="form-group">
     <label class="col-md-4 control-label" for="singlebutton"></label>
     <div class="col-md-4 center-block">
       <button id="singlebutton" name="singlebutton" class="btn btn-success center-block" type="submit">Close</button>
     </div>  
   </div>
   <input type="hidden" name="c_id" value="{$company.id}">


  </form>
</div>

{include file="footer.tpl"}

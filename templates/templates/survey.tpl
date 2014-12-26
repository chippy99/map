{include file="header.tpl" title="Meta-LUCID MAP Survey"}

<div class="container">

  <form name="surveyform" class="form-horizontal" role="form" action="survey_submit.php" method="post" id="surveyForm">
    <div class="row">
      <div class="col-sm-4">
        <img width="105" height="89"src="http://map.meta-lucid.com/images/ML_Logo.jpg"></img>
      </div>
      <div class="col-sm-8">
        <h2>Meta-LUCID MAP Survey</h2>
      </div>
      </div>
      <br/>
    <div class="form-group">
      <label for="c_org" class="control-label col-xs-2">Organisation:</label>
      
      <div class="col-xs-4">
        <input type="text"  class="form-control" id="corg" name="c_org" readonly value="{$company.name}"/>
      </div>
     
      <label for="cemail" class="control-label col-xs-2">Email:</label>
      <div class="col-xs-4">
        <input type="email"  class="form-control" id="cemail" name="c_email" required/>
      </div>  
    </div>
   
    <div class="form-group">
      <label for="fname" class="control-label col-xs-2">First Name:</label>
      <div class="col-xs-4">
        <input type="text"  class="form-control" name="c_fname" id="fname" minlength="2" required/>
      </div>

      <label for="sname" class="control-label col-xs-2">Surname:</label>
      <div class="col-xs-4">
        <input type="text"  class="form-control" name="c_sname" id="cname" minlegth="2" required/>
      </div>
    
    </div>


 
    <div class="row">
     <div class="col-xs-12">
       <p class="top-space">This is <b>not</b> a test! It is an opinion survey. It asks your opinion about adults in the workplace. Decide how much you agree or disagree with each statement. There are no right or wrong answers.</p>
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
       <tr><td class='text-center cell-bordered'>{$q@iteration}</td>
         <td class="cell-bordered">{$q}</td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[0]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-1' value='1'/></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[1]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-2' value='2'/></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[2]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-3' value='3'/></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[3]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-4' value='4'/></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[4]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-5' value='5'/></td>
         <td class='text-center cell-bordered'><input type='radio' data-toggle="tooltip" data-placement="top" title="{$answers[5]}" required='required' name='q{$q@iteration}' id='q{$q@iteration}-6' value='6'/></td>
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
       <button id="singlebutton" name="singlebutton" class="btn btn-success center-block" type="submit">Submit</button>
     </div>  
   </div>
   <input type="hidden" name="c_id" value="{$company.id}">


  </form>
</div>

{include file="footer.tpl"}

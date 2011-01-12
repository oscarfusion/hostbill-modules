This is smarty template file, for more informations about smarty visit http://www.smarty.net/
<br/>
<br/>
In controller (example1.php) we've assigned data returned from databaseExample method 
under example_var variable, here it will be accessible under {$example_var}
<br/><br/>
Lets display its contents - it will be an array
<br/><br/>

{if $example_var}
<b>There are results, lets build nice table for it<b/><br/>

<table border=1 cellspacing=1 cellpadding=3>
    <tr>
        <td>Invoice ID</td>
        <td>Invoice total</td>
        <td>Invoice date</td>
    </tr>
    {foreach from=$example_var item=invoice}
    <tr>
        <td>{$invoice.id}</td>
        <td>{$invoice.total}</td>
        <td>{$invoice.date}</td>
    </tr>
    {/foreach}
</table>

{else}
Oops, no results found.<br/>

{/if}

<table style="display:none;">
  <tr class="crm-activity-form-block-follow_up_details" id="editrow-follow_up_details">
    <td class="label">{$form.follow_up_details.label}</td>
    <td>{$form.follow_up_details.html}</td>
  </tr>
</table>

{literal}
<script type="text/javascript">
  CRM.$(function($) {
    $('tr.crm-activity-form-block-followup_activity_subject').after($('tr.crm-activity-form-block-follow_up_details'));
  });
</script>
{/literal}

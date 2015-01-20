{literal}
<script type="text/javascript">
cj(document).ready(function() {
  cj('#first_name').keyup(function() {
    if (cj('#custom_117').val() == '') {
      cj('#custom_117').val(cj(this).val());
    }
  });
  cj('#last_name').keyup(function() {
    if (cj('#custom_118').val() == '') {
      cj('#custom_118').val(cj(this).val());
    }
  cj('#email-5').keyup(function() {
    if (cj('#custom_119').val() == '') {
      cj('#custom_119').val(cj(this).val());
    }
  });
  });
});
	
</script>
{/literal}
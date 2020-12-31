<?php
$url = get_option('planfy_account_url');
if(!empty($url)){
?>
<script src="https://www.planfy.com/assets/js/widget.js"></script>
<script>
Pfy.displayTrigger({ url: '<?php echo $url; ?>' });
</script>
<?php
}
?>

<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 
jQuery('document').ready(function(){
  jQuery('.ninja_clmn_nm_access .vp-a').on('click', function(e){
    e.preventDefault();
    jQuery('.video-popup-container a').attr('href',jQuery(this).attr('href'));
    jQuery('.video-popup-container a').click();
  })
});

</script>
<!-- end Simple Custom CSS and JS -->
